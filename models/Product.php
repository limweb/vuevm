<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Product extends BaseModel
{
	protected $table = 'products';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

