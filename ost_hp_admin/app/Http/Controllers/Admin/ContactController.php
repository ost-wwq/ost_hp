<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Contact::latest();

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($filter === 'read') {
            $query->whereNotNull('read_at');
        }

        $contacts = $query->paginate(20)->withQueryString();
        $unreadCount = Contact::whereNull('read_at')->count();

        return view('admin.contacts.index', compact('contacts', 'unreadCount', 'filter'));
    }

    public function show(Contact $contact)
    {
        $contact->markAsRead();
        $replies = $contact->replies;
        return view('admin.contacts.show', compact('contact', 'replies'));
    }

    public function reply(Request $request, Contact $contact)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $token = Str::random(32);

        $reply = ContactReply::create([
            'contact_id'  => $contact->id,
            'direction'   => 'outbound',
            'body'        => $request->input('body'),
            'reply_token' => $token,
        ]);

        Mail::to($contact->email)->send(new ContactReplyMail($contact, $reply));

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', '返信を送信しました。');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'お問い合わせを削除しました。');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        Contact::whereIn('id', $ids)->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', count($ids) . ' 件のお問い合わせを削除しました。');
    }

    public function markRead(Contact $contact)
    {
        $contact->markAsRead();
        return back()->with('success', '既読にしました。');
    }

    public function markUnread(Contact $contact)
    {
        $contact->update(['read_at' => null]);
        return back()->with('success', '未読に戻しました。');
    }
}
