<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Model_has_role extends BaseModel
{
	protected $table = 'model_has_roles';
	protected $primaryKey = 'role_id';
	public $timestamps = false;
} 

