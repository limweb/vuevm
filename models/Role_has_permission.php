<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Role_has_permission extends BaseModel
{
	protected $table = 'role_has_permissions';
	protected $primaryKey = 'permission_id';
	public $timestamps = false;
} 

