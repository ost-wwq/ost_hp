<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Setting;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    // PIN入力フォーム
    public function showPin()
    {
        if (Setting::get('broker_enabled', '1') !== '1') {
            abort(404);
        }

        // すでに認証済みならそのまま一覧へ
        if (session('broker_authed')) {
            return redirect()->route('broker.properties');
        }

        $title = Setting::get('broker_title', '物件ご紹介可能確認');
        return view('broker.pin', compact('title'));
    }

    // PIN認証処理
    public function verifyPin(Request $request)
    {
        if (Setting::get('broker_enabled', '1') !== '1') {
            abort(404);
        }

        $request->validate([
            'pin' => ['required', 'digits:4'],
        ]);

        $correct = Setting::get('broker_pin', '0000');

        if ($request->input('pin') !== $correct) {
            return back()->withErrors(['pin' => 'PINが正しくありません。']);
        }

        $request->session()->put('broker_authed', true);
        return redirect()->route('broker.properties');
    }

    // 物件一覧（認証後）
    public function properties()
    {
        if (Setting::get('broker_enabled', '1') !== '1') {
            abort(404);
        }
        if (!session('broker_authed')) {
            return redirect()->route('broker.pin');
        }

        $title = Setting::get('broker_title', '物件ご紹介可能確認');
        $note  = Setting::get('broker_note', '');

        $properties = Property::latest()
            ->get()
            ->groupBy('property_type');

        $updatedAt = Property::latest('updated_at')->value('updated_at');

        return view('broker.properties', compact('title', 'note', 'properties', 'updatedAt'));
    }

    // ログアウト（PIN セッションクリア）
    public function logout(Request $request)
    {
        $request->session()->forget('broker_authed');
        return redirect()->route('broker.pin');
    }
}
