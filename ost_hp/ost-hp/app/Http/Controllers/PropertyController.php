<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $type   = $request->query('type');
        $status = $request->query('status', 'available');

        $query = Property::published()->latest();

        if ($type) {
            $query->where('property_type', $type);
        }
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $properties = $query->paginate(12)->withQueryString();

        return view('properties.index', compact('properties', 'type', 'status'));
    }

    public function show(Property $property)
    {
        abort_unless($property->published, 404);

        $related = Property::published()
            ->where('id', '!=', $property->id)
            ->where('property_type', $property->property_type)
            ->limit(3)
            ->get();

        return view('properties.show', compact('property', 'related'));
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

        $dataArr = $property->images_data ?? [];
        $mimeArr = $property->images_mimes ?? [];
        $rawData = $dataArr[$index] ?? null;
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
}
