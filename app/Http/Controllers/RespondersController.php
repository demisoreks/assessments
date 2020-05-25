<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AssResponder;
use App\AssAssessment;

class RespondersController extends Controller
{
    public function index(AssAssessment $assessment) {
        $responders = AssResponder::where('assessment_id', $assessment->id)->get();
        return view('responders.index', compact('responders', 'assessment'));
    }
}
