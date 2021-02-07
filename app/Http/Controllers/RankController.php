<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function list()
    {
        return response()->json(Rank::all());
    }
}
