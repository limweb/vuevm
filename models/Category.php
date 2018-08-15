<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Category extends BaseModel
{
	protected $table = 'categories';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

