<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Unit extends BaseModel
{
	protected $table = 'units';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

