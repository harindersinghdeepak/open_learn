<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Course_Attachments extends Model
{
    protected $table = 'course_attachments';

	public static function get_course_attachments($course_id)
	{
		$data = \App\Course_Attachments::where(array('course_id' => $course_id, 'status' => 1, 'is_deleted' => 0))->get();
		return $data ? $data->toArray() : array();
	}

	public static function delete_course_attachment($id)
	{
		return DB::table('course_attachments')->where('id', $id)->update(array('is_deleted' => 1));
	}

	public static function delete_course_attachment_by_type($attachment_type)
	{
		return DB::table('course_attachments')->where(array('attachment_type' => $attachment_type, 'is_deleted' => 0))->update(array('is_deleted' => 1));
	}

	
}
