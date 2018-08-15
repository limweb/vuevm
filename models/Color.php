<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Color extends BaseModel
{
	protected $table = 'colors';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

