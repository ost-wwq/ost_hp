<?php

namespace App\Http\Controllers;

use App\Mail\PropertyConsentMail;
use App\Models\Property;
use App\Models\PropertyConsent;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    private function requireBrokerAuth()
    {
        if (Setting::get('broker_enabled', '1') !== '1') abort(404);
        if (!session('broker_authed')) abort(403);
    }

    // 広告掲載許可申請フォーム表示
    public function showConsent(Property $property)
    {
        $this->requireBrokerAuth();
        return view('broker.consent', compact('property'));
    }

    // 広告掲載許可申請フォーム送信
    public function storeConsent(Request $request, Property $property)
    {
        $this->requireBrokerAuth();

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'string', 'max:20'],
            'email'         => ['required', 'email', 'max:200'],
            'business_card' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'ad_types'      => ['required', 'array', 'min:1'],
            'ad_types.*'    => ['string', 'in:own_hp,suumo,homes,athome,store,other'],
            'ad_other_text' => ['nullable', 'required_if:ad_types.*,other', 'string', 'max:200'],
            'ad_consent'    => ['accepted'],
            'privacy'       => ['accepted'],
        ]);

        $cardPath = null;
        if ($request->hasFile('business_card')) {
            $cardPath = $request->file('business_card')->store('business_cards', 'public');
        }

        $consent = PropertyConsent::create([
            'property_id'   => $property->id,
            'name'          => $validated['name'],
            'phone'         => $validated['phone'],
            'email'         => $validated['email'],
            'business_card' => $cardPath,
            'ad_types'      => $validated['ad_types'],
            'ad_other_text' => in_array('other', $validated['ad_types']) ? ($validated['ad_other_text'] ?? null) : null,
        ]);

        Mail::to($consent->email)->send(new PropertyConsentMail($consent));

        return redirect()->route('broker.consent.complete', $property);
    }

    // 広告掲載許可申請完了画面
    public function consentComplete(Property $property)
    {
        $this->requireBrokerAuth();
        return view('broker.consent_complete', compact('property'));
    }
}
