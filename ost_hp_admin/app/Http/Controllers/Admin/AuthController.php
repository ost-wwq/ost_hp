<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.contacts.index');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $correct = Hash::check($request->password, config('admin.password_hash'));

        if (!$correct) {
            return back()->withErrors(['password' => 'パスワードが正しくありません。']);
        }

        $request->session()->put('admin_logged_in', true);
        $request->session()->regenerate();

        return redirect()->route('admin.contacts.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function showChangePassword()
    {
        return view('admin.password.edit');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, config('admin.password_hash'))) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        $newHash = Hash::make($request->new_password);
        $this->updateEnvPasswordHash($newHash);

        return back()->with('success', 'パスワードを変更しました。次回ログイン時から新しいパスワードをお使いください。');
    }

    private function updateEnvPasswordHash(string $hash): void
    {
        $envPath = base_path('.env');
        $content = file_get_contents($envPath);

        if (preg_match('/^ADMIN_PASSWORD_HASH=.*/m', $content)) {
            $content = preg_replace_callback(
                '/^ADMIN_PASSWORD_HASH=.*/m',
                fn() => 'ADMIN_PASSWORD_HASH=' . $hash,
                $content
            );
        } else {
            $content .= "\nADMIN_PASSWORD_HASH={$hash}";
        }

        file_put_contents($envPath, $content);

        // キャッシュされた設定をリセット
        config(['admin.password_hash' => $hash]);
    }
}
