<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSummary;

class SchoolSummaryController extends Controller
{
    //
    public function getSchoolSummary()
    {
        $data = SchoolSummary::all();
        return response()->json($data);

    }

}
