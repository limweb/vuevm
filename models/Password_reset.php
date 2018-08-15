<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;


class Password_reset extends BaseModel
{
	protected $table = 'password_resets';
	protected $primaryKey = '';
	public $timestamps = true;
} 

