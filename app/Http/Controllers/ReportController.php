<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use Illuminate\Http\Request;
use App\Http\Resources\CaseReport\CaseReportCollection;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $report = CaseReport::create([
            'crime_id' => $request->input('crime_id'),
            // pag gipili niya nga crime type kay focus crime required sia mag input ug
            // focus crime type
            'focus_crime_type' => $request->input('focus_crime_type'),
            'reported_by' => $request->input('reported_by'),
            'prepared_id' => auth()->user()->id,
            'case_status_id' => 3,
            'crime_date' => $request->input('crime_date'),
            'event_detail' => $request->input('event_detail'),
            'action_taken' => $request->input('action_taken'),
            'summary' => $request->input('summary'),
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'long' => $request->input('long'),
            'lat' => $request->input('lat'),
            'is_witness' => $request->input('is_witness')
        ]);

        if($request->hasFile('img')) {
            $report->addMedia($request->file('img'))->toMediaCollection('report-image');
        }

        return response()->json($report);
    }

    public function update(Request $request)
    {
        $report = CaseReport::findOrFail($request->input('id'));

        $report->update([
            'crime_id' => $request->input('crime_id'),
            // pag gipili niya nga crime type kay focus crime required sia mag input ug
            // focus crime type
            'focus_crime_type' => $request->input('focus_crime_type'),
            'reported_by' => $request->input('reported_by'),
            'prepared_id' => auth()->user()->id,
            'case_status_id' => 3,
            'crime_date' => $request->input('crime_date'),
            'event_detail' => $request->input('event_detail'),
            'action_taken' => $request->input('action_taken'),
            'summary' => $request->input('summary'),
            'address' => $request->input('address'),
            'name' => $request->input('name'),
            'long' => $request->input('long'),
            'lat' => $request->input('lat'),
            'is_witness' => $request->input('is_witness')
        ]);

        if($request->hasFile('img')) {
            $media = collect($report->media)->firstWhere('collection_name', 'report-image');

            if($media != null) {
                $media->delete();
            }

            $report->addMedia($request->file('img'))->toMediaCollection('report-image');
        }

        return $report;
    }

    public function list(Request $request)
    {
        $reports = CaseReport::query();
        // if ($request->filled('sortBy')) {
        //     $users = CaseReport::role($request->input('sortBy'));
        // }
        // if($request->filled('search')) {
        //     $users = CaseReport::where('first_name', 'LIKE', '%'.$request->input('search').'%')
        //     ->orWhere('last_name', 'LIKE', '%'.$request->input('search').'%')
        //     ->orWhere('username', 'LIKE', '%'.$request->input('search').'%')
        //     ->orWhere('email', 'LIKE', '%'.$request->input('search').'%');
        // }
        $reports = $reports->paginate(10);
        return new CaseReportCollection($reports);
    }

    public function solved(CaseReport $caseReport)
    {
        return $caseReport->update([
            'case_status_id' => 4
        ]);
    }

    public function print(CaseReport $caseReport)
    {
        $report = $caseReport;
        $img = collect($report->media)->firstWhere('collection_name', 'report-image');
        $url = optional($img)->getUrl();
        return view('report-print', compact('report','url'));
    }
}
