<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Stock extends BaseModel
{
	protected $table = 'stocks';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

