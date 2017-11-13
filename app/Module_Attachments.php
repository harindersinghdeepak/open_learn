<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Module_Attachments extends Model
{
    protected $table = 'module_attachments';

    public static function delete_module_attachment($module_id)
	{
		return DB::table('module_attachments')->where(array('module_id' => $module_id, 'is_deleted' => 0))->update(array('is_deleted' => 1));
	}
}
