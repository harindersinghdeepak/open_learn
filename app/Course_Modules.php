<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Config;
class Course_Modules extends Model
{
    protected $table = 'course_modules';

    public static function get_course_modules($course_id)
    {
		$course_modules = \App\Course_Modules::where(array('course_id' => $course_id, 'is_deleted' => 0))->get();

		foreach ($course_modules as $keyCM => $valueCM)
		{
			$course_modules[$keyCM]['module_attachments'] = \App\Module_Attachments::where(array('module_id' => $valueCM['id'], 'is_deleted' => 0))->get();
		}
		
		return $course_modules;
    }

    public static function get_course_module_details($module_id)
    {
		$course_module = \App\Course_Modules::where(array('id' => $module_id, 'is_deleted' => 0))->first();
		if ($course_module)
		{
			$course_module = $course_module->toArray();
			$module_attachments = \App\Module_Attachments::where(array('module_id' => $module_id, 'is_deleted' => 0))->first();
			if ($module_attachments)
			{
				$course_module['attachment'] = $module_attachments->toArray();
			}

			return $course_module;
		}

		return array();
		
    }

    public static function save_course_module($insert_data)
    {
    	if (isset($insert_data['id']))
    	{
    		$course_module = \App\Course_Modules::where(array('id' => $insert_data['id'], 'is_deleted' => 0))->first();
    	}
    	else
    	{
			$course_module = new Course_Modules();
    	}

		$course_module->course_id = $insert_data['course_id'];
		$course_module->module_name = $insert_data['module_name'];
		$course_module->module_description = $insert_data['module_description'];
		$course_module->created_at = date("Y-m-d H:i:s");
		$course_module->updated_at = date("Y-m-d H:i:s");
		$course_module->save();

		// Module Attachment
		if (!$insert_data['module_video']['error'])
		{
			// Delete existing course module attachment, if any
			Module_Attachments::delete_module_attachment($course_module->id);

			$upload_attachment = self::uploadFiles($insert_data['module_video'], Config::get('constants.uploadFilesFolder.module_videos'));
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

		return $course_module->id;
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

	public static function delete_course_module($id)
	{
		return DB::table('course_modules')->where('id', $id)->update(array('is_deleted' => 1));
	}
}