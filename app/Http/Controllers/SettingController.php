<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Irc;
use App\Models\JobRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    const Setting = [

        'copy' => [
            "CopyRight",
            [
                ['copyright', 1],
            ]
        ],
        'home_description' => [
            "Home Description",
            [
                ['SpecialityTitle', 1],
                ['TeamTitle', 1],
                ['TeamImage', 0],
                ['TeamMobileImage', 0],
                ['TeamDescription', 2],
            ],
            [
                ["homeSpecialityTitle", "views/front/cache/home/specialityTitle.blade.php"],
            ],
        ],
        'top' => [
            "Top",
            [
                ['logo', 0],
                ['CancerLogo', 0],
                ['favicon', 0],
            ],
            [
                ["logo", "views/front/cache/home/logo.blade.php"],
                ["cancerLogo", "views/front/cache/home/cancerLogo.blade.php"]
            ],
        ],
        'philosophy' => [
            "Philosophy",
            [
                ['title', 1],
                ['description', 2],
                ['image', 0],
            ],
            [
                ["philosophy", "views/front/cache/career/philosophy.blade.php"],
            ],
        ],
        'internship' => [
            "Internship",
            [
                ['title', 1],
                ['description', 2],
            ],
            [
                ["internship", "views/front/cache/career/internship.blade.php"],
            ],
        ],
    ];
    public function index($type, Request $request)
    {
        $data = self::Setting[$type];
        $curdata = [];
        if ($request->getMethod() == "POST") {
            foreach ($data[1] as $key => $attr) {
                $k = $type . '_' . $attr[0];
                try {
                    if (($attr[1] == 0)) {
                        $s = Helper::setSetting($k, $request->file($k)->store('uploads/settings', 'public'), true);
                    } else {
                        $s = Helper::setSetting($k, $request->input($k), true);
                    }
                    $curdata[$attr[0]] = $s->value;
                } catch (\Throwable $th) {
                    $curdata[$attr[0]] = Helper::getSetting($k, true);
                }
            }
            if (isset($data[2])) {
                if (is_array($data[2])) {
                    foreach ($data[2] as $key => $pathData) {
                        file_put_contents(resource_path($pathData[1]), view('admin.setting.template.' . $pathData[0], compact('curdata'))->render());
                    }
                } else {

                    Helper::putCache(resource_path($data[2]), view('admin.setting.template.' . $type, compact('curdata'))->render());
                }
            } else {
                Helper::putCache($type, view('admin.setting.template.' . $type, compact('curdata'))->render());
            }
            return redirect()->back();
        } else {
            return view('admin.setting.index', compact('data', 'type'));
        }
    }

    public function contact(Request $request)
    {
        if ($request->getMethod() == "GET") {
            $data = Helper::getSetting('contact') ?? ((object) ([
                'map' => '',
                'email' => '',
                'phone' => [
                    'phone1' => '',
                    'phone2' => '',
                    'phone3' => '',
                    'phone4' => '',
                ],
                'addr' => '',
                'title' => '',
                'short_desc' => '',
                'others' => [],
                'links' => [
                    'facebook' => '',
                    'youtube' => '',
                    'instagram' => '',
                    'twitter' => '',
                ]
            ]));

            $intData = Helper::getSetting('intContact') ?? ((object) ([
                'email' => '',
                'phone' => '',
                'title' => '',
                'short_title' => '',
                'short_desc' => '',
                'image' => ''
            ]));
            return view('admin.setting.contact', compact('data', 'intData'));
        } else {
            $others = [];
            if ($request->filled('others')) {
                foreach ($request->others as $key => $other) {
                    array_push($others, [
                        'name' => $request->input('name_' . $other) ?? '',
                        'phone' => $request->input('phone_' . $other) ?? '',
                        'designation' => $request->input('designation_' . $other) ?? '',
                        'email' => $request->input('email_' . $other) ?? '',
                    ]);
                }
            }
            $data = [
                'map' => $request->map ?? '',
                'email' => $request->email ?? '',
                'phone' => [
                    'phone1' => $request->phone1 ?? '',
                    'phone2' => $request->phone2 ?? '',
                    'phone3' => $request->phone3 ?? '',
                    'phone4' => $request->phone4 ?? '',
                ],
                'addr' => $request->addr ?? '',
                'short_desc' => $request->short_desc ?? '',
                'others' => $others,
                'links' => [
                    'facebook' => $request->facebook ?? '',
                    'youtube' => $request->youtube ?? '',
                    'instagram' => $request->instagram ?? '',
                    'twitter' => $request->twitter ?? '',
                ]
            ];

            $internationalData = Helper::getSetting('intContact') ?? ((object) ([
                'email' => '',
                'phone' => '',
                'title' => '',
                'shortTitle' => '',
                'short_desc' => '',
                'image' => ''
            ]));

            if ($request->hasFile('intImage')) {
                $intData = [
                    'email' => $request->intEmail ?? '',
                    'phone' => $request->intPhone ?? '',
                    'title' => $request->intTitle ?? '',
                    'short_title' => $request->intShortTitle ?? '',
                    'short_desc' => $request->intDesc ?? '',
                    'image' => $request->file('intImage') ? $request->file('intImage')->store('uploads/settings', 'public') : '',

                ];
            } else {
                $intData = [
                    'email' => $request->intEmail ?? '',
                    'phone' => $request->intPhone ?? '',
                    'title' => $request->intTitle ?? '',
                    'short_title' => $request->intShortTitle ?? '',
                    'short_desc' => $request->intDesc ?? '',
                    'image' => $internationalData->image ?? '',

                ];
            }
            Helper::setSetting('contact', $data);
            Helper::setSetting('intContact', $intData);
            Helper::putMetaCache('contact', $data = [
                'title' => 'Contact Us',
                'description' => 'Reach out to Nobel for appointments, inquiries, and hospital services. Get in touch with our expert medical team for assistance and patient care.',
                'keywords' => 'contact us',
                'url' => route('contact')
            ]);

            $academicProgramTypes = DB::table('blog_categories')->where('type', helper::blog_type_acedemic_program)->get();
            Helper::putCache('academic.index', view('admin.template.academicprogram.index', compact('academicProgramTypes')));


            Helper::putCache('home.footerLink', view('admin.setting.template.footer', compact('data'))->render());
            Helper::putCache('contact.index', view('admin.setting.template.contact', compact('data'))->render());
            Helper::putCache('contact.header-contact', view('admin.template.home.header-contact', compact('data'))->render());
            Helper::putCache('contact.map', view('admin.setting.template.map', compact('data'))->render());
            return redirect()->back()->with('success', "Contact Saved Successfully");
        }
    }

    public function colorScheme(Request $request)
    {
        if (Helper::G()) {
            $colorScheme = Setting::where('key', 'color_scheme')->first();
            if (!$colorScheme) {
                $colorScheme = new Setting();
                $colorScheme->key = 'color_scheme';
                $colorScheme->value = '[]';
                $colorScheme->save();
            }
            $oldData = json_decode($colorScheme->value, true);
            return view('admin.setting.colorscheme', compact('colorScheme', 'oldData'));
        } else {
            Setting::updateOrCreate(
                ['key' => 'color_scheme'],
                ['value' => json_encode($request->except('_token'))]
            );
            Helper::putCache('extra.colorScheme', view('admin.setting.template.colorScheme', ['data' => $request->except('_token')])->render());
            session()->flash('success', 'Color scheme successfully updated');
            return response()->json(['success' => true]);
        }
    }

    public function RequestCallBack(Request $request)
    {
        if ($request->isMethod('get')) {
            $requestCallBack = Setting::where('key', 'request_call_back')->first();
            $values = null;
            if ($requestCallBack) {
                $values = json_decode($requestCallBack->value, true);

            }
            return view('admin.setting.callbackRequest', compact('values'));
        } else {

            $data = $request->input('data');
            if (is_array($data) && count($data) === 0) {
                $setting = Setting::firstOrCreate(['key' => 'request_call_back']);
                $setting->value = json_encode([]); // Setting to null as specified
                $setting->save();
                return response()->json(['message' => 'All Callback Request has been cleared successfully']);
            }

            $validatedData = $request->validate([
                'data' => 'required|array',
                'data.*.details' => 'required|array',
                'data.*.details.name' => 'required|string',
                'data.*.details.phoneNumber' => 'required|string',
                'data.*.details.email' => 'nullable|email',
                'data.*.details.message' => 'required|string',
            ]);

            $setting = Setting::firstOrCreate(['key' => 'request_call_back']);

            // Replace the entire data set
            $replaced = [];
            foreach ($validatedData['data'] as $index => $entry) {
                $replaced[] = [
                    'id' => $index + 1,
                    'details' => $entry['details'],
                ];
            }

            $setting->value = json_encode($replaced);
            $setting->save();

            return response()->json(['success' => true, 'message' => 'Deleted successfully']);
        }
    }


    public function addCallbackRequest(Request $request)
    {
        $setting = Setting::firstOrCreate(['key' => 'request_call_back'], ['value' => '']);
        $existing = json_decode($setting->value, true) ?? [];
        $lastId = collect($existing)->pluck('id')->max() ?? 0;

        $validatedData = $request->validate([
            'data' => 'required|array',
            'data.*.details' => 'required|array',
            'data.*.details.name' => 'required|string',
            'data.*.details.phoneNumber' => 'required|string',
            'data.*.details.email' => 'nullable|email',
            'data.*.details.message' => 'required|string'
        ]);

        $newData = [];
        foreach ($validatedData['data'] as $index => $entry) {
            $lastId++;
            $newData[] = [
                'id' => $lastId,
                'details' => $entry['details'],
            ];
        }

        $merged = array_merge($existing, $newData);

        $setting->value = json_encode($merged);
        $setting->save();
        return response()->json(['message' => 'Your Request has been saved successfully']);

    }

    public function feedback(Request $request)
    {

        if (Helper::G()) {
            $feedback = Setting::where('key', 'feedback')->first();
            $values = null;
            if (!empty($feedback)) {
                $values = json_decode($feedback->value, true);
            }
            return view('admin.setting.feedback', compact('values'));
        } else {

            $data = $request->input('data');
            if (is_array($data) && count($data) === 0) {
                $setting = Setting::firstOrCreate(['key' => 'feedback']);
                $setting->value = json_encode([]); // Setting to null as specified
                $setting->save();
                return response()->json(['message' => 'All feedback cleared successfully']);
            }

            $validatedData = $request->validate([
                'data' => 'required|array',
                'data.*.details' => 'required|array',
                'data.*.details.name' => 'required|string',
                'data.*.details.phoneNumber' => 'required|string',
                'data.*.details.email' => 'required|email',
                'data.*.details.message' => 'required|string',
            ]);

            $setting = Setting::firstOrCreate(['key' => 'feedback']);


            // Replace entire data
            $replaced = [];
            foreach ($validatedData['data'] as $index => $entry) {
                $replaced[] = [
                    'id' => $index + 1, // Or just skip ID if not needed
                    'details' => $entry['details'],
                ];
            }
            $setting->value = json_encode($replaced);
            $setting->save();
            return response()->json(['message' => 'Deleted successfully']);
        }
    }

    public function addFeedback(Request $request)
    {
        $setting = Setting::firstOrCreate(['key' => 'feedback'], ['value' => '']);
        $existing = json_decode($setting->value, true) ?? [];
        $lastId = collect($existing)->pluck('id')->max() ?? 0;

        $validatedData = $request->validate([
            'data' => 'required|array',
            'data.*.details' => 'required|array',
            'data.*.details.name' => 'required|string',
            'data.*.details.phoneNumber' => 'required|string',
            'data.*.details.email' => 'required|email',
            'data.*.details.message' => 'required|string',
        ]);

        $newData = [];
        foreach ($validatedData['data'] as $index => $entry) {
            $lastId++;
            $newData[] = [
                'id' => $lastId,
                'details' => $entry['details'],
            ];
        }

        $merged = array_merge($existing, $newData);
        $setting->value = json_encode($merged);
        $setting->save();
        return response()->json(['message' => 'Thanks for the feedback']);
    }

    public function jobRequest(Request $request, $slug)
    {
        try {
            // Validate the request
            // $validated = $request->validate([
            //    'name' => 'required|string|max:255',
            //    'email' => 'required|email|max:255',
            //    'contactNumber' => 'required|string|max:20',
            //    'dob' => 'required|date',
            //    'gender' => 'required|in:male,female,prefer_not_to_say',
            //    'exp' => 'required|in:0,1',

            //    'orgName' => 'required|string|max:255',
            //    'currentCost' => 'required|string|max:255',
            //    'expectedCost' => 'required|string|max:255',
            //    'noticePeriod' => 'required|integer|min:0',
            //    'currentDesignation' => 'required|string|max:255',
            //    'department' => 'required|string|max:255',
            //    'yearExp' => 'required|integer|min:0',
            //    'changeReason' => 'nullable|string|max:255',

            //    'institution' => 'required|string|max:255',
            //    'degree' => 'required|string|max:255',
            //    'completionYear' => 'required|digits:4',
            //    'securedPercent' => 'required|numeric',
            //    'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            //    'jobMessage' => 'nullable|string',
            // ]);

            // Check if resume was uploaded
            if ($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('uploads/resumes/', 'public');
            }

            // Find the job
            $job = DB::table('jobs')->where('slug', $slug)->first();
            if (!$job) {
                return response()->json(['error' => 'Job not found'], 404);
            }

            // Create new job request
            $jobRequest = new JobRequest();
            $jobRequest->name = $request->name;
            $jobRequest->email = $request->email;
            $jobRequest->phone_number = $request->contactNumber;
            $jobRequest->date_of_birth = $request->dob;
            $jobRequest->gender = $request->gender;
            $jobRequest->experience = $request->exp == '1' ? 'experience' : 'fresher';
            $jobRequest->old_organization = $request->orgName;
            $jobRequest->current_annual_ctc = $request->currentCost;
            $jobRequest->expected_annual_ctc = $request->expectedCost;
            $jobRequest->notice_period = $request->noticePeriod;
            $jobRequest->current_designation = $request->currentDesignation;
            $jobRequest->department = $request->department;
            $jobRequest->year_of_experience = $request->yearExp;
            $jobRequest->reason_of_change = $request->changeReason;
            $jobRequest->institution_name = $request->institution;
            $jobRequest->degree = $request->degree;
            $jobRequest->year_of_completion = $request->completionYear;
            $jobRequest->percent_or_cgpa = $request->securedPercent;
            $jobRequest->resume = $resumePath;
            $jobRequest->message = $request->jobMessage;
            $jobRequest->job_id = $job->id;

            $jobRequest->save();
            return response()->json(['message' => 'Your application has been submitted successfully.'], 200);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Job request error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function nationalImageIndex()
    {
        $image = Setting::where('key', 'nationalImage')->first();
        $data = null;
        if (!empty($image)) {
            $data = json_decode($image->value, true);
        }
        return view('admin.setting.nationalImage.index', compact('data'));
    }
    public function nationalImageAdd(Request $request)
    {
        if (Helper::G()) {
            $image = Setting::where('key', 'nationalImage')->first();
            $values = null;
            if (!empty($image)) {
                $values = json_decode($image->value, true);
            }
            return view('admin.setting.nationalImage.add', compact('values'));
        } else {
            $data = [];
            if ($request->hasFile('desktop_image')) {
                $desktopPath = $request->file('desktop_image')->store('uploads/national', 'public');
                $data['desktopImage'] = $desktopPath;
            }
            if ($request->hasFile('mobile_image')) {
                $mobilePath = $request->file('mobile_image')->store('uploads/national', 'public');
                $data['mobileImage'] = $mobilePath;
            }
            if (!empty($data)) {
                Setting::updateOrCreate(
                    ['key' => 'nationalImage'],
                    ['value' => json_encode($data)]
                );
                Helper::putCache('home.nationalImage', view('admin.setting.template.nationalImage', compact('data'))->render());
                return redirect()->back()->with('success', 'National Image added successfully.');
            } else {
                return response()->json(['error' => 'No images uploaded'], 400);
            }
        }
    }

    public function nationalImageEdit(Request $request)
    {
        $image = Setting::where('key', 'nationalImage')->first();
        $values = null;
        if (!empty($image)) {
            $values = json_decode($image->value, true);
        }
        if ($request->isMethod('get')) {
            return view('admin.setting.nationalImage.edit', compact('values'));
        } else {
            $data = $values ?? [];

            // Delete previous desktop image if new one is uploaded
            if ($request->hasFile('desktopImage')) {
                if (!empty($data['desktopImage']) && Storage::disk('public')->exists($data['desktopImage'])) {
                    Storage::disk('public')->delete($data['desktopImage']);
                }
                $desktopPath = $request->file('desktopImage')->store('uploads/national', 'public');
                $data['desktopImage'] = $desktopPath;
            }

            // Delete previous mobile image if new one is uploaded
            if ($request->hasFile('mobileImage')) {
                if (!empty($data['mobileImage']) && Storage::disk('public')->exists($data['mobileImage'])) {
                    Storage::disk('public')->delete($data['mobileImage']);
                }
                $mobilePath = $request->file('mobileImage')->store('uploads/national', 'public');
                $data['mobileImage'] = $mobilePath;
            }

            Setting::updateOrCreate(
                ['key' => 'nationalImage'],
                ['value' => json_encode($data)]
            );
            Helper::putCache('home.nationalImage', view('admin.setting.template.nationalImage', compact('data'))->render());
            return redirect()->back()->with('success', 'Successfully updated.');
        }
    }

    public function nationalImageDel(Request $request)
    {
        $image = Setting::where('key', 'nationalImage')->first();
        if ($image) {
            $values = json_decode($image->value, true);

            // Delete previously saved files if they exist
            if (!empty($values['desktopImage']) && Storage::disk('public')->exists($values['desktopImage'])) {
                Storage::disk('public')->delete($values['desktopImage']);
            }
            if (!empty($values['mobileImage']) && Storage::disk('public')->exists($values['mobileImage'])) {
                Storage::disk('public')->delete($values['mobileImage']);
            }

            $image->delete();
            Helper::putCache('home.nationalImage', '');
            return redirect()->back()->with('success', 'National image deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No national image found to delete.');
        }
    }

    public function healthLibrary(Request $request)
    {
        if (Helper::G()) {
            $healthLibrary = Setting::where('key', 'healthLibrary')->first();
            return view('admin.setting.healthLibrary.index', compact('healthLibrary'));
        } else {
            $existingHealthLibrary = Setting::where('key', 'healthLibrary')->first();
            $existingData = [];
            if ($existingHealthLibrary && $existingHealthLibrary->value) {
                $existingData = json_decode($existingHealthLibrary->value, true) ?? [];
            }
            $rules = [];
            for ($i = 0; $i < 4; $i++) {
                if ($request->filled("items.{$i}.title") || $request->filled("items.{$i}.link") || $request->hasFile("items.{$i}.image")) {
                    $rules["items.{$i}.title"] = 'required|string|max:255';

                    if (!isset($existingData[$i]['image']) || !$existingData[$i]['image']) {
                        $rules["items.{$i}.image"] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
                    } else {
                        $rules["items.{$i}.image"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
                    }
                }
            }
            $request->validate($rules);
            $data = [];
            for ($i = 0; $i < 4; $i++) {
                if ($request->filled("items.{$i}.title") && $request->filled("items.{$i}.link")) {
                    $itemData = [
                        'title' => $request->input("items.{$i}.title"),
                        'link' => $request->input("items.{$i}.link")
                    ];

                    if ($request->hasFile("items.{$i}.image")) {
                        $imagePath = $request->file("items.{$i}.image")->store("uploads/healthLibrary/{$i}", 'public');
                        $itemData['image'] = $imagePath;
                    } else if (isset($existingData[$i]['image'])) {
                        $itemData['image'] = $existingData[$i]['image'];
                    }

                    $data[$i] = $itemData;
                }
            }

            Setting::updateOrCreate(
                ['key' => 'healthLibrary'],
                ['value' => json_encode($data)]
            );
            Helper::putCache('health.health-care', view('admin.setting.template.healthLibrary', compact('data'))->render());
            return redirect()->back()->with('success', 'Health Library updated successfully.');
        }
    }

    public function irc(Request $request)
    {
        $irc = Irc::first();
        if (Helper::G()) {
            return view('admin.setting.irc.index', compact('irc'));
        } else {
            if (!$irc) {
                $irc = new Irc();
            }
            $irc->title = $request->title;
            $irc->description = $request->description;
            $irc->save();

            Helper::putCache('irc.index', view('admin.setting.template.irc', compact('irc'))->render());
            Helper::putMetaCache('irc', $data = [
                'title' => 'IRC-NMCTH',
                'description' => 'Nobel Medical College Teaching Hospital has established an Institutional Review Committee (IRC-NMCTH) in compliance with NHRC regulations, to oversee its obligations with respect to human participants as well as non human participants. IRC-NMCTH was established on January, 2015.',
                'keywords' => 'nobel, irc, institutional review committee, nobel medical college',
                'url' => route('irc')
            ]);
            return redirect()->back()->with('success', 'IRC updated successfully.');
        }
    }

    public function admission(Request $request)
    {
        if (Helper::G()) {
            $admission = Setting::where('key', 'nobelAdmission')->first();
            $values = null;
            if (!empty($admission)) {
                $values = json_decode($admission->value, true);
            }
            return view('admin.setting.admission', compact('values'));
        } else {
            $data=[];
            if ($request->hasFile('image')) {
                $desktopPath = $request->file('image')->store('uploads/admission', 'public');
                $data['image'] = $desktopPath;
            }
            $data['section-1'] = $request->section_1;
            $data['section-2'] = $request->section_2;

            if(!empty($data)) {
                Setting::updateOrCreate([
                    'key' => 'nobelAdmission',
                    'value' => json_encode($data)
                ]);

                Helper::putCache('admission.index', view('admin.setting.template.admission', compact('data'))->render());
                Helper::putMetaCache('admission', $data = [
                    'title' => 'Admission',
                    'description' => 'Nobel Medical College Teaching Hospital has established an Institutional Review Committee (IRC-NMCTH) in compliance with NHRC regulations, to oversee its obligations with respect to human participants as well as non human participants. IRC-NMCTH was established on January, 2015.',
                    'keywords' => 'nobel, admission, admission details, nobel medical college',
                    'url' => route('irc')
                ]);
                return redirect()->back()->with('success', 'Admission updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update admission data.');
            }
        }
    }

    public function meta(Request $request)
    {
        if (Helper::G()) {
            $meta = Setting::where('key', 'meta')->first();
            $values = null;
            if (!empty($meta)) {
                $values = json_decode($meta->value, true);
            }
            return view('admin.setting.meta', compact('values'));
        } else {
            $data = [];
            $data['description'] = $request->description;
            if (!empty($data)) {
                Setting::updateOrCreate(
                    ['key' => 'meta'],
                    ['value' => json_encode($data)]
                );
                Helper::putMetaCache('home.home', $data = [
                    'description' => $data['description'],
                    'url' => route('index'),
                ]);
                return redirect()->back()->with('success', 'Meta data successfully updated.');
            } else {
                return response()->json(['error' => 'Failed to update meta data'], 400);
            }
        }
    }
}
