<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\AssAssessment;
use App\AssCategory;

class CategoriesController extends Controller
{
    public function index(AssAssessment $assessment) {
        $categories = AssCategory::where('assessment_id', $assessment->id)->get();
        return view('categories.index', compact('categories', 'assessment'));
    }

    public function create(AssAssessment $assessment) {
        return view('categories.create', compact('assessment'));
    }

    public function store(AssAssessment $assessment, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_categories = AssCategory::where('assessment_id', $assessment->id)->where('description', $input['description']);
        if ($existing_categories->count() != 0) {
            $error .= "Category description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['assessment_id'] = $assessment->id;
            $category = AssCategory::create($input);
            if ($category) {
                return Redirect::route('assessments.categories.index', [$assessment->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Category has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function edit(AssAssessment $assessment, AssCategory $category) {
        return view('categories.edit', compact('assessment', 'category'));
    }

    public function update(AssAssessment $assessment, AssCategory $category, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_categories = AssCategory::where('assessment_id', $assessment->id)->where('description', $input['description'])->where('id', '<>', $category->id);
        if ($existing_categories->count() != 0) {
            $error .= "Category description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($category->update($input)) {
                return Redirect::route('assessments.categories.index', [$assessment->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Category has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function disable(AssAssessment $assessment, AssCategory $category) {
        $input['active'] = false;
        $category->update($input);
        return Redirect::route('assessments.categories.index', [$assessment->slug()])
                ->with('success', UtilsController::response('Successful!', 'Category has been disabled.'));
    }

    public function enable(AssAssessment $assessment, AssCategory $category) {
        $input['active'] = true;
        $category->update($input);
        return Redirect::route('assessments.categories.index', [$assessment->slug()])
                ->with('success', UtilsController::response('Successful!', 'Category has been enabled.'));
    }
}
