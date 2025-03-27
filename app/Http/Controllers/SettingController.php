<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

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
                ['TeamDescription', 2],
                ['TeamImage', 0],
            ],
            [
                ["homeSpecialityTitle", "views/front/cache/home/specialityTitle.blade.php"],
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

                    file_put_contents(resource_path($data[2]), view('admin.setting.template.' . $type, compact('curdata'))->render());
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
            $data = Helper::getSetting('contact') ?? ((object)([
                'map' => '',
                'email' => '',
                'phone' => '',
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
            return view('admin.setting.contact', compact('data'));
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
                'phone' => $request->phone ?? '',
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
            Helper::setSetting('contact', $data);
            Helper::putCache('home.footerLink', view('admin.setting.template.footer', compact('data'))->render());
            Helper::putCache('contact.index', view('admin.setting.template.contact', compact('data'))->render());
            Helper::putCache('contact.map', view('admin.setting.template.map', compact('data'))->render());
            return redirect()->back()->with('success', "Contact Saved Sucessfully");
        }
    }
}
