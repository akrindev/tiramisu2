<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function badword()
  {
    $data = Setting::first();

    return view('admin.sb-admin.setting', compact('data'));
  }

  public function updateBadword()
  {
    $data = [
    	'badword'	=> request()->badword
    ];

    $setting = Setting::first();
    $setting->body = $data;
    $setting->save();

    return response()->json(['success' => true]);
  }
}