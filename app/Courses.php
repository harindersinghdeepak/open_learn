<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Courses extends Model
{
    protected $table = 'courses';
    
    public static function get_all_courses()
	{
		$data = \App\Courses::where(array('is_deleted' => 0))->orderby("created_at", "DESC")->get();
	    return $data->toArray();
	}

	public static function get_course_details($id)
	{
		$data = \App\Courses::where(array('id' => $id, 'is_deleted' => 0))->first();
	    return $data ? $data->toArray() : array();
	}

	public static function save_course($insert_data)
	{
		if (array_key_exists('id', $insert_data['course']))
		{
			$course = \App\Courses::where(array('id' => base64_decode($insert_data['course']['id']), 'is_deleted' => 0))->first();
		}
		else
		{
			$course = new Courses();
		}

		$course->course_name = $insert_data['course']['course_name'];
		$course->price = $insert_data['course']['price'];
		$course->short_description = $insert_data['course']['short_description'];
		$course->description = $insert_data['course']['description'];
		$course->requirements = $insert_data['course']['requirements'];
		$course->expiry_date = $insert_data['course']['expiry_date'];
		$course->is_certification = $insert_data['course']['is_certification'];
		$course->is_full_access = $insert_data['course']['is_full_access'];
		$course->what_will_learn = $insert_data['course']['what_will_learn'];
		$course->category_id = $insert_data['course']['category_id'];
		$course->status = $insert_data['course']['status'];
		$course->created_at = date("Y-m-d H:i:s");
		$course->updated_at = date("Y-m-d H:i:s");
		// print_r($insert_data);die;
		try
		{
			$course->save();

			if (array_key_exists('id', $insert_data['course']))
			{
				foreach ($insert_data['modules'] as $keyM => $valueM)
				{
					if ($valueM['module_name'] != '' && $valueM['module_description'] != '')
					{
						// if (\App\Course::course_module_detail($course_id, ))
						// {
						// 	$course = \App\Courses::where(array('id' => base64_decode($insert_data['course']['id']), 'is_deleted' => 0))->first();
						// }
						// else
						// {
							$course_module = new Course_Modules();
						// }

						$course_module->course_id = $course->id;
						$course_module->module_name = $valueM['module_name'];
						$course_module->module_description = $valueM['module_description'];
						$course_module->created_at = date("Y-m-d H:i:s");
						$course_module->updated_at = date("Y-m-d H:i:s");

						if($course_module->save())
						{
							if (!$valueM['module_video']['error'])
							{
								$file_name = time() . "_" . $valueM['module_video']['name'];

								$module_attachment = new Module_Attachments();
								$module_attachment->module_id = $course_module->id;
								$module_attachment->attachment_name = $file_name;
								$module_attachment->attachment_path = 'assets/uploads/course_modules/videos/' . $file_name;
								$module_attachment->attachment_type = 2;
								$module_attachment->created_at = date("Y-m-d H:i:s");
								$module_attachment->updated_at = date("Y-m-d H:i:s");
								$module_attachment->save();
							}
						}
					}
				}
			}
		}
		catch (Exception $e)
		{
			die('212');
		}

		return $course->id;
	}

	public static function delete_course($id)
	{
		DB::table('courses')
            ->where('id', $id)
            ->update(['is_deleted' => 1]);
	}
}
