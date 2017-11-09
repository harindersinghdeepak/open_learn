<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index()
    {
    	$data['all_courses'] = \App\Courses::get_all_courses();
    	return view('admin/courses_list')->with('data', $data);
    }

    public function course_add()
    {
    	$data['all_course_categories'] = \App\Course_Categories::get_all_course_categories();
    	return view('admin/courses_add')->with('data', $data);
    }

	public function course_save()
	{
    	$insert = \App\Courses::save_course();
		return view('admin/courses_add')->with('data', array("edit_id" => 1));
	}
}
