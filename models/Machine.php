<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Machine extends BaseModel
{
	protected $table = 'machines';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

