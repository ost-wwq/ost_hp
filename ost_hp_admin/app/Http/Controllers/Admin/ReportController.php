<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReportMail;
use App\Models\Property;
use App\Models\PropertyConsent;
use App\Models\Report;
use App\Models\ViewingReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    public function create(Request $request)
    {
        $sentTo     = $request->query('sent_to');
        $propertyId = $request->query('property_id');
        $properties = Property::orderBy('title')->get(['id', 'title']);
        return view('admin.reports.create', compact('sentTo', 'propertyId', 'properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_from'   => ['required', 'date'],
            'date_to'     => ['required', 'date', 'gte:date_from'],
            'sent_to'     => ['required', 'email'],
            'property_id' => ['nullable', 'exists:properties,id'],
            'free_text'   => ['nullable', 'string', 'max:2000'],
        ]);

        $from       = $request->date_from;
        $to         = $request->date_to;
        $propertyId = $request->property_id ?: null;

        $consentsQ = PropertyConsent::with('property')
            ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        if ($propertyId) {
            $consentsQ->where('property_id', $propertyId);
        }
        $consents = $consentsQ->latest()->get();

        $viewingsQ = ViewingReservation::with('property')
            ->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        if ($propertyId) {
            $viewingsQ->where('property_id', $propertyId);
        }
        $viewings = $viewingsQ->latest()->get();

        $consentsData = $consents->map(fn($c) => [
            'property_title' => $c->property?->title ?? '—',
            'name'           => $c->name,
            'phone'          => $c->phone,
            'email'          => $c->email,
            'ad_types'       => $c->ad_types ?? [],
            'ad_other_text'  => $c->ad_other_text,
            'created_at'     => $c->created_at->format('Y/m/d H:i'),
        ])->toArray();

        $viewingsData = $viewings->map(fn($v) => [
            'property_title' => $v->property?->title ?? '—',
            'name'           => $v->name,
            'phone'          => $v->phone,
            'email'          => $v->email,
            'reserved_date'  => $v->reserved_date,
            'reserved_time'  => $v->reserved_time,
            'companions'     => $v->companions,
            'created_at'     => $v->created_at->format('Y/m/d H:i'),
        ])->toArray();

        $report = Report::create([
            'property_id'    => $propertyId,
            'date_from'      => $from,
            'date_to'        => $to,
            'sent_to'        => $request->sent_to,
            'free_text'      => $request->free_text ?: null,
            'consents_count' => $consents->count(),
            'viewings_count' => $viewings->count(),
            'consents_data'  => $consentsData,
            'viewings_data'  => $viewingsData,
        ]);

        Mail::to($request->sent_to)->send(new ReportMail($report));

        return redirect()->route('admin.reports.index')
            ->with('success', '報告メールを送信し、履歴に保存しました。');
    }

    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }
}
