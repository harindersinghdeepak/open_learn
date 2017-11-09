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

	public static function save_course($insert_data)
	{
		$course = new Courses();
		$course->course_name = $insert_data['course']['course_name'];
		$course->price = $insert_data['course']['price'];
		$course->short_description = $insert_data['course']['short_description'];
		$course->description = $insert_data['course']['description'];
		$course->requirements = $insert_data['course']['requirements'];
		$course->course_name = $insert_data['course']['course_name'];
		$course->course_name = $insert_data['course']['course_name'];
	}
}
