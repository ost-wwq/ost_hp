<?php

namespace App\Http\Controllers;

use App\Mail\PropertyConsentMail;
use App\Models\Property;
use App\Models\PropertyConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyConsentController extends Controller
{
    public function show(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        if (! $request->session()->get("pin_verified_{$token}")) {
            return redirect()->route('property.confirm', $token);
        }

        return view('property-consent', compact('property', 'token'));
    }

    public function store(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        if (! $request->session()->get("pin_verified_{$token}")) {
            return redirect()->route('property.confirm', $token);
        }

        $request->validate([
            'name'          => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'string', 'max:20'],
            'email'         => ['required', 'email', 'max:200'],
            'business_card' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'ad_types'      => ['required', 'array', 'min:1'],
            'ad_types.*'    => ['string', 'in:own_hp,suumo,homes,athome,store,other'],
            'ad_other_text' => ['nullable', 'required_if:ad_types.*,other', 'string', 'max:200'],
            'ad_consent'    => ['accepted'],
            'privacy'       => ['accepted'],
        ], [
            'name.required'     => 'お名前を入力してください。',
            'phone.required'    => '電話番号を入力してください。',
            'email.required'    => 'メールアドレスを入力してください。',
            'email.email'       => '正しいメールアドレスを入力してください。',
            'ad_types.required'      => '広告宣伝の種類を1つ以上選択してください。',
            'ad_types.min'           => '広告宣伝の種類を1つ以上選択してください。',
            'ad_other_text.required_if' => '「その他」を選択した場合は内容を入力してください。',
            'ad_consent.accepted'    => '注意事項を確認し、同意してください。',
            'privacy.accepted'       => 'プライバシーポリシーに同意してください。',
        ]);

        $businessCardPath = null;
        if ($request->hasFile('business_card')) {
            $businessCardPath = $request->file('business_card')
                ->store('business_cards', 'public_uploads');
        }

        $consent = PropertyConsent::create([
            'property_id'   => $property->id,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'business_card' => $businessCardPath,
            'ad_types'      => $request->ad_types,
            'ad_other_text' => in_array('other', $request->ad_types ?? []) ? $request->ad_other_text : null,
        ]);

        Mail::to($consent->email)->send(new PropertyConsentMail($consent));

        return redirect()->route('property.consent.complete', $token);
    }

    public function complete(string $token, Request $request)
    {
        $property = Property::where('confirm_token', $token)->firstOrFail();

        if (! $request->session()->get("pin_verified_{$token}")) {
            return redirect()->route('property.confirm', $token);
        }

        return view('property-consent-complete', compact('property'));
    }
}
