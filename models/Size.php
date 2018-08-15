<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Size extends BaseModel
{
	protected $table = 'sizes';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

