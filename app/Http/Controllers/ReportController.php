<?php

namespace App\Http\Controllers;

use App\Models\CaseReport;
use Illuminate\Http\Request;

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

    public function list(Request $request)
    {
        $users = CaseReport::query();
        if ($request->filled('sortBy')) {
            $users = CaseReport::role($request->input('sortBy'));
        }
        if($request->filled('search')) {
            $users = CaseReport::where('first_name', 'LIKE', '%'.$request->input('search').'%')
            ->orWhere('last_name', 'LIKE', '%'.$request->input('search').'%')
            ->orWhere('username', 'LIKE', '%'.$request->input('search').'%')
            ->orWhere('email', 'LIKE', '%'.$request->input('search').'%');
        }
        $users = $users->paginate(10);
        return new UserCollection($users);
    }
}
