<?php

namespace App\Http\Controllers\Api;

use App\Models\Crime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrimeController extends Controller
{
    public function index()
    {
        return response()->json(Crime::all());
    }
}
