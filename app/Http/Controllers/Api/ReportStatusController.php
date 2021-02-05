<?php

namespace App\Http\Controllers\Api;

use App\Models\CaseStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportStatusController extends Controller
{
    public function index()
    {
        return response()->json(CaseStatus::all());
    }
}
