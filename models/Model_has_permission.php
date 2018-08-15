<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Model_has_permission extends BaseModel
{
	protected $table = 'model_has_permissions';
	protected $primaryKey = 'permission_id';
	public $timestamps = false;
} 

