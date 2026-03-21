<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'broker_pin'     => Setting::get('broker_pin', '0000'),
            'broker_enabled' => Setting::get('broker_enabled', '1'),
            'broker_title'   => Setting::get('broker_title', '物件ご紹介可能確認'),
            'broker_note'    => Setting::get('broker_note', ''),
        ];

        $brokerUrl = url('/broker');

        return view('admin.settings.index', compact('settings', 'brokerUrl'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'broker_pin' => ['required', 'digits:4'],
            'broker_title' => ['required', 'string', 'max:100'],
            'broker_note'  => ['nullable', 'string', 'max:500'],
        ]);

        Setting::setMany([
            'broker_pin'     => $request->input('broker_pin'),
            'broker_enabled' => $request->boolean('broker_enabled') ? '1' : '0',
            'broker_title'   => $request->input('broker_title'),
            'broker_note'    => $request->input('broker_note', ''),
        ]);

        return back()->with('success', '設定を保存しました。');
    }
}
