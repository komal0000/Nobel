<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\SpecialityTechnology;
use App\Models\Technology;
use App\Models\TechnologySection;
use App\Models\TechnologySectionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
   public function index(Request $request)
   {

      $technologies = DB::table('technologies')->get();
      return view('admin.technology.index', compact('technologies'));
   }
   public function add(Request $request)
   {
      if (Helper::G()) {
         $technologySectionTypes = DB::table('technology_section_types')->get();
         $specialities = DB::table('specialties')->get();
         return view('admin.technology.add', compact('specialities', 'technologySectionTypes'));
      } else {
         $technology = new Technology();
         $technology->title = $request->technology_title;
         if ($request->hasFile('technology_image')) {
            $technology->image = $request->file('technology_image')->store('uploads/technologies', 'public');
         }
         if ($request->hasFile('technology_single_page_image')) {
            $technology->single_page_image = $request->file('technology_single_page_image')->store('uploads/technologies', 'public');
         }

         $technology->short_description = $request->technology_short_description;
         $technology->save();

         if ($request->has('technologySpecialities')) {
            foreach ($request->technologySpecialities as $specialities) {
               $specialityTechnology = new SpecialityTechnology();
               $specialityTechnology->speciality_id = $specialities;
               $specialityTechnology->technology_id = $technology->id;
               $specialityTechnology->save();
            }
         }

         $specialityTechnologies = DB::table('speciality_technologies')->where('technology_id', $technology->id)->get();
         foreach ($specialityTechnologies as $specialityTechnology) {
            $this->renderSpeciality($specialityTechnology->speciality_id);
         }
         if ($request->has('sections') && is_array($request->sections)) {
            foreach ($request->sections as $typeId => $sectionData) {
               $section = new TechnologySection();
               $section->technology_id = $technology->id;
               $section->technology_section_type_id = $typeId;
               $section->title = $sectionData['title'];
               $section->short_description = $sectionData['short_description'];
               $section->design_type = $sectionData['designType'];

               if ($request->hasFile("sections.$typeId.image")) {
                  $section->image = $request->file("sections.$typeId.image")
                     ->store('uploads/technology_sections', 'public');
               }
               $section->save();

               // Handle multiple section data entries
               if (isset($sectionData['section_data']) && is_array($sectionData['section_data'])) {
                  foreach ($sectionData['section_data'] as $index => $item) {
                     $sectionDataRecord = new TechnologySectionData();
                     $sectionDataRecord->technology_id = $technology->id;
                     $sectionDataRecord->technology_section_type_id = $typeId;
                     $sectionDataRecord->technology_section_id = $section->id;
                     $sectionDataRecord->title = $item['title'] ?? '';
                     $sectionDataRecord->short_description = $item['short_description'] ?? '';
                     $sectionDataRecord->long_description = $item['long_description'] ?? '';

                     if ($request->hasFile("sections.$typeId.section_data.$index.image")) {
                        $sectionDataRecord->image = $request->file("sections.$typeId.section_data.$index.image")
                           ->store('uploads/technology_section_data', 'public');
                     }

                     $sectionDataRecord->save();
                  }
               }
            }
         }
         $this->render();
         $this->renderSingle($technology->id);
         session()->flash('success', 'Technology Successfully Added');
         return response()->json(['success' => true]);
      }
   }

   public function edit(Request $request, $technology_id)
   {
      $technology = Technology::where('id', $technology_id)->first();
      if (Helper::G()) {
         $specialities = DB::table('specialties')->get();
         $specialityTechnologies = DB::table('speciality_technologies')->where('technology_id', $technology_id)->get();
         $technologySectionTypes = DB::table('technology_section_types')->get();
         return view('admin.technology.edit', compact('technology', 'technology_id', 'specialities', 'specialityTechnologies', 'technologySectionTypes'));
      } else {
         $technology->title = $request->technology_title;
         $technology->short_description = $request->technology_short_description;
         if ($request->hasFile('technology_image')) {
            $technology->image = $request->file('technology_image')->store('uploads/technologies', 'public');
         }
         if ($request->hasFile('technology_single_page_image')) {
            $technology->single_page_image = $request->file('technology_single_page_image')->store('uploads/technologies', 'public');
         }
         $technology->save();

         $oldSpecialityIds = DB::table('speciality_technologies')
            ->where('technology_id', $technology->id)
            ->pluck('speciality_id')
            ->toArray();

         if ($request->has('technologySpecialities')) {
            SpecialityTechnology::where('technology_id', $technology->id)->delete();
            foreach ($request->technologySpecialities as $specialities) {
               $specialityTechnology = new SpecialityTechnology();
               $specialityTechnology->speciality_id = $specialities;
               $specialityTechnology->technology_id = $technology->id;
               $specialityTechnology->save();
            }
         }

         if ($request->has('sections') && is_array($request->sections)) {
            foreach ($request->sections as $typeId => $sectionData) {
               $section = TechnologySection::where('technology_section_type_id', $typeId)
                  ->where('technology_id', $technology->id)
                  ->first();

               if (!$section) {
                  $section = new TechnologySection();
                  $section->technology_id = $technology->id;
                  $section->technology_section_type_id = $typeId;
               }

               $section->title = $sectionData['title'];
               $section->short_description = $sectionData['short_description'];
               $section->design_type = $sectionData['designType'];

               if ($request->hasFile("sections.$typeId.image")) {
                  $section->image = $request->file("sections.$typeId.image")
                     ->store('uploads/technology_sections', 'public');
               }
               $section->save();
               if (isset($sectionData['section_data']) && is_array($sectionData['section_data'])) {
                  foreach ($sectionData['section_data'] as $index => $item) {
                     $sectionDataRecord = TechnologySectionData::where('technology_section_id', $section->id)
                        ->where('technology_id', $technology->id)
                        ->where('technology_section_type_id', $typeId)
                        ->skip($index)
                        ->first();
                     if (!$sectionDataRecord) {
                        $sectionDataRecord = new TechnologySectionData();
                     }
                     $sectionDataRecord->technology_id = $technology->id;
                     $sectionDataRecord->technology_section_type_id = $typeId;
                     $sectionDataRecord->technology_section_id = $section->id;
                     $sectionDataRecord->title = $item['title'] ?? '';
                     $sectionDataRecord->short_description = $item['short_description'] ?? '';
                     $sectionDataRecord->long_description = $item['long_description'] ?? '';

                     if ($request->hasFile("sections.$typeId.section_data.$index.image")) {
                        $sectionDataRecord->image = $request->file("sections.$typeId.section_data.$index.image")
                           ->store('uploads/technology_section_data', 'public');
                     }

                     $sectionDataRecord->save();
                  }
               }
            }

         }
         
         $specialityIds = $request->technologySpecialities;

         $onlyOldIds = array_diff($oldSpecialityIds, $specialityIds);
         $onlyNewIds = array_diff($specialityIds, $oldSpecialityIds);
         $mergedSpeciality = array_merge($onlyOldIds, $onlyNewIds);

         foreach ($oldSpecialityIds as $specialityId) {
            $this->delCache($specialityId);
            $this->renderSpeciality($specialityId);
         }

         if(!empty($mergedSpeciality)) {
            foreach($mergedSpeciality as $merge) {
               $this->renderSpeciality($merge);
            }
         }

         $this->render();
         $this->renderSingle($technology_id);
         session()->flash('success', 'Technology Successfully updated');
         return response()->json(['success' => true]);
      }
   }


   public function del($technology_id)
   {
      $technology = Technology::where('id', $technology_id)->first();
      TechnologySectionData::where('technology_id', $technology_id)->delete();
      TechnologySection::where('technology_id', $technology_id)->delete();
      $specialityTechnologies = SpecialityTechnology::where('technology_id', $technology_id)->get();

      $specialityIds = DB::table('speciality_technologies')
         ->where('technology_id', $technology_id)
         ->pluck('speciality_id');

      foreach($specialityIds as $specialityId) {
         $this->delCache($specialityId);
      }

      foreach ($specialityTechnologies as $st) {
         $st->delete();
      }

      foreach ($specialityIds as $specialityId) {
         $this->renderSpeciality($specialityId);
      }

      $technology->delete();
      $this->render();
      return redirect()->back()->with('delete_success', 'Successfully Technology Deleted');
   }

   public function render()
   {

      $technologiesIndex = DB::table('technologies')->get();
      $technologiesLatest = DB::table('technologies')->latest()->take(5)->get();
      Helper::putCache('technology.index', view('admin.template.technology.index', compact('technologiesIndex'))->render());
      Helper::putCache('health.technology', view('admin.template.health.technology', compact('technologiesLatest'))->render());
   }

   public function renderSpeciality($speciality_id)
   {
      $technologyIds = DB::table('speciality_technologies')
         ->where('speciality_id', $speciality_id)
         ->pluck('technology_id');
      $technologies = DB::table('technologies')
         ->whereIn('id', $technologyIds)
         ->get();
      $speciality = DB::table('specialties')->where('id', $speciality_id)->first();
      Helper::putCache('speciality.single.' . $speciality->slug . '.technologies', view('admin.template.speciality.technology', compact('technologies'))->render());
   }

   public function delCache($speciality_id)
   {
      $speciality = DB::table('specialties')->where('id', $speciality_id)->first();
      Helper::deleteCache('speciality.single.' . $speciality->slug . '.technologies');
   }

   public function renderSingle($technology_id)
   {
      $technology = Technology::findOrFail($technology_id);
      $technologySections = TechnologySection::where('technology_id', $technology_id)->get();

      Helper::putMetaCache('technology.' . $technology->slug, $data = [
         'title' => $technology->title,
         'description' => $technology->short_description,
         'image' => asset(asset($technology->single_page_image)),
         'url' => route('technology.single', ['slug' => $technology->slug]),
      ]);

      Helper::putMetaCache('technology', $data = [
         'title' => 'All Technologies',
         'description' => 'All Technologies section available in Kathmandu Medical College.',
         'keywords' => 'technology, technologies',
         'url' => route('technology.index')
      ]);
      Helper::putCache('technology.single.' . $technology->slug, view('admin.template.technology.single', compact('technology', 'technologySections'))->render());
   }
}
