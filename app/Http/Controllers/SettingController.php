<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * prevent badword
     *
     * @return void
     */
    public function badword()
    {
        $data = Setting::first();

        return view('admin.sb-admin.setting', compact('data'));
    }

    /**
     * update badword
     *
     * @return void
     */
    public function updateBadword()
    {
        $data = [
            'badword'    => request()->badword
        ];

        $setting = Setting::first();
        $setting->body = $data;
        $setting->save();

        return response()->json(['success' => true]);
    }
}
