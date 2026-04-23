<?php

namespace App\Http\Controllers;

use App\Mail\PropertyRecordCodeMail;
use App\Models\Property;
use App\Models\PropertyConsent;
use App\Models\ViewingReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyRecordsController extends Controller
{
    public function showEmailForm(string $token)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();
        return view('property-records-email', compact('property', 'token'));
    }

    public function sendCode(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        $request->validate(['email' => ['required', 'email']], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email'    => '正しいメールアドレスを入力してください。',
        ]);

        $email = $request->input('email');
        $code  = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $request->session()->put("record_code_{$token}", [
            'code'       => $code,
            'email'      => $email,
            'expires_at' => now()->addMinutes(10)->timestamp,
        ]);

        Mail::to($email)->send(new PropertyRecordCodeMail($code, $property->title));

        return redirect()->route('property.records.code', $token)
            ->with('email_hint', substr($email, 0, 3) . str_repeat('*', max(0, strpos($email, '@') - 3)) . substr($email, strpos($email, '@')));
    }

    public function showCodeForm(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();
        $hint = session('email_hint', '');
        return view('property-records-code', compact('property', 'token', 'hint'));
    }

    public function verifyCode(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        $request->validate(['code' => ['required', 'digits:6']], [
            'code.required' => '認証コードを入力してください。',
            'code.digits'   => '6桁の数字を入力してください。',
        ]);

        $stored = $request->session()->get("record_code_{$token}");

        if (!$stored || now()->timestamp > $stored['expires_at']) {
            return back()->withErrors(['code' => '認証コードの有効期限が切れています。再度メールアドレスを入力してください。']);
        }

        if ($request->input('code') !== $stored['code']) {
            return back()->withErrors(['code' => '認証コードが正しくありません。']);
        }

        $request->session()->put("records_verified_{$token}", $stored['email']);
        $request->session()->forget("record_code_{$token}");

        return redirect()->route('property.records.list', $token);
    }

    public function list(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        $email = $request->session()->get("records_verified_{$token}");
        if (!$email) {
            return redirect()->route('property.records.email', $token);
        }

        $viewings = ViewingReservation::where('property_id', $property->id)
            ->where('email', $email)->latest()->get();

        $consents = PropertyConsent::where('property_id', $property->id)
            ->where('email', $email)->latest()->get();

        return view('property-records-list', compact('property', 'token', 'viewings', 'consents', 'email'));
    }

    public function viewingDetail(string $token, int $id, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        $email = $request->session()->get("records_verified_{$token}");
        if (!$email) {
            return redirect()->route('property.records.email', $token);
        }

        $viewing = ViewingReservation::where('id', $id)
            ->where('property_id', $property->id)
            ->where('email', $email)
            ->firstOrFail();

        return view('property-records-viewing', compact('property', 'token', 'viewing'));
    }

    public function consentDetail(string $token, int $id, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        $email = $request->session()->get("records_verified_{$token}");
        if (!$email) {
            return redirect()->route('property.records.email', $token);
        }

        $consent = PropertyConsent::where('id', $id)
            ->where('property_id', $property->id)
            ->where('email', $email)
            ->firstOrFail();

        return view('property-records-consent', compact('property', 'token', 'consent'));
    }
}
