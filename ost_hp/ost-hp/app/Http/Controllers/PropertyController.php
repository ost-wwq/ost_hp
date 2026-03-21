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
}
