<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Validator;
use App\Course;
use App\Role;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index(){
    	$courses = Course::all();
    	return view('admin.pages.courses.index',compact('courses'));
    }

    public function show($id){
    	$course  = Course::whereId($id)->first();
    	$role_lecture = Role::whereName('lecturer')->first();
    	$lecturers = $role_lecture->users();

    	$lecturers_connect = $course->lecturers();
    	$lecturers_disconnect = User::where('role_id','=',$role_lecture->id)
    					->whereNotIn('id',$lecturers_connect->pluck('id'))->get();

    	return view('admin.pages.courses.show',compact('course','lecturers_connect','lecturers_disconnect'));
    }

    public function create(Request $request){
    	$data = $request->all();
    	$validator = Validator::make($data, [
    		'name'=>'required',
    		'code'=>'required',
    		]);
    	if ($validator->fails())
    		return redirect(redirect()->getUrlGenerator()->previous())->withErrors($validator);
    	$course = new Course();
    	$course->create($data);
    	return redirect('admin/courses');
    }

    public function update(Request $request){
    	$data = $request->all();
    	$validator = Validator::make($data, [
    		'name'=>'required',
    		]);
    	if ($validator->fails())
    		return redirect(redirect()->getUrlGenerator()->previous())->withErrors($validator);
    	$course = Course::whereId($data['id'])->first();
    	if($course->update($data))
    		return 1;
    	return 0;
    }

    public function assignLecture($id,Request $request){
    	$data = $request->all();

		$course  = Course::whereId($id)->first();

    	if(isset($data["disconnect_lecturers"])){
            $course->users()->detach($data["disconnect_lecturers"]);           
        }

        if(isset($data["connect_lecturers"])){
            $course->users()->attach($data["connect_lecturers"]);
        }

    	return redirect(redirect()->getUrlGenerator()->previous());
    }

}
