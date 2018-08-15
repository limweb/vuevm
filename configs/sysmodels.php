<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;
use Servit\Restsrv\Traits\HasPermissions;
use Servit\Restsrv\Traits\HasRoles;


class Package extends BaseModel
{

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $table='packages';
    protected $primaryKey='id';
}

class User extends BaseModel
{
    use HasRoles;
    public $grard_name = "web";
    // use SoftDeletes;
    // use LoadTrait;
    // protected $dates = ['deleted_at'];
    protected $table='users';
    protected $primaryKey='id';
    protected $hidden =   ["password"];
    protected $fillable = ['user','password','role_id'];
    // protected $guarded =  ['package'];


    public function __construct(array $attributes = [])
    {
        //$this->setRawAttributes(['expire_date' => Carbon::now()->addDays(7)],true);
        parent::__construct($attributes);
    }



    public function company()
    {
        if ($this->uuid == -1) {
            return $this->hasOne('Company', 'id', 'default_select_comp');
        } else {
            return $this->hasOne('Company', 'id', 'default_select_comp')->where('comp_code', $this->uuid);
        }
    }

    public function companies()
    {
        return $this->hasMany('Company', 'comp_code', 'uuid')->where('status', 1)->whereNull('deleted_at')->orderBy('sort', 'asc');
    }

    public function compmodules()
    {
        return $this->hasMany('Compmodule', 'comp_code', 'uuid');
    }

    public function profile()
    {
        return $this->hasOne('Profile');
    }
    
    public function scopeIsSysadmin($query)
    {
        return $query->where('sysadmin', 1);
    }

    public function scopeIsParent($query)
    {
        return $query->where('parent_id', 0);
    }


    public static function boot()
    {
        parent::boot();
        static::loaded(function ($model) {
            // dump('load');
            $model->role;
            $model->profile;
        });
    }
}


class Syspackage extends BaseModel
{
    protected $table = 'sys_packages';
}


class Module extends BaseModel
{
    protected $table='modules';
    protected $primaryKey='id';

    public function scopePermission($query, $role_id)
    {
        return Permission::where('role_id', $role_id)->where('module_id', $this->id)->first();
    }
}

class Profile extends BaseModel
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $table='profiles';
    protected $primaryKey='id';
}

class Company extends BaseModel
{

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    protected $table='companies';
    protected $primaryKey='id';
}
   
class Menu extends BaseModel
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function parent()
    {
        return $this->hasOne('Menu', 'id', 'parent_id');
    }

    public function menuitems()
    {
        return $this->hasMany('Menu', 'parent_id')->where('status',1)->orderBy('sort','asc');
    }

    public function tree()
    {
        return static::with(implode('.', array_fill(0, 10, 'menuitems')))->where('parent_id', '=', '0')->get();
    }
}

class Column extends BaseModel
{
    protected $table = 'columns';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

class Dbinfo extends BaseModel
{
    protected $table = 'dbinfos';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

class Permission extends BaseModel
{
    use HasRoles;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = true;
}

class Role extends BaseModel
{

    use HasPermissions;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function permissions()
    {
        return $this->belongsToMany('Permission', 'role_has_permissions');
    }

}

class App extends BaseModel
{
    protected $table = 'apps';
    protected $primaryKey = 'id';
    public $timestamps = true;
}


