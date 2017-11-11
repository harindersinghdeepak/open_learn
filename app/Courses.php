<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Config;

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
			// Edit Course
			$course = \App\Courses::where(array('id' => base64_decode($insert_data['course']['id']), 'is_deleted' => 0))->first();
		}
		else
		{
			// Add New Course
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

		try
		{
			$course->save();

			// Course Attachments
			if (!$insert_data['course']['course_image']['error'])
			{
				$crs_image = self::uploadFiles($insert_data['course']['course_image'], Config::get('constants.uploadFilesFolder.course_images'));
				if (sizeof($crs_image) > 0)
				{
					$course_attachment = new Course_Attachments();
					$course_attachment->course_id = $course->id;
					$course_attachment->attachment_name = $crs_image['name'];
					$course_attachment->attachment_path = $crs_image['path'];
					$course_attachment->attachment_type = 1;
					$course_attachment->created_at = date("Y-m-d H:i:s");
					$course_attachment->updated_at = date("Y-m-d H:i:s");
					$course_attachment->save();
				}
			}

			if (!$insert_data['course']['course_video']['error'])
			{
				$crs_video = self::uploadFiles($insert_data['course']['course_video'], Config::get('constants.uploadFilesFolder.course_videos'));
				if (sizeof($crs_video) > 0)
				{
					$course_attachment = new Course_Attachments();
					$course_attachment->course_id = $course->id;
					$course_attachment->attachment_name = $crs_video['name'];
					$course_attachment->attachment_path = $crs_video['path'];
					$course_attachment->attachment_type = 2;
					$course_attachment->created_at = date("Y-m-d H:i:s");
					$course_attachment->updated_at = date("Y-m-d H:i:s");
					$course_attachment->save();
				}
			}

			if (array_key_exists('id', $insert_data['course']))
			{
				$existing_course_modules = \App\Course_Modules::where(array('course_id' => $course->id, 'is_deleted' => 0))->pluck('id')->toArray();

				// Editing Course
				foreach ($insert_data['modules'] as $keyM => $valueM)
				{
					$cm_id = 0;
					if (isset($valueM['cm_id']))
					{
						$cm_id = base64_decode($valueM['cm_id']);
					}

					if ($valueM['module_name'] != '' && $valueM['module_description'] != '')
					{
						if (in_array($cm_id, $existing_course_modules))
						{
							$course_module = \App\Course_Modules::where(array('course_id' => $cm_id, 'is_deleted' => 0))->first();
						}
						else
						{
							$course_module = new Course_Modules();
						}

						$course_module->course_id = $course->id;
						$course_module->module_name = $valueM['module_name'];
						$course_module->module_description = $valueM['module_description'];
						$course_module->created_at = date("Y-m-d H:i:s");
						$course_module->updated_at = date("Y-m-d H:i:s");

						if($course_module->save())
						{
							if (in_array($cm_id, $existing_course_modules) && sizeof($valueM['module_video']) > 0)
							{
								DB::table('module_attachments')->where(array('module_id' => $cm_id))->update(array("is_deleted" => 1));
							}

							if (!$valueM['module_video']['error'])
							{
								$upload_attachment = self::uploadFiles($valueM['module_video'], Config::get('constants.uploadFilesFolder.module_videos'));
								if (sizeof($upload_attachment) > 0)
								{
									$module_attachment = new Module_Attachments();
									$module_attachment->module_id = $course_module->id;
									$module_attachment->attachment_name = $upload_attachment['name'];
									$module_attachment->attachment_path = $upload_attachment['path'];
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
			else
			{
				// Add New Course
				// Add New Course Modules
				foreach ($insert_data['modules'] as $keyM => $valueM)
				{
					if ($valueM['module_name'] != '' && $valueM['module_description'] != '')
					{
						$course_module = new Course_Modules();
						$course_module->course_id = $course->id;
						$course_module->module_name = $valueM['module_name'];
						$course_module->module_description = $valueM['module_description'];
						$course_module->created_at = date("Y-m-d H:i:s");
						$course_module->updated_at = date("Y-m-d H:i:s");

						if($course_module->save())
						{
							if (!$valueM['module_video']['error'])
							{
								$upload_attachment = self::uploadFiles($valueM['module_video'], Config::get('constants.uploadFilesFolder.module_videos'));
								if (sizeof($upload_attachment) > 0)
								{
									$module_attachment = new Module_Attachments();
									$module_attachment->module_id = $course_module->id;
									$module_attachment->attachment_name = $upload_attachment['name'];
									$module_attachment->attachment_path = $upload_attachment['path'];
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
		}
		catch (Exception $e)
		{
			die('error occured');
		}

		return $course->id;
	}

	public static function delete_course($id)
	{
		return DB::table('courses')->where('id', $id)->update(array('is_deleted' => 1));
	}

	public static function uploadFiles($file, $folderName)
	{
		$rp = realpath(getcwd());
       	$originalName = $file["name"];
        
        $fileName = time() . "_" .str_replace(array(" ", "(", ")"), "_", $file["name"]);
        
        if (! is_dir($rp . "/uploadedFiles/" . $folderName)) 
        {
            mkdir($rp ."/uploadedFiles/" . $folderName, 0777, true);
        }
             	 
        $dest = "/uploadedFiles/" . $folderName . '/' . $fileName;     
       	$cp = $rp . $dest;

        if(move_uploaded_file($file["tmp_name"], $cp))
        {
        	return array('name' => $fileName, 'error' => $file["error"], 'path' => $dest);
        }

        return array();
	}
}
