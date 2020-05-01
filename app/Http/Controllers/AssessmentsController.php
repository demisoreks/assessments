<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\AssAssessment;
use App\AssResponder;
use App\AssCategory;
use App\AssItem;
use App\AssOption;
use App\AssResponse;

class AssessmentsController extends Controller
{
    
    
    public function take(AssAssessment $assessment) {
        return view('general.take', compact('assessment'));
    }
    
    public function submit(AssAssessment $assessment, Request $request) {
        $input = $request->input();
        $responder = AssResponder::create([
            'organization_name' => $input['organization_name'],
            'reviewer_name' => $input['reviewer_name'],
            'email' => $input['email'],
            'assessment_id' => $assessment->id
        ]);
        foreach (AssCategory::where('assessment_id', $assessment->id)->where('active', true)->get() as $category) {
            foreach (AssItem::where('category_id', $category->id)->where('active', true)->get() as $item) {
                $option_id = $input['option'.$item->id];
                $remark = $input['remark'.$item->id];
                AssResponse::create([
                    'responder_id' => $responder->id,
                    'item_id' => $item->id,
                    'item_weight' => $item->weight,
                    'option_id' => $option_id,
                    'option_description' => AssOption::find($option_id)->description,
                    'option_score' => AssOption::find($option_id)->score
                ]);
            }
        }
        return Redirect::route('assessments.result', [$responder->slug()]);
    }
    
    public function result(AssResponder $responder) {
        return view('assessments.result', compact('responder'));
    }
}
