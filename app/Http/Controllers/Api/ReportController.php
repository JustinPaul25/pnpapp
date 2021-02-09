<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\CaseReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $report = CaseReport::create([
            'crime_id' => $request->input('crime_id'),
            // pag gipili niya nga crime type kay focus crime required sia mag input ug
            // focus crime type
            'focus_crime_type' => $request->input('focus_crime_type'),
            'complainant_id' => $request->input('complaint_id'),
            'reported_by' => $request->input('reported_by'), //<--String nani siya
            'prepared_id' => $request->input('prepared_id'),
            'case_status_id' => 1,
            'crime_date' => Carbon::now()->format('Y-m-d'), //<--field nga akong gi dungag
            'event_detail' => $request->input('event_detail'),
            'action_taken' => $request->input('action_taken'),
            'summary' => $request->input('summary'),
            'address' => $request->input('address'),
            'long' => $request->input('long'),
            'lat' => $request->input('lat'),
            'is_witness' => $request->input('is_witness')
        ]);

        if($request->hasFile('img')) {
            $report->addMedia($request->file('img'))->toMediaCollection('report-image');
        }

        if($request->hasFile('video')) {
            $report->addMedia($request->file('video'))->toMediaCollection('report-video');
        }

        return response()->json($report);
    }

    public function missingPerson()
    {
        return response()->json(CaseReport::where('crime_id', 4)->where('case_status_id', 3)->get());
    }

    public function mostWanted()
    {
        return response()->json(CaseReport::where('crime_id', 5)->where('case_status_id', 3)->get());
    }

    public function lostAndFound()
    {
        return response()->json(CaseReport::where('crime_id', 6)->where('case_status_id', 3)->get());
    }
}
