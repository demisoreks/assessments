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
    public function index() {
        $assessments = AssAssessment::all();
        return view('assessments.index', compact('assessments'));
    }

    public function create() {
        return view('assessments.create');
    }

    public function store(Request $request) {
        $input = $request->input();
        $input['title'] = $input['title1'];
        unset($input['title1']);
        $error = "";
        $existing_assessments = AssAssessment::where('title', $input['title']);
        if ($existing_assessments->count() != 0) {
            $error .= "Asessment title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $assessment = AssAssessment::create($input);
            if ($assessment) {
                return Redirect::route('assessments.index')
                        ->with('success', UtilsController::response('Successful!', 'Assessment has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function edit(AssAssessment $assessment) {
        $assessment->title1 = $assessment->title;
        return view('assessments.edit', compact('assessment'));
    }

    public function update(AssAssessment $assessment, Request $request) {
        $input = $request->input();
        $input['title'] = $input['title1'];
        unset($input['title1']);
        $error = "";
        $existing_assessments = AssAssessment::where('title', $input['title'])->where('id', '<>', $assessment->id);
        if ($existing_assessments->count() != 0) {
            $error .= "Assessment title already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($assessment->update($input)) {
                return Redirect::route('assessments.index')
                        ->with('success', UtilsController::response('Successful!', 'Assessment has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function disable(AssAssessment $assessment) {
        $input['active'] = false;
        $assessment->update($input);
        return Redirect::route('assessments.index')
                ->with('success', UtilsController::response('Successful!', 'Assessment has been disabled.'));
    }

    public function enable(AssAssessment $assessment) {
        $input['active'] = true;
        $assessment->update($input);
        return Redirect::route('assessments.index')
                ->with('success', UtilsController::response('Successful!', 'Assessment has been enabled.'));
    }

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
