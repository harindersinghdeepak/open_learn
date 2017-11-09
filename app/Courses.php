<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
	    return $data->toArray();
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
		$course->save();

		return $course->id;
	}
}
