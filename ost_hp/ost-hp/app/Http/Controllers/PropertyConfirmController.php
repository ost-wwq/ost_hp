<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyConfirmController extends Controller
{
    public function show(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        if ($request->session()->get("pin_verified_{$token}")) {
            return view('property-confirm', compact('property'));
        }

        return view('property-confirm-pin', compact('token'));
    }

    public function verify(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        if ($request->input('pin') !== $property->confirm_pin) {
            abort(403, '確認番号が正しくありません。');
        }

        $request->session()->put("pin_verified_{$token}", true);

        return redirect()->route('property.confirm', $token);
    }
}
