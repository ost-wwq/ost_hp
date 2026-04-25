<?php

namespace App\Http\Controllers;

use App\Mail\ViewingReservationAdminMail;
use App\Mail\ViewingReservationMail;
use App\Models\Property;
use App\Models\ViewingReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyViewingController extends Controller
{
    public function show(string $token, Request $request)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        if (! $request->session()->get("pin_verified_{$property->confirm_token}")) {
            return redirect()->route('property.confirm', $property->confirm_token);
        }

        return view('property-viewing', compact('property'));
    }

    public function store(string $token, Request $request)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        if (! $request->session()->get("pin_verified_{$property->confirm_token}")) {
            return redirect()->route('property.confirm', $property->confirm_token);
        }

        $validTimes = [];
        for ($h = 9; $h <= 19; $h++) {
            $validTimes[] = sprintf('%02d:00', $h);
            if ($h < 19) $validTimes[] = sprintf('%02d:30', $h);
        }

        $request->validate([
            'name'             => ['required', 'string', 'max:100'],
            'phone'            => ['required', 'string', 'max:20'],
            'email'            => ['required', 'email', 'max:200'],
            'companions'       => ['required', 'integer', 'min:0', 'max:10'],
            'business_card'    => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
            'reserved_date'    => ['required', 'date', 'after_or_equal:today'],
            'reserved_time'    => ['required', 'in:' . implode(',', $validTimes)],
            'privacy'          => ['accepted'],
            'viewing_consent'  => ['accepted'],
        ], [
            'name.required'                   => '案内担当者名を入力してください。',
            'phone.required'                  => '電話番号を入力してください。',
            'email.required'                  => 'メールアドレスを入力してください。',
            'email.email'                     => '正しいメールアドレスを入力してください。',
            'companions.required'             => '同伴者人数を選択してください。',
            'companions.integer'              => '同伴者人数が正しくありません。',
            'reserved_date.required'          => '予約日を入力してください。',
            'reserved_date.after_or_equal'    => '予約日は本日以降の日付を入力してください。',
            'reserved_time.required'          => '予約時間を選択してください。',
            'reserved_time.in'                => '正しい予約時間を選択してください。',
            'privacy.accepted'                => 'プライバシーポリシーに同意してください。',
            'viewing_consent.accepted'        => '遵守事項承諾書に同意してください。',
        ]);

        $businessCardName = null;
        $businessCardData = null;
        $businessCardMime = null;
        if ($request->hasFile('business_card')) {
            $file = $request->file('business_card');
            $businessCardName = $file->getClientOriginalName();
            $businessCardData = base64_encode(file_get_contents($file->getRealPath()));
            $businessCardMime = $file->getMimeType();
        }

        $reservation = ViewingReservation::create([
            'property_id'        => $property->id,
            'name'               => $request->name,
            'phone'              => $request->phone,
            'email'              => $request->email,
            'companions'         => $request->companions,
            'business_card'      => $businessCardName,
            'business_card_data' => $businessCardData,
            'business_card_mime' => $businessCardMime,
            'reserved_date' => $request->reserved_date,
            'reserved_time' => $request->reserved_time,
        ]);

        Mail::to($reservation->email)->send(new ViewingReservationMail($reservation));
        Mail::to(config('mail.contact_to'))->send(new ViewingReservationAdminMail($reservation));

        return redirect()->route('property.viewing.complete', $token);
    }

    public function complete(string $token, Request $request)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        if (! $request->session()->get("pin_verified_{$property->confirm_token}")) {
            $request->session()->put("pin_redirect_{$property->confirm_token}", $request->url());
            return redirect()->route('property.confirm', $property->confirm_token);
        }

        return view('property-viewing-complete', compact('property'));
    }
}
