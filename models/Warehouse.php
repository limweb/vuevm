<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Warehouse extends BaseModel
{
	protected $table = 'warehouses';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

