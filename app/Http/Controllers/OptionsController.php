<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\AssAssessment;
use App\AssCategory;
use App\AssItem;
use App\AssOption;

class OptionsController extends Controller
{
    public function index(AssAssessment $assessment, AssCategory $category, AssItem $item) {
        $options = AssOption::where('item_id', $item->id)->get();
        return view('options.index', compact('options', 'assessment', 'category', 'item'));
    }

    public function create(AssAssessment $assessment, AssCategory $category, AssItem $item) {
        return view('options.create', compact('assessment', 'category', 'item'));
    }

    public function store(AssAssessment $assessment, AssCategory $category, AssItem $item, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_options = AssOption::where('item_id', $item->id)->where('description', $input['description']);
        if ($existing_options->count() != 0) {
            $error .= "Option description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['item_id'] = $item->id;
            $option = AssOption::create($input);
            if ($option) {
                return Redirect::route('assessments.categories.items.options.index', [$assessment->slug(), $category->slug(), $item->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Option has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function edit(AssAssessment $assessment, AssCategory $category, AssItem $item, AssOption $option) {
        return view('options.edit', compact('assessment', 'category', 'item', 'option'));
    }

    public function update(AssAssessment $assessment, AssCategory $category, AssItem $item, AssOption $option, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_options = AssOption::where('item_id', $item->id)->where('description', $input['description'])->where('id', '<>', $option->id);
        if ($existing_options->count() != 0) {
            $error .= "Option description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($option->update($input)) {
                return Redirect::route('assessments.categories.items.options.index', [$assessment->slug(), $category->slug(), $item->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Option has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function disable(AssAssessment $assessment, AssCategory $category, AssItem $item, AssOption $option) {
        $option->delete();
        return Redirect::route('assessments.categories.items.options.index', [$assessment->slug(), $category->slug(), $item->slug()])
                ->with('success', UtilsController::response('Successful!', 'Option has been disabled.'));
    }

    public function enable(AssAssessment $assessment, AssCategory $category, AssItem $item, AssOption $option) {
        $input['active'] = true;
        $option->update($input);
        return Redirect::route('assessments.categories.items.options.index', [$assessment->slug(), $category->slug(), $item->slug()])
                ->with('success', UtilsController::response('Successful!', 'Option has been enabled.'));
    }
}
