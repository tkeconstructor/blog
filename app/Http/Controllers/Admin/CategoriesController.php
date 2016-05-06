<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\QuestionCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

class CategoriesController extends Controller
{
    public function index(){
    	$categories  = QuestionCategory::all();
    	return view('admin.pages.categories.index',compact('categories'));
    }

    public function create(Request $request){
    	$data = $request->all();
    	$validator = Validator::make($data, [
    		'name'=>'required'
    		]);
    	if ($validator->fails())
    		return redirect(redirect()->getUrlGenerator()->previous())->withErrors($validator);
    	$category = new QuestionCategory();
    	$category->create($data);
    	return redirect('admin/categories');
    }

    public function update(Request $request){
    	$data = $request->all();
    	$validator = Validator::make($data, [
    		'name'=>'required'
    		]);
    	if ($validator->fails())
    		return redirect(redirect()->getUrlGenerator()->previous())->withErrors($validator);
    	$category = QuestionCategory::whereId($data['id'])->first();
    	if($category->update($data))
    		return 1;
    	return 0;
    }
}
