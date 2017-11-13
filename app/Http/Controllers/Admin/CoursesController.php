<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Route;
use Session;
use Config;

class CoursesController extends Controller
{
	public function index()
	{
		$data['all_courses'] = \App\Courses::get_all_courses();
		return view('admin/courses_list')->with('data', $data);
	}

	public function course_modules_list()
	{
		$params = Route::current()->parameters();
		$data['course_details'] = \App\Courses::get_course_details($params['cid']);
		$data['all_course_modules'] = \App\Course_Modules::get_course_modules($params['cid']);
		
		if (sizeof($data['course_details']) < 1)
		{
			return view('admin/errors/404');
		}

		return view('admin/course_modules_list')->with('data', $data);
	}

    public function course_add()
    {
    	$params = Route::current()->parameters();
    	if (array_key_exists('id', $params))
    	{
    		// EDIT
    		$data['course_details'] = \App\Courses::get_course_details($params['id']);
    		if (empty($data['course_details']))
    		{
    			return view('admin/errors/404');
    		}
    		
    		$data['course_modules'] = \App\Course_Modules::get_course_modules($params['id']);
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

		// Course Attachments
		$insert_data['course']['course_image'] = $_FILES['course_image'];
		$insert_data['course']['course_video'] = $_FILES['course_video'];

		// Course Modules
		$post_data['module'] = array_values($post_data['module']);
		foreach ($post_data['module'] as $keyM => $valueM)
		{
			$insert_data['modules'][$keyM]['module_name'] = $valueM['module_name'];
			$insert_data['modules'][$keyM]['module_description'] = $valueM['module_description'];
			$insert_data['modules'][$keyM]['module_video'] = null;
			if (isset($_FILES['module_video_' . $keyM]))
			{
				$insert_data['modules'][$keyM]['module_video'] = $_FILES['module_video_' . $keyM];
			}
		}

    	$insert_id = \App\Courses::save_course($insert_data);
    	return redirect()->route('edit_course', array('id' => $insert_id));
	}

	function course_delete()
	{
		$params = Route::current()->parameters();
    	if (array_key_exists('id', $params))
    	{
    		try
    		{
	    		\App\Courses::delete_course($params['id']);
	    		Session::flash('success', 'Course deleted successful!');
    		}
    		catch (Exception $e)
    		{
	    		Session::flash('error', 'Error while deleting Course!');
    		}

	    	return redirect()->back();
    	}
	}

	public function course_module_add()
    {
    	$params = Route::current()->parameters();
		$data['mid'] = '';
    	$data['cid'] = $params['cid'];

    	if (array_key_exists('id', $params))
    	{
    		// EDIT
			$data['mid'] = $params['id'];

    		$data['course_module_details'] = \App\Course_Modules::get_course_module_details($params['id']);
			if (sizeof($data['course_module_details']) < 1)
			{
				return view('admin/errors/404');
			}
    	}

    	return view('admin/course_module_add')->with('data', $data);
    }

    public function course_module_save(Request $request)
	{
		$post_data = $request->all();

		$cid = base64_decode($post_data['cid']);
		if ($post_data['module_name'] != '' && $post_data['module_description'] != '')
		{
			if (trim($post_data['mid']) != '')
			{
				// Edit Module
				$insert_data['id'] = base64_decode($post_data['mid']);
			}
			
			$insert_data['course_id'] = $cid;
			$insert_data['module_name'] = $post_data['module_name'];
			$insert_data['module_description'] = $post_data['module_description'];
			$insert_data['module_video'] = $_FILES['module_video'];
			try
			{
				$insert_id = \App\Course_Modules::save_course_module($insert_data);
				Session::flash('success', 'Module saved successfully.');
			}
			catch (Exception $e)
			{
				Session::flash('error', 'Error while saving Module.');
			}
		}
		else
		{
			Session::flash('error', 'Please fill required fields.');
		}
		
    	return redirect()->route('add_course_module', array("id" => $cid));
	}
}