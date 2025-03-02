<?php

namespace App\Helpers;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Helper
{
    /**
     * Check if the request method is GET
     */
    public static function G(): bool
    {
        return request()->isMethod('get');
    }

    /**
     * Check if the request method is POST
     */
    public static function P(): bool
    {
        return  request()->isMethod('post');
    }

    public static function getSpecialityRoutes($parent_speciality_id,$get_routes=true){

        $parents=[];
        while ($parent_speciality_id!=null) {
            $speciality=DB::table(Speciality::tableName)->where('id',$parent_speciality_id)->first(['id','title','parent_speciality_id']);
            if($get_routes){
                $speciality->url=route('admin.speciality.index',['parent_speciality_id'=>$parent_speciality_id]);
            }
            $parent_speciality_id = $speciality->parent_speciality_id;
            $parents[]=$speciality;
        }
        $parents=array_reverse($parents);
        return $parents;
    }

    public static function getParentRoute($parent_id, $get_routes = true) {
        $parent = [];
        while ($parent_id != null) {
            $category = DB::table('download_categories')
                ->where('id', $parent_id)
                ->first(['id', 'title', 'parent_id']);

            if (!$category) {
                break;
            }
            if ($get_routes) {
                $category->url = route('admin.downloadCategory.index', ['parent_id' => $parent_id]);
            }
            $parent_id = $category->parent_id;
            $parent[] = $category;
        }

        return array_reverse($parent);
    }


}
