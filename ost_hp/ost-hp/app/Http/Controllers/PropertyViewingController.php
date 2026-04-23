<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\ViewingReservation;
use Illuminate\Http\Request;

class PropertyViewingController extends Controller
{
    public function show(string $token)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        return view('property-viewing', compact('property'));
    }

    public function store(string $token, Request $request)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        $validTimes = [];
        for ($h = 9; $h <= 19; $h++) {
            $validTimes[] = sprintf('%02d:00', $h);
            if ($h < 19) $validTimes[] = sprintf('%02d:30', $h);
        }

        $request->validate([
            'name'          => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'string', 'max:20'],
            'email'         => ['required', 'email', 'max:200'],
            'business_card' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
            'reserved_date' => ['required', 'date', 'after_or_equal:today'],
            'reserved_time' => ['required', 'in:' . implode(',', $validTimes)],
            'privacy'       => ['accepted'],
        ], [
            'name.required'                => 'お名前を入力してください。',
            'phone.required'               => '電話番号を入力してください。',
            'email.required'               => 'メールアドレスを入力してください。',
            'email.email'                  => '正しいメールアドレスを入力してください。',
            'reserved_date.required'       => '予約日を入力してください。',
            'reserved_date.after_or_equal' => '予約日は本日以降の日付を入力してください。',
            'reserved_time.required'       => '予約時間を選択してください。',
            'reserved_time.in'             => '正しい予約時間を選択してください。',
            'privacy.accepted'             => 'プライバシーポリシーに同意してください。',
        ]);

        $businessCardPath = null;
        if ($request->hasFile('business_card')) {
            $businessCardPath = $request->file('business_card')
                ->store('business_cards', 'public_uploads');
        }

        ViewingReservation::create([
            'property_id'   => $property->id,
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'business_card' => $businessCardPath,
            'reserved_date' => $request->reserved_date,
            'reserved_time' => $request->reserved_time,
        ]);

        return redirect()->route('property.viewing.complete', $token);
    }

    public function complete(string $token)
    {
        $property = Property::where('viewing_token', $token)
            ->where('viewing_enabled', true)
            ->firstOrFail();

        return view('property-viewing-complete', compact('property'));
    }
}
