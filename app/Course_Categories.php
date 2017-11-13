<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_Categories extends Model
{
    protected $table = 'course_categories';
    
    public static function get_all_course_categories()
	{
		$data = \App\Course_Categories::select('id', 'course_category_name', 'course_category_slug')->where(array('status' => 1, 'is_deleted' => 0))->orderby("created_at", "DESC")->get();
	    return $data->toArray();
	}
}