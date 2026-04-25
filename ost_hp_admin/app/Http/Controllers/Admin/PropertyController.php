<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Property;
use App\Models\PropertyConsent;
use App\Models\ViewingReservation;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        $validated['published'] = $request->boolean('published');

        $mainImage = $this->encodeMainImage($request);
        if ($mainImage) {
            $validated = array_merge($validated, $mainImage);
        }

        $extra = $this->encodeExtraImages($request);
        if ($extra) {
            $validated['images']       = $extra['keys'];
            $validated['images_data']  = $extra['data'];
            $validated['images_mimes'] = $extra['mimes'];
        }

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
            $mainImage = $this->encodeMainImage($request);
            if ($mainImage) {
                $validated = array_merge($validated, $mainImage);
            }
        }

        // 削除指定された追加画像を先に処理
        if ($request->has('delete_images')) {
            $toDelete      = $request->input('delete_images', []);
            $existingKeys  = $property->images ?? [];
            $existingData  = $property->images_data ?? [];
            $existingMimes = $property->images_mimes ?? [];

            $newKeys = $newData = $newMimes = [];
            foreach ($existingKeys as $i => $key) {
                if (!in_array($key, $toDelete)) {
                    $newKeys[]  = $key;
                    $newData[]  = $existingData[$i] ?? null;
                    $newMimes[] = $existingMimes[$i] ?? null;
                }
            }
            $validated['images']       = $newKeys;
            $validated['images_data']  = $newData;
            $validated['images_mimes'] = $newMimes;
        }

        // 追加画像の追加
        $extra = $this->encodeExtraImages($request);
        if ($extra) {
            $baseKeys  = $validated['images']       ?? ($property->images ?? []);
            $baseData  = $validated['images_data']  ?? ($property->images_data ?? []);
            $baseMimes = $validated['images_mimes'] ?? ($property->images_mimes ?? []);

            $validated['images']       = array_merge($baseKeys, $extra['keys']);
            $validated['images_data']  = array_merge($baseData, $extra['data']);
            $validated['images_mimes'] = array_merge($baseMimes, $extra['mimes']);
        }

        $property->update($validated);

        return redirect()->route('admin.properties.edit', $property)
            ->with('success', '物件情報を更新しました。');
    }

    public function destroy(Property $property)
    {
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
            $encoded = $this->encodeFile($request->file('viewing_keybbox_image'));
            $data['viewing_keybbox_image']      = $encoded['name'];
            $data['viewing_keybbox_image_data'] = $encoded['data'];
            $data['viewing_keybbox_image_mime'] = $encoded['mime'];
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
            $encoded = $this->encodeFile($request->file('viewing_keybbox_image'));
            $data['viewing_keybbox_image']      = $encoded['name'];
            $data['viewing_keybbox_image_data'] = $encoded['data'];
            $data['viewing_keybbox_image_mime'] = $encoded['mime'];
        } elseif ($request->boolean('delete_viewing_keybbox_image')) {
            $data['viewing_keybbox_image']      = null;
            $data['viewing_keybbox_image_data'] = null;
            $data['viewing_keybbox_image_mime'] = null;
        }

        $property->update($data);

        return back()->with('success', '内見予約設定を更新しました。');
    }

    public function consents(Property $property)
    {
        $consents = $property->consents()->latest()->get();
        return view('admin.properties.consents', compact('property', 'consents'));
    }

    public function consentShow(Property $property, PropertyConsent $consent)
    {
        abort_if($consent->property_id !== $property->id, 404);
        return view('admin.properties.consent-show', compact('property', 'consent'));
    }

    public function viewings(Property $property)
    {
        $viewings = $property->viewingReservations()->latest()->get();
        return view('admin.properties.viewings', compact('property', 'viewings'));
    }

    public function viewingShow(Property $property, ViewingReservation $viewing)
    {
        abort_if($viewing->property_id !== $property->id, 404);
        return view('admin.properties.viewing-show', compact('property', 'viewing'));
    }

    public function consentBusinessCard(Property $property, PropertyConsent $consent)
    {
        abort_if($consent->property_id !== $property->id, 404);
        abort_unless($consent->business_card_data, 404);

        $data = base64_decode($consent->business_card_data);
        $mime = $consent->business_card_mime ?? 'application/octet-stream';
        $name = $consent->business_card ?? 'business_card';

        return response($data, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="' . $name . '"');
    }

    public function viewingBusinessCard(Property $property, ViewingReservation $viewing)
    {
        abort_if($viewing->property_id !== $property->id, 404);
        abort_unless($viewing->business_card_data, 404);

        $data = base64_decode($viewing->business_card_data);
        $mime = $viewing->business_card_mime ?? 'application/octet-stream';
        $name = $viewing->business_card ?? 'business_card';

        return response($data, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="' . $name . '"');
    }

    public function mainImage(Property $property)
    {
        abort_unless($property->main_image_data, 404);

        $data = base64_decode($property->main_image_data);
        $mime = $property->main_image_mime ?? 'application/octet-stream';
        $name = $property->main_image ?? 'image';

        return response($data, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="' . $name . '"');
    }

    public function propertyImage(Property $property, string $key)
    {
        $keys  = $property->images ?? [];
        $index = array_search($key, $keys);
        abort_if($index === false, 404);

        $dataArr  = $property->images_data ?? [];
        $mimeArr  = $property->images_mimes ?? [];
        $rawData  = $dataArr[$index] ?? null;
        abort_unless($rawData, 404);

        $data = base64_decode($rawData);
        $mime = $mimeArr[$index] ?? 'application/octet-stream';

        return response($data, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline');
    }

    public function keybboxImage(Property $property)
    {
        abort_unless($property->viewing_keybbox_image_data, 404);

        $data = base64_decode($property->viewing_keybbox_image_data);
        $mime = $property->viewing_keybbox_image_mime ?? 'application/octet-stream';
        $name = $property->viewing_keybbox_image ?? 'image';

        return response($data, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="' . $name . '"');
    }

    public function ownerEdit(Property $property)
    {
        $owners = Owner::orderBy('kana')->orderBy('name')->get();
        return view('admin.properties.owner', compact('property', 'owners'));
    }

    public function ownerUpdate(Property $property, Request $request)
    {
        $request->validate([
            'owner_id' => ['nullable', 'exists:owners,id'],
        ]);

        $property->update(['owner_id' => $request->owner_id ?: null]);

        return back()->with('success', 'オーナーを設定しました。');
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

    private function encodeFile(UploadedFile $file): array
    {
        return [
            'name' => $file->getClientOriginalName(),
            'data' => base64_encode(file_get_contents($file->getRealPath())),
            'mime' => $file->getMimeType() ?? $file->getClientMimeType(),
        ];
    }

    private function encodeMainImage(Request $request): ?array
    {
        if (!$request->hasFile('main_image')) return null;
        $encoded = $this->encodeFile($request->file('main_image'));
        return [
            'main_image'      => $encoded['name'],
            'main_image_data' => $encoded['data'],
            'main_image_mime' => $encoded['mime'],
        ];
    }

    private function encodeExtraImages(Request $request): ?array
    {
        if (!$request->hasFile('extra_images')) return null;
        $keys = $data = $mimes = [];
        foreach ($request->file('extra_images') as $file) {
            $encoded = $this->encodeFile($file);
            $keys[]  = Str::random(40);
            $data[]  = $encoded['data'];
            $mimes[] = $encoded['mime'];
        }
        return ['keys' => $keys, 'data' => $data, 'mimes' => $mimes];
    }
}
