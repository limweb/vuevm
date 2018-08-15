<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Maketo extends BaseModel
{
	protected $table = 'maketos';
	protected $primaryKey = 'id';
	public $timestamps = true;
} 

