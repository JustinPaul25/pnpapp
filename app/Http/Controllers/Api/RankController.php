<?php

namespace App\Http\Controllers\Api;

use App\Models\Rank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankController extends Controller
{
    public function index()
    {
        return response()->json(Rank::all());
    }
}
