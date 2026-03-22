<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ContactAutoReplyMail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // DBに保存
        Contact::create($validated);

        // 管理者への通知メール
        Mail::to(config('mail.contact_to'))->send(new ContactMail($validated));

        // ユーザーへの自動返信メール
        Mail::to($validated['email'])->send(new ContactAutoReplyMail($validated));

        return response()->json(['status' => 'ok']);
    }
}
