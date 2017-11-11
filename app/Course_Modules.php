<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Course_Modules extends Model
{
    protected $table = 'course_modules';

    public static function get_course_modules($course_id)
    {
		$course_modules = \App\Course_Modules::where(array('course_id' => $course_id, 'is_deleted' => 0))->get();

		foreach ($course_modules as $keyCM => $valueCM)
		{
			$course_modules[$keyCM]['module_attachments'] = \App\Module_Attachments::where(array('module_id' => $course_id, 'is_deleted' => 0))->get();
		}

		return $course_modules;
    }
}