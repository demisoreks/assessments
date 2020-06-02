<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\AssResponder;
use App\AssAssessment;

class RespondersController extends Controller
{
    public function index(AssAssessment $assessment) {
        $responders = AssResponder::where('assessment_id', $assessment->id)->get();
        return view('responders.index', compact('responders', 'assessment'));
    }

    public function scores(AssAssessment $assessment, AssResponder $responder) {
        return view('responders.scores', compact('assessment', 'responder'));
    }

    public function print(AssAssessment $assessment, AssResponder $responder) {
        return view('print_scores', compact('assessment', 'responder'));
    }

    public function download(AssAssessment $assessment, AssResponder $responder) {
        $pdf = PDF::loadView('print_scores', compact('assessment', 'responder'));
        return $pdf->download('assessment-result-'.$responder->slug().'.pdf');
    }
}
