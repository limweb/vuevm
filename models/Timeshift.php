<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Timeshift extends BaseModel
{
	protected $table = 'timeshifts';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

