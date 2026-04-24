<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::withCount('properties')->latest()->get();
        return view('admin.owners.index', compact('owners'));
    }

    public function create()
    {
        $owner = new Owner();
        return view('admin.owners.form', compact('owner'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        Owner::create($validated);

        return redirect()->route('admin.owners.index')
            ->with('success', 'オーナーを登録しました。');
    }

    public function show(Owner $owner)
    {
        $owner->load('properties');
        return view('admin.owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        return view('admin.owners.form', compact('owner'));
    }

    public function update(Owner $owner, Request $request)
    {
        $validated = $this->validateRequest($request);
        $owner->update($validated);

        return redirect()->route('admin.owners.show', $owner)
            ->with('success', 'オーナー情報を更新しました。');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()->route('admin.owners.index')
            ->with('success', 'オーナーを削除しました。');
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'kana'    => ['nullable', 'string', 'max:100'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'email'   => ['nullable', 'email', 'max:200'],
            'address' => ['nullable', 'string', 'max:300'],
            'note'    => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required' => '氏名を入力してください。',
            'email.email'   => '正しいメールアドレスを入力してください。',
        ]);
    }
}
