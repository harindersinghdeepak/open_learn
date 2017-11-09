<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;

class CoursesController extends Controller
{
    public function index()
    {
    	$data['all_courses'] = \App\Courses::get_all_courses();
    	return view('admin/courses_list')->with('data', $data);
    }

    public function course_add()
    {
    	$params = Route::current()->parameters();
    	if (array_key_exists('id', $params))
    	{
    		$data['course_details'] = \App\Courses::get_course_details($params['id']);
    		$data['all_course_categories'] = \App\Course_Categories::get_all_course_categories();
    		return view('admin/courses_add')->with('data', $data);
    	}

    	$data['all_course_categories'] = \App\Course_Categories::get_all_course_categories();
    	return view('admin/courses_add')->with('data', $data);
    }

	public function course_save(Request $request)
	{
		$post_data = $request->all();
		$insert_data['course']['course_name'] = $post_data['course_name'];
		$insert_data['course']['price'] = $post_data['course_price'];
		$insert_data['course']['category_id'] = $post_data['category_id'];
		$insert_data['course']['short_description'] = $post_data['course_short_description'];
		$insert_data['course']['description'] = $post_data['course_description'];
		$insert_data['course']['requirements'] = $post_data['course_requirements'];
		$insert_data['course']['what_will_learn'] = $post_data['what_will_learn'];
		$insert_data['course']['status'] = $post_data['course_status'];
		$insert_data['course']['expiry_date'] = $post_data['expiry_date'];
		
		if ($post_data['cid'] != '')
		{
			$insert_data['course']['id'] = $post_data['cid'];
		}

		$insert_data['course']['is_certification'] = 0;
		if (isset($post_data['is_certification']))
		{
			$insert_data['course']['is_certification'] = 1;
		}

		$insert_data['course']['is_full_access'] = 0;
		if (isset($post_data['is_full_access']))
		{
			$insert_data['course']['is_full_access'] = 1;
		}

    	$insert_id = \App\Courses::save_course($insert_data);
    	return redirect()->route('edit_course', array('id' => $insert_id));
	}
}
