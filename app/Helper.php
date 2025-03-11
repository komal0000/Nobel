<?php

namespace App\Helpers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Setting;
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

    public static function getSpecialityRoutes($parent_speciality_id, $get_routes = true)
    {

        $parents = [];
        while ($parent_speciality_id != null) {
            $speciality = DB::table(Speciality::tableName)->where('id', $parent_speciality_id)->first(['id', 'title', 'parent_speciality_id']);
            if ($get_routes) {
                $speciality->url = route('admin.speciality.index', ['parent_speciality_id' => $parent_speciality_id]);
            }
            $parent_speciality_id = $speciality->parent_speciality_id;
            $parents[] = $speciality;
        }
        $parents = array_reverse($parents);
        return $parents;
    }

    public static function getParentRoute($parent_id, $table_name, $route_name, $type = null, $get_routes = true)
    {
        $allCategories = DB::table($table_name)
            ->select('id', 'title', 'parent_id')
            ->get()
            ->keyBy('id');

        $parents = [];
        while ($parent_id !== null && isset($allCategories[$parent_id])) {
            $category = $allCategories[$parent_id];

            if ($get_routes) {
                $routeParams = ['parent_id' => $parent_id];
                if (!is_null($type)) {
                    $routeParams['type'] = $type;
                }
                $category->url = route("admin.{$route_name}.index", $routeParams);
            }

            $parents[] = $category;
            $parent_id = $category->parent_id;
        }

        return array_reverse($parents);
    }

    public static function  deleteCategoryRecursively($categoryId)
    {
        $childCategories = BlogCategory::where('parent_id', $categoryId)->get();
        foreach ($childCategories as $child) {
            self::deleteCategoryRecursively($child->id);
        }
        Blog::where('blog_category_id', $categoryId)->delete();
        BlogCategory::where('id', $categoryId)->delete();
    }

    public static function getSetting($key,$direct=false){
        $s=DB::table('settings')->where('key',$key)->select('value')->first();
        return $direct?($s!=null?$s->value:null):($s!=null?json_decode($s->value):null);
    }

   public static function setSetting($key,$value,$direct=false){
        $s=Setting::where('key',$key)->first();
        if($s==null){
            $s=new Setting();
            $s->key=$key;
        }
        if($direct){
            $s->value=$value;
        }else{

            $s->value=json_encode($value);
        }
        $s->save();
        return $s;
    }

}
