<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Types\MonthType;
use App\Models\CaseReport;
use Illuminate\Http\Request;
use App\Http\Resources\CaseReport\CaseReportCollection;

class ReportController extends Controller
{
    public function all()
    {
        $reports = CaseReport::all();
        return new CaseReportCollection($reports);
    }

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
        
        if($request->input('role') == 'Barangay Administrator') {
            $reports = CaseReport::where('case_status_id', 1);
        } else {
            if ($request->filled('case_status_id')) {
                $reports = CaseReport::where('case_status_id', $request->input('case_status_id'));
            } else {
                $reports = CaseReport::where('case_status_id', '!=' , 1);
            }
            if ($request->filled('crime_id')) {
                $reports = $reports->where('crime_id', $request->input('crime_id'));
            }
        }
        
        if($request->filled('search')) {
            $reports = $reports->where('name', 'LIKE', '%'.$request->input('search').'%');
        }
        if($request->filled('date')) {
            $reports = $reports->where('crime_date',$request->input('date'));
        }
        if($request->filled('sortBy')) {
            $reports = $reports->orderBy('name', $request->input('sortBy'));
        }
        
        $reports = $reports->paginate(10);
        return new CaseReportCollection($reports);
    }

    public function solved(CaseReport $caseReport)
    {
        return $caseReport->update([
            'case_status_id' => 4
        ]);
    }

    public function discard(CaseReport $caseReport)
    {
        return $caseReport->update([
            'case_status_id' => 2
        ]);
    }

    public function approved(CaseReport $caseReport)
    {
        return $caseReport->update([
            'case_status_id' => 3
        ]);
    }

    public function print(CaseReport $caseReport)
    {
        $report = $caseReport;
        $img = collect($report->media)->firstWhere('collection_name', 'report-image');
        $url = optional($img)->getUrl();
        return view('report-print', compact('report','url'));
    }

    public function getSolved()
    {
        $weekly = CaseReport::where('case_status_id', 4)->get()->groupBy(function($date) {
            return Carbon::parse($date->crime_date)->format('M');
        });
        
        return response()->json($weekly);
    }

    public function getApproved()
    {
        $weekly = CaseReport::where('case_status_id', 3)->get()->groupBy(function($date) {
            return Carbon::parse($date->crime_date)->format('M');
        });
        
        return response()->json($weekly);
    }

    public function getDiscard()
    {
        $weekly = CaseReport::where('case_status_id', 2)->get()->groupBy(function($date) {
            return Carbon::parse($date->crime_date)->format('M');
        });
        
        return response()->json($weekly);
    }

    public function getPending()
    {
        $weekly = CaseReport::where('case_status_id', 1)->get()->groupBy(function($date) {
            return Carbon::parse($date->crime_date)->format('M');
        });
        
        return response()->json($weekly);
    }
}
