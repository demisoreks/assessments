<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use App\AssAssessment;
use App\AssCategory;
use App\AssItem;

class ItemsController extends Controller
{
    public function index(AssAssessment $assessment, AssCategory $category) {
        $items = AssItem::where('category_id', $category->id)->get();
        return view('items.index', compact('items', 'assessment', 'category'));
    }

    public function create(AssAssessment $assessment, AssCategory $category) {
        return view('items.create', compact('assessment', 'category'));
    }

    public function store(AssAssessment $assessment, AssCategory $category, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_items = AssItem::where('category_id', $category->id)->where('description', $input['description']);
        if ($existing_items->count() != 0) {
            $error .= "Item description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            $input['category_id'] = $category->id;
            $item = AssItem::create($input);
            if ($item) {
                return Redirect::route('assessments.categories.items.index', [$assessment->slug(), $category->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Item has been created.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function edit(AssAssessment $assessment, AssCategory $category, AssItem $item) {
        return view('items.edit', compact('assessment', 'category', 'item'));
    }

    public function update(AssAssessment $assessment, AssCategory $category, AssItem $item, Request $request) {
        $input = $request->input();
        $error = "";
        $existing_items = AssItem::where('category_id', $category->id)->where('description', $input['description'])->where('id', '<>', $item->id);
        if ($existing_items->count() != 0) {
            $error .= "Item description already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', UtilsController::response('Oops!', $error))
                    ->withInput();
        } else {
            if ($item->update($input)) {
                return Redirect::route('assessments.categories.items.index', [$assessment->slug(), $category->slug()])
                        ->with('success', UtilsController::response('Successful!', 'Item has been updated.'));
            } else {
                return Redirect::back()
                        ->with('error', UtilsController::response('Unknown error!', 'Please contact administrator.'))
                        ->withInput();
            }
        }
    }

    public function disable(AssAssessment $assessment, AssCategory $category, AssItem $item) {
        $input['active'] = false;
        $item->update($input);
        return Redirect::route('assessments.categories.items.index', [$assessment->slug(), $category->slug()])
                ->with('success', UtilsController::response('Successful!', 'Item has been disabled.'));
    }

    public function enable(AssAssessment $assessment, AssCategory $category, AssItem $item) {
        $input['active'] = true;
        $item->update($input);
        return Redirect::route('assessments.categories.items.index', [$assessment->slug(), $category->slug()])
                ->with('success', UtilsController::response('Successful!', 'Items has been enabled.'));
    }
}
