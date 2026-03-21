<?php

namespace App\Http\Controllers;

use App\Models\ContactReply;
use Illuminate\Http\Request;

/**
 * Handles inbound email webhook from mail services (SendGrid, Mailgun, etc.)
 *
 * To enable inbound reply reflection, configure your mail service to POST
 * incoming emails to: /webhook/inbound-mail
 *
 * The reply token is embedded in the Reply-To address:
 *   reply+{token}@yourdomain.com
 *
 * The token is extracted to find the original contact thread.
 */
class InboundMailController extends Controller
{
    public function handle(Request $request)
    {
        // Extract recipient address from webhook payload
        // Supports SendGrid (to) and Mailgun (recipient) formats
        $to = $request->input('to') ?? $request->input('recipient') ?? '';

        // Extract token from address like: reply+TOKEN@domain.com
        if (!preg_match('/\+([a-zA-Z0-9]{32})@/', $to, $matches)) {
            return response()->json(['error' => 'token not found'], 400);
        }

        $token = $matches[1];

        // Find the outbound reply that generated this token
        $originalReply = ContactReply::where('reply_token', $token)->first();
        if (!$originalReply) {
            return response()->json(['error' => 'unknown token'], 404);
        }

        // Extract email body (plain text preferred)
        $body = $request->input('text')       // SendGrid plain text
            ?? $request->input('body-plain')  // Mailgun plain text
            ?? $request->input('body')
            ?? '';

        // Strip quoted original content (lines starting with ">")
        $lines = explode("\n", $body);
        $cleanLines = [];
        foreach ($lines as $line) {
            if (str_starts_with(ltrim($line), '>')) {
                break; // stop at quoted section
            }
            $cleanLines[] = $line;
        }
        $body = rtrim(implode("\n", $cleanLines));

        if (empty($body)) {
            return response()->json(['ok' => true, 'skipped' => 'empty body']);
        }

        ContactReply::create([
            'contact_id' => $originalReply->contact_id,
            'direction'  => 'inbound',
            'body'       => $body,
        ]);

        return response()->json(['ok' => true]);
    }
}
