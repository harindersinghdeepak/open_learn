<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
class IndexController extends Controller
{
    public function index()
    {
    	$params = Route::current()->parameters();
    	$data['course_details'] = \App\Courses::get_course_details($params['id']);
    	if (empty($data['course_details']))
		{
			return view('errors/404');
		}

		// $data['course_details']['course_references'] = DB::table('course_references')->where(array('course_id'=> $id, 'status' => 1, 'is_deleted' => 0))->update(array('is_deleted' => 1));

		$data['course_details']['course_references'] = array(array("reference_name" => 'ref1', "reference_path" => '/uploadedFiles/course_references/abc.ppt'), array("reference_name" => 'ref1', "reference_path" => '/uploadedFiles/course_references/abc.ppt'), array("reference_name" => 'ref1', "reference_path" => '/uploadedFiles/course_references/abc.ppt'));

    	$attachments = \App\Course_Attachments::get_course_attachments($params['id']);
    	foreach ($attachments as $keyA => $valueA)
		{
			if ($valueA['attachment_type'] == 1)
			{
				$data['course_details']['background_image'] = $valueA['attachment_path'];
			}
			elseif ($valueA['attachment_type'] == 2)
			{
				$data['course_details']['video'] = $valueA['attachment_path'];
			}
		}

    	$data['course_details']['modules'] = \App\Course_Modules::get_course_modules($params['id']);
    	
    	return view('course')->with('data', $data);
    }

    public function handle_err()
    {
    	return view('errors.404');
    }
}	