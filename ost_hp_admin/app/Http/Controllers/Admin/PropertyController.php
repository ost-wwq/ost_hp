<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $query = Property::latest();

        if ($filter === 'published') {
            $query->where('published', true);
        } elseif ($filter === 'draft') {
            $query->where('published', false);
        } elseif (in_array($filter, ['available', 'contract', 'closed'])) {
            $query->where('status', $filter);
        }

        $properties = $query->paginate(20)->withQueryString();

        return view('admin.properties.index', compact('properties', 'filter'));
    }

    public function create()
    {
        $property = new Property();
        return view('admin.properties.form', compact('property'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        $validated['main_image'] = $this->uploadMainImage($request);
        $validated['images']     = $this->uploadExtraImages($request);
        $validated['published']  = $request->boolean('published');

        Property::create($validated);

        return redirect()->route('admin.properties.index')
            ->with('success', '物件を登録しました。');
    }

    public function show(Property $property)
    {
        return view('admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('admin.properties.form', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $this->validateRequest($request);
        $validated['published'] = $request->boolean('published');

        // メイン画像の更新
        if ($request->hasFile('main_image')) {
            $this->deleteFile($property->main_image);
            $validated['main_image'] = $this->uploadMainImage($request);
        }

        // 追加画像の追加
        $extra = $this->uploadExtraImages($request);
        if ($extra) {
            $existing = $property->images ?? [];
            $validated['images'] = array_merge($existing, $extra);
        }

        // 削除指定された追加画像
        if ($request->has('delete_images')) {
            $toDelete = $request->input('delete_images', []);
            $remaining = array_filter($property->images ?? [], fn($p) => !in_array($p, $toDelete));
            foreach ($toDelete as $path) {
                $this->deleteFile($path);
            }
            $validated['images'] = array_values($remaining);
        }

        $property->update($validated);

        return redirect()->route('admin.properties.edit', $property)
            ->with('success', '物件情報を更新しました。');
    }

    public function destroy(Property $property)
    {
        // 画像ファイルを削除
        $this->deleteFile($property->main_image);
        foreach ($property->images ?? [] as $img) {
            $this->deleteFile($img);
        }
        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', '物件を削除しました。');
    }

    public function togglePublish(Property $property)
    {
        $property->update(['published' => !$property->published]);
        $msg = $property->published ? '物件を公開しました。' : '物件を非公開にしました。';
        return back()->with('success', $msg);
    }

    public function toggleConfirm(Property $property, Request $request)
    {
        if ($property->confirm_token) {
            $property->update(['confirm_token' => null, 'confirm_pin' => null]);
            $msg = '最新状態確認URLを無効にしました。';
        } else {
            $request->validate(['confirm_pin' => ['required', 'digits:4']]);
            $property->update([
                'confirm_token' => Str::uuid(),
                'confirm_pin'   => $request->confirm_pin,
            ]);
            $msg = '最新状態確認URLを有効にしました。';
        }
        return back()->with('success', $msg);
    }

    public function toggleViewing(Property $property, Request $request)
    {
        if ($property->viewing_enabled) {
            $property->update(['viewing_enabled' => false]);
            return back()->with('success', '内見予約設定を無効にしました。');
        }

        $request->validate([
            'viewing_keybbox_number'      => ['nullable', 'string', 'max:100'],
            'viewing_keybbox_image'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'viewing_keybbox_description' => ['nullable', 'string', 'max:2000'],
        ]);

        $data = [
            'viewing_enabled' => true,
            'viewing_token'   => $property->viewing_token ?? Str::uuid(),
        ];
        $data['viewing_keybbox_number']      = $request->input('viewing_keybbox_number');
        $data['viewing_keybbox_description'] = $request->input('viewing_keybbox_description');

        if ($request->hasFile('viewing_keybbox_image')) {
            $this->deleteFile($property->viewing_keybbox_image);
            $data['viewing_keybbox_image'] = $request->file('viewing_keybbox_image')
                ->store('properties', 'public_uploads');
        }

        $property->update($data);

        return back()->with('success', '内見予約設定を有効にしました。');
    }

    public function updateViewing(Property $property, Request $request)
    {
        $request->validate([
            'viewing_keybbox_number'      => ['nullable', 'string', 'max:100'],
            'viewing_keybbox_image'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'viewing_keybbox_description' => ['nullable', 'string', 'max:2000'],
        ]);

        $data = [];
        $data['viewing_keybbox_number']      = $request->input('viewing_keybbox_number');
        $data['viewing_keybbox_description'] = $request->input('viewing_keybbox_description');

        if ($request->hasFile('viewing_keybbox_image')) {
            $this->deleteFile($property->viewing_keybbox_image);
            $data['viewing_keybbox_image'] = $request->file('viewing_keybbox_image')
                ->store('properties', 'public_uploads');
        } elseif ($request->boolean('delete_viewing_keybbox_image')) {
            $this->deleteFile($property->viewing_keybbox_image);
            $data['viewing_keybbox_image'] = null;
        }

        $property->update($data);

        return back()->with('success', '内見予約設定を更新しました。');
    }

    // ---- private helpers ----

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'title'         => ['required', 'string', 'max:200'],
            'property_type' => ['required', 'string'],
            'status'        => ['required', 'in:available,contract,closed'],
            'price'         => ['required', 'integer', 'min:0'],
            'address'       => ['required', 'string', 'max:300'],
            'area'          => ['nullable', 'numeric', 'min:0'],
            'rooms'         => ['nullable', 'string', 'max:50'],
            'age'           => ['nullable', 'integer', 'min:0'],
            'description'   => ['nullable', 'string', 'max:5000'],
            'main_image'    => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:5120'],
        ]);
    }

    private function uploadMainImage(Request $request): ?string
    {
        if (!$request->hasFile('main_image')) return null;
        $file = $request->file('main_image');
        $path = $file->store('properties', 'public_uploads');
        return $path;
    }

    private function uploadExtraImages(Request $request): array
    {
        if (!$request->hasFile('extra_images')) return [];
        $paths = [];
        foreach ($request->file('extra_images') as $file) {
            $paths[] = $file->store('properties', 'public_uploads');
        }
        return $paths;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && file_exists(public_path('uploads/' . $path))) {
            unlink(public_path('uploads/' . $path));
        }
    }
}
