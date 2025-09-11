<?php

namespace App;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Setting;
use App\Models\Speciality;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Helper
{

    const blog_types = [
        1 => 'blog',
        2 => 'news',
        3 => 'event',
        4 => 'update',
        5 => 'case_study',
        6 => 'news_letter',
        7 => 'acedemic_program',
        8 => 'doctor_article',
        9 => 'Research',
        10 => 'Notice',
        11 => 'Journal'
    ];

    const blog_type_blog = 1;
    const blog_type_news = 2;
    const blog_type_event = 3;
    const blog_type_update = 4;
    const blog_type_case_study = 5;
    const blog_type_news_letter = 6;
    const blog_type_acedemic_program = 7;
    const blog_type_research = 9;
    const blog_type_notice = 10;
    const blog_type_journal = 11;


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
    public static function convertDateToInteger($date)
    {
        // Parse the date string and return the Unix timestamp
        return Carbon::parse($date)->timestamp;
    }
    public static function convertIntegerToDate($timestamp)
    {
        return Carbon::createFromTimestamp($timestamp)->toDateString();
    }
    public static function formatTimestampToDateString(int $timestamp): string
    {
        $date = Carbon::createFromTimestamp($timestamp);
        return $date->format('d F, Y');
    }

    public static function getMonthName(int $timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp)->format('M');
    }

    public static function getDayNumber($date): int
    {
        return Carbon::parse($date)->day;
    }

    public static function getMonthYear(int $timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp)->format('F_Y');
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

    public static function getSetting($key, $direct = false)
    {
        // Check if the setting is already cached
        $cacheKey = 'setting_' . $key;
        return Cache::rememberForever($cacheKey, function () use ($key, $direct) {

            $s = DB::table('settings')->where('key', $key)->select('value')->first();
            return $direct ? ($s != null ? $s->value : null) : ($s != null ? json_decode($s->value) : null);
        });
    }

    public static function setSetting($key, $value, $direct = false)
    {
        $s = Setting::where('key', $key)->first();
        if ($s == null) {
            $s = new Setting();
            $s->key = $key;
        }
        if ($direct) {
            $s->value = $value;
        } else {

            $s->value = json_encode($value);
        }
        $s->save();

        // Clear the cache for the setting
        $cacheKey = 'setting_' . $key;
        Cache::forget($cacheKey);
        return $s;
    }

    public static function putCache($_filePath, $content)
    {
        $pathDatas = explode('.', $_filePath);
        //append .balde.php to last element if not exists
        if (count($pathDatas) > 0) {
            $lastElement = $pathDatas[count($pathDatas) - 1];
            $pathDatas[count($pathDatas) - 1] .= '.blade.php';
        }

        $filePath = implode('/', $pathDatas);


        $filePath = resource_path("views/front/cache/" . $filePath);
        // Extract the directory path from the file path
        $directoryPath = dirname($filePath);

        // Ensure the directory exists, if not create it
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Put the content to the file path
        file_put_contents($filePath, $content);
    }


    /**
     * Get the cache file path
     * @param string $filePath The file path where the cache should be stored
     * @param array $data The meta content to be cached ['title' => '', 'description' => '', 'keywords' => '', 'image' => null, 'url' => null]
     * @return void
     */


    public static function putMetaCache($filePath, array $data = [])
    {
        // Convert dot notation to directory structure
        $pathDatas = explode('.', $filePath);
        // Append .blade.php to last element if not exists
        if (count($pathDatas) > 0) {
            $pathDatas[count($pathDatas) - 1] .= '.blade.php';
        }
        $filePath = implode('/', $pathDatas);
        $filePath = resource_path("views/front/cache/meta/" . $filePath);
        $directoryPath = dirname($filePath);

        // Ensure the directory exists
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Extract values with defaults
        $title = ($data['title'] ?? null) ? $data['title'] . ' | Kathmandu Medical College' : 'Kathmandu Medical College';
        $description = $data['description'] ?? 'Kathmandu Medical College is a super-specialty healthcare hospital in Nepal, providing high-quality treatment including heart, liver, kidney transplants, and cancer care.';
        $keywords = $data['keywords'] ?? 'hospital, healthcare, medical services, patient care, emergency services, ';
        $image = $data['image'] ?? asset('front/assets/img/meta-image.png');
        $url = $data['url'] ?? request()->url();

        // Generate and save meta content
        file_put_contents($filePath, self::makeMeta($title, $description, $keywords, $image, $url));
    }

    public static function makeMeta($title, $description, $keywords = '', $image = null, $url = null)
    {
        $url = $url ?? request()->url();
        $image = $image ?? self::getSetting('default_og_image', true);

        $html = '';

        // Basic meta
        $html .= "<title>{$title}</title>\n";
        $html .= "<meta name=\"description\" content=\"{$description}\">\n";

        if (!empty($keywords)) {
            $html .= "<meta name=\"keywords\" content=\"{$keywords}\">\n";
        }

        // Open Graph
        $html .= "<meta property=\"og:type\" content=\"website\">\n";
        $html .= "<meta property=\"og:url\" content=\"{$url}\">\n";
        $html .= "<meta property=\"og:title\" content=\"{$title}\">\n";
        $html .= "<meta property=\"og:description\" content=\"{$description}\">\n";

        if ($image) {
            $html .= "<meta property=\"og:image\" content=\"{$image}\">\n";
        }

        // Twitter Card
        $html .= "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
        $html .= "<meta name=\"twitter:url\" content=\"{$url}\">\n";
        $html .= "<meta name=\"twitter:title\" content=\"{$title}\">\n";
        $html .= "<meta name=\"twitter:description\" content=\"{$description}\">\n";


        if ($image) {
            $html .= "<meta name=\"twitter:image\" content=\"{$image}\">\n";
        }

        return $html;
    }

    public static function deleteCache($_filePath)
    {
        $pathDatas = explode('.', $_filePath);
        if (count($pathDatas) > 0) {
            $pathDatas[count($pathDatas) - 1] .= '.blade.php';
        }

        $filePath = implode('/', $pathDatas);
        $filePath = resource_path("views/front/cache/" . $filePath);
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }

        return false;
    }
    public static function deleteMetaCache($filePath)
    {
        $pathDatas = explode('.', $filePath);
        if (count($pathDatas) > 0) {
            $pathDatas[count($pathDatas) - 1] .= '.blade.php';
        }

        $filePath = implode('/', $pathDatas);
        $filePath = resource_path("views/front/cache/meta/" . $filePath);
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
        return false;
    }
}
