<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use \Servit\Restsrv\RestServer\RestController as BaseController;

class GentableController extends BaseController
{
    public function __construct(){
        
    }

/**
 *@noAuth
 *@url GET /index/
 */
    public function index()
    {
        echo '<center>';
        echo "Code gen system for Service Restful Api<br/>";
        echo "<b>Database: </b><h2 style='display:inline'>".$this->server->config->dbconfig['database']."</h2><br/>";
        echo '<hr/>';
        echo '<a href="/system/generator/migrate">Migrate</a><br/>';
        echo '<a href="/system/generator/migrate/clean">Migrate:clien</a><br/>';
        echo '<a href="/system/generator/migrate/fresh">Migrate:fresh</a><br/>';
        echo '<a href="/system/generator/migate/seeds">Seed Data</a><br/>';
        echo '<a href="/system/generator/genall/v3/1">Gen All V3 Overwrite</a><br/>';
        echo '<a href="/">Home</a>';
        echo '</center>';

    }



/**
*@noAuth
* model service controller columns menu  dbindos
*@url GET /msccmd/
*/
public function msccmd(){
    
$html = <<<HTML
        <form action="/system/generator/mscmd" method="post">
        
            tablename:<input type="text" name="tbname"   /><br/>
            basepath: <input type="text" name="basepath"  /><br/>
            timestamps: <input type="checkbox" name="timestamps" ><br/>
            pk: <input type="text" name="pk" value="id" /><br/>
            <input type="submit" value="Submit">        
            <input type="reset" value="reset">        
        </form>
HTML;
    echo $html;   
}

/**
*@noAuth
*@url POST /mscmd/
*/
public function postmscmd(){

try {
    $model = new stdClass();
    $tb = $this->server->data->posts->tbname;
    $basepath = $this->server->data->posts->basepath;
    $timestamps = $this->server->data->posts->timestamps;
    $timestamps == 'on' ? $timestamps = true  :  $timestamps = false ;
    $pk = $this->server->data->posts->pk;
    
    $model->table = $tb;
    $tb = $this->depluralize($tb);
    $tb = ucfirst($tb);
    $model->model = $tb;
    $model->timestamps = $timestamps;
    $model->pk = $pk;
    
    echo 'crete --menucollumn----</br>';
    $m = $this->columns($model->table,1);
    dump($m);
    echo 'crete ---service--</br>';
    $model->service = $this->makeserviefile($model);
    $servfile = __DIR__ . '/../../services/' . $model->model . 'Service.php';
    if (!class_exists($model->model . 'Service') && !file_exists($servfile)) {
        echo 'create ' . $servfile . "'\n<br/>";
        $handle = fopen($servfile, "w");
        fwrite($handle, $model->service);
        fclose($handle);
    } else {
        echo $servfile . " class or file exist\n<br/>";
    }
    echo 'crete ---controller----</br>';
    $this->gencontroller($tb);
    echo 'crete --dbinfo--------</br>';
    $dbinf = Dbinfo::where('table_name',$model->table)->first();
    if($dbinf){}else{ 
        $dbinf = new Dbinfo();
    }
    $dbinf->table_name = $model->table;
    $dbinf->title = $model->model;
    $dbinf->sub_title = $model->model;
    $dbinf->save();
    
    echo 'add menu---------<br/>';
    $menu = Menu::where('table_name',$model->table)->first();
    if($menu){} {
        $menu = new Menu();
    }
    $menu->menu_position = 'LEFTSIDEBAR';
    $menu->group = '1';
    $menu->table_name = $model->table;
    $menu->label = $model->model;
    $menu->permalink = $model->table;
    $menu->component = 'Template';
    $menu->icon_class = 'settings_brightness';
    $menu->classname = 'material-icons text-default';
    $menu->status = '1';
    $menu->parent_id = '0';
    $menu->description = '';
    $menu->sort = '99';
    $menu->created_by = 'system';
    $menu->updated_by = 'system';
    $menu->save();
    echo '</br>crete ---model----</br>';
    $this->genmodel($tb);
    echo "</br>successed<br/><a href='/system/routes'>Back</a>";
    
} catch (Exception $e) {
    echo $e->getMessage();   
}
    
}

/**
 *@noAuth
 *@url GET /migrate/
 */
public function migrate(){
    $this->up();
    echo 'Magration Successed!';
    $this->index();
}



/**
*@noAuth
*@url GET /migrate/clean/
*/
public function migrateclean(){
    $this->down();
    echo 'Successed! clean all database system';
    $this->index();
}



/**
*@noAuth
*@url GET /migrate/fresh/
*/
public function migaterefresh(){
    $this->down();
    $this->up();
    echo 'Successed! You Dbs Now Fresh';
    $this->index();

}



/**
*@noAuth
*@url GET /migate/seeds/
*/
public function migateseed(){
    $this->seeds();
    echo 'Data Seeds Successed!';
    $this->index();
}


/**
 *@noAuth
 *@url GET /columns/$table
 *@url GET /columns/$table/$ovr
 */
    public function columns($table = null,$ovr=0)
    {
        if($table == '$table') exit();
        if($ovr=='$ovr') $ovr = 0;
        if ($table) {
            if($ovr){
                Column::where('table_id', $table)->delete();
            } else {
                $cols = Column::where('table_id', $table)->get();
                if($cols){
                   throw new Exception('Table Columns is exists', 1);
                }
            }
          return  $this->makecols($table,$ovr);
        }

    }

/**
 *@noAuth
 *@url GET /controller/$table
 */
    public function gencontroller($table = null)
    {
        if($table == '$table') exit();
        if ($table) {
            dump($table);
            $model = new \stdClass();
            $modelname = ucfirst($this->depluralize($table));
            $model->table = $table;
            $model->model = $modelname;
            $my_file = __DIR__ . '/../../controllers/' . $modelname . 'Controller.php';
            dump($my_file);
            if (!class_exists($modelname.'Controller') || !file_exists($my_file)) {
                $controller = $this->makecontroller($model);
                $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
                fwrite($handle, $controller);
                fclose($handle);
            } else {
                echo 'มีไฟล์แล้ว';
            }
        }
    }

/**
 *@noAuth
 *@url GET /model/$table
 *@url GET /model
 */
    public function genmodel($table = null)
    {
        if($table== '$table' ) {
            exit();
        } 
        if ($table) {
            $modelname = ucfirst($this->depluralize($table));
            dump($table, $modelname);
            $my_file = __DIR__ . '/../../models/' . $modelname . '.php';
            $class_exists = (!class_exists($modelname));
            if (!file_exists($my_file) && $class_exists) {
                $cols = Capsule::select("SELECT IS_NULLABLE,COLUMN_DEFAULT,TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,NUMERIC_PRECISION,NUMERIC_SCALE,COLUMN_TYPE,COLUMN_KEY,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME= ? AND Table_SCHEMA= ? ", [$table, DB_NAME]);
                $i = 0;
                $pk = 'id';
                $timestamps = 0;
                foreach ($cols as $col) {
                    if (empty($pk) && $col->COLUMN_KEY == 'PRI') {
                        $pk = $col->COLUMN_NAME;
                    }
                    if ($col->COLUMN_NAME == 'created_at') {
                        $timestamps = 1;
                    }
                }
                if ($timestamps) {
                    $timestamps = 'true';
                } else {
                    $timestamps = 'false';
                }
                $mode = new stdClass();
                $mode->table = $table;
                $mode->pk = $pk;
                $mode->timestamps = $timestamps;
                $mode->model = $modelname;
                $modeldata = $this->makemodlefile($mode);
                echo 'created Model Name: ', $my_file;
                $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
                fwrite($handle, $modeldata);
                fclose($handle);
                echo "\n<br/>";
                echo 'composer dump-autoload complete';
                exec('composer dump-autoload');
            } else {
                echo 'มี model นี้แล้ว';
            }
        }
    }

/**
 *@noAuth
 *@url GET /genall/
 *@url GET /genall/ovr/$ovr
 *@url GET /genall/$basepath/$ovr
 */
    public function genall($basepath=null,$ovr=0)
    {
        if($basepath == '$basepath') {
            $basepath = 'v1/';
        } else {
            if($basepath) {
                $basepath = $basepath.'/';
            } else {
                $basepath = 'v1/';
            }
        }
        if($ovr=='$orv') $ovr=0;
        // dump($basepath,$ovr);
        $this->index();

        echo '<br/>Gen Collumns<hr/>';
        if($ovr){
            Capsule::select('truncate columns;');
        }
        $models = [];
        $tables = Capsule::select('show tables');
        // if($ovr) Capsule::select('truncate columns;');
        foreach ($tables as $table) {
            $tb = $table->{'Tables_in_' . DB_NAME};
            if ($ovr) {
                Column::where('table_id', $tb)->delete();
            } else {
                $cols = Column::where('table_id', $tb)->get();
                // dump($tb,$cols->count());
                if ($cols->count() > 0 ) {
                    echo  "Table Columns is exists\n<br/>";
                } else {
                    $ovr = 1;
                }
            }
            $t = $this->makecols($tb,$ovr);
            $t->modeldata = $this->makemodlefile($t);
            $t->service = $this->makeserviefile($t);
            $t->controller = $this->makecontroller($t);
            $models[] = $t;
            }
        echo '<hr/>';
        $sort = 10;

        $menu = Menu::where('label','Dashboard')->first();
        if($menu){  } else {
            $menu = new Menu();
            $menu->menu_position = 'LEFTSIDEBAR';
            $menu->group = '1';
            $menu->table_name = '';
            $menu->label = 'Dashboard';
            $menu->permalink = 'dashboard';
            $menu->component = 'Template';
            $menu->icon_class = 'dashboard';
            $menu->classname = 'material-icons text-primary';
            $menu->status = '1';
            $menu->parent_id = '0';
            $menu->description = '';
            $menu->sort = '0';
            $menu->crated_by = 'system';
            $menu->updated_by = 'system';
            $menu->save();
        }

        $menu = Menu::where('label', 'System')->first();
        if($menu){} else {
            $menu = new Menu();
            $menu->menu_position = 'LEFTSIDEBAR';
            $menu->group = '2';
            $menu->table_name = '';
            $menu->label = 'System';
            $menu->permalink = '';
            $menu->component = 'Template';
            $menu->icon_class = 'settings_brightness';
            $menu->classname = 'material-icons text-default';
            $menu->status = '1';
            $menu->parent_id = '0';
            $menu->description = '';
            $menu->sort = '98';
            $menu->crated_by = 'system';
            $menu->updated_by = 'system';
            $menu->save();
        }
           $sysgroup = $menu->id;   
        
        $menu = Menu::where('label','Admin')->first();
        if($menu){} else {
            $menu = new Menu();
            $menu->menu_position = 'LEFTSIDEBAR';
            $menu->group = '2';
            $menu->table_name = '';
            $menu->label = 'Admin';
            $menu->permalink = '';
            $menu->component = 'Template';
            $menu->icon_class = 'settings_brightness';
            $menu->classname = 'material-icons text-default';
            $menu->status = '1';
            $menu->parent_id = '0';
            $menu->description = '';
            $menu->sort = '99';
            $menu->crated_by = 'system';
            $menu->updated_by = 'system';
            $menu->save();
        }
        $admingroup = $menu->id;

        $systemtables = [
            'columns',
            'menus',
            'dbinfos',
        ];

        $admintables = [
            'apps',
            'users',
            'password_resets',
            'profiles',
            'companies',
            'roles',
            'permissions',
            'model_has_permissions',
            'model_has_roles',
            'role_has_permissions',
            'modules',
            'packages',
            'syspackages',
        ];

        foreach ($models as $model) {
            // dump($model);
            $dbinfo = Dbinfo::where('table_name',$model->table)->first();
            if(!$dbinfo){
                $dbinf = new Dbinfo();
                $dbinf->table_name = $model->table;
                $dbinf->title = $model->model;
                $dbinf->sub_title = $model->model;
                $dbinf->save();
            }



            
            $menu = Menu::where('table_name',$model->table)->first();
            // dump($menu);
            
            if(!$menu){  $menu = new Menu(); }
                $menu->menu_position = 'LEFTSIDEBAR';
                $menu->table_name = $model->table;
                $menu->label = $model->model;
                $menu->permalink = $model->table;
                if(in_array($model->table,$systemtables)){
                    $menu->component =  ucfirst($model->table);
                }else{
                    $menu->component = 'Crudtemplate';
                }
                $menu->icon_class = 'dashboard';
                $menu->classname = 'material-icons text-default';
                $menu->status = '1';
                if(in_array($model->table, $admintables)){
                    $menu->group = '2';
                    $menu->parent_id = $admingroup;
                } elseif(in_array($model->table,$systemtables)){
                    $menu->group = '2';
                    $menu->parent_id = $sysgroup;
                } else {
                    $menu->group = '1';
                    $menu->parent_id =0;
                }
                
                $menu->description = '';
                $menu->sort = $sort;
                $menu->crated_by = 'system';
                $menu->updated_by = 'system';
                $menu->save();
                $sort++;

            $modelfile = __DIR__ . '/../../models/' . $model->model . '.php';
            if (!class_exists($model->model) && !file_exists($modelfile)) {
                echo 'create ' . $modelfile . "'\n<br/>";
                $handle = fopen($modelfile, "w");
                fwrite($handle, $model->modeldata);
                fclose($handle);
            } else {
                echo $modelfile . " class or file exist\n<br/>";
            }
            
            $servfile = __DIR__.'/../../services/'.$model->model.'Service.php';
            if (!class_exists($model->model.'Service') && !file_exists($servfile)) {
                echo 'create ' . $servfile . "'\n<br/>";
                $handle = fopen($servfile, "w");
                fwrite($handle, $model->service);
                fclose($handle);
            } else {
                echo $servfile . " class or file exist\n<br/>";
            }

            $controllerfile = __DIR__ . "/../../controllers/" . $model->model . "Controller.php";
            if (!class_exists($model->model.'Controller') &&!file_exists($controllerfile)) {
                echo $model->model . "Controller\n<br/>";
                echo '<textarea>', $model->controller, '</textarea><br/>';
                dump($controllerfile);
                $handle = fopen($controllerfile, 'w') or die('Cannot open file:  ' . $controllerfile);
                fwrite($handle, $model->controller);
                fclose($handle);

            } else {
                echo $model->model . "Controller.php file is exists\n<br/><hr/>";
            }

        }
        echo '<br/>gen Routers<br/>';
        echo '<hr/>';
        $routedata = "<?php\n";
        $routefile = __DIR__ . "/../../route/routebygen.php";
        $handle = fopen($routefile, "w");
        echo '<br/><hr/>';
        foreach ($models as $model) {
            echo $model->model . "\n<br/>";
            $path = '/api/'.$basepath.$model->table;
            $routedata .= " \$server->addClass('{$model->model}Controller','$path'); \n";
        }
        fwrite($handle, $routedata);
        fclose($handle);

        echo '<hr/>';
    }

    private function depluralize($word)
    {
            // Here is the list of rules. To add a scenario,
                    // Add the plural ending as the key and the singular
                    // ending as the value for that key. This could be
                    // turned into a preg_replace and probably will be
                    // eventually, but for now, this is what it is.
                    //
                    // Note: The first rule has a value of false since
                    // we don't want to mess with words that end with
                    // double 's'. We normally wouldn't have to create
                    // rules for words we don't want to mess with, but
                    // the last rule (s) would catch double (ss) words
                    // if we didn't stop before it got to that rule.
                    $rules = array(
                        'ss' => false,
                        'os' => 'o',
                        'ies' => 'y',
                        'xes' => 'x',
                        'oes' => 'o',
                        'ies' => 'y',
                        'ves' => 'f',
                        's' => '');
            // Loop through all the rules and do the replacement.
                    foreach (array_keys($rules) as $key) {
            // If the end of the word doesn't match the key,
                        // it's not a candidate for replacement. Move on
                        // to the next plural ending.
                        if (substr($word, (strlen($key) * -1)) != $key) {
                            continue;
                        }

            // If the value of the key is false, stop looping
                        // and return the original version of the word.
                        if ($key === false) {
                            return $word;
                        }

            // We've made it this far, so we can do the
                        // replacement.
                        return substr($word, 0, strlen($word) - strlen($key)) . $rules[$key];
                    }
                    return $word;
    }


private function makemodlefile($model) {
$modeldata = "<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Servit\Restsrv\Model\BaseModel;\n\n
class " . $model->model . " extends BaseModel
{
\tprotected \$table = '$model->table';
\tprotected \$primaryKey = '$model->pk';
\tpublic \$timestamps = $model->timestamps;
} \n\n";
return $modeldata;
}

private function makeserviefile($model) {
$servicedata = "<?php
use \Servit\Restsrv\RestServer\RestException as TestException;
use \Servit\Restsrv\Traits\DbTrait as DbTrait;
use \Servit\Restsrv\Service\BaseService as BaseService;
use \Servit\Restsrv\Service\BasedbService as BasedbService;
use Illuminate\Database\Capsule\Manager as Capsule;
\n
class " . $model->model . "Service extends BaseService
{\n\n\n
}\n";
return $servicedata;

}

private function makecontroller($model)
{

$controller = "<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Servit\Restsrv\Libs\Request;
use Carbon\Carbon;
use \Servit\Restsrv\Traits\DbTrait;

class {$model->model}Controller extends BaseController {

use DbTrait;

public function authorize(){
    return true;
}

/**
 *@noAuth
 *@url GET /all/
 *@url GET /all/\$page
 *@url GET /all/\$page/\$perpage
 *@url GET /all/\$page/\$perpage/\$ajax
 *@url GET /all/\$page/\$perpage/\$ajax/\$kw
 */
public function all(\$page = 1, \$perpage = 10, \$kw = '', \$ajax = 0){
        //Capsule::enableQuerylog();
        \$columns = Column::where('table_id', '$model->table')->orderBy('sort', 'asc')->get();
        \$kws = [];
        if (\$kw) {
            \$kws = explode(',', \$kw);
        }
        \$qry = $model->model::query();
        \$qry->whereRaw('1 = 1');
        \$vkw = '';
        if (\$kws) {
            foreach (\$kws as \$value) {
                \$vv = '';
                @list(\$k, \$v) = explode('=', \$value);
                if (\$v) {
                    \$v1 = str_replace('#', '/', \$v);
                    if (\$v1) {
                        \$v2 = str_replace('@', '.', \$v1);
                        \$vkw .= \$v2 . ',';
                        \$vv = \$v2;
                    }
                } else {
                    \$vv = \$k;
                }

                if (\$k && \$v) {
                    \$qry->Where(\$k, 'like', '%' . \$vv . '%');
                } else {
                    \$qry->where(function(\$query) use(\$columns,\$vv){
                        foreach (\$columns as \$column) {
                            if(\$column->searchable){
                                \$query->orWhere(\$column->key, 'like', '%' . \$vv . '%');
                            }
                        }
                    });
                }
            }
        }

        \$total = \$qry->count();
        \$skip = 0;
        if (\$total >= \$_ENV['MAXROWAJAX'] || \$ajax) {
            if (\$ajax == 0) {
                \$ajax = 1;
            }

            \$take = \$perpage;
            \$skip = (((\$page - 1) < 0) ? 0 : \$page - 1) * \$perpage;
            if (\$total < \$skip) {
                \$skip = 0;
            }
            \$datas = \$qry->skip(\$skip)->take(\$perpage)->get();
        } else {
            \$datas = \$qry->get();
        }

        \$info = Dbinfo::where('table_name', '$model->table')->first();
        //---addition----
        \$method = [];
        \$domains = [];

        \$data = [
            'ajax' => \$ajax,
            'status' => '1',
            'page' => \$page,
            'perpage' => \$perpage,
            'skip' => \$skip,
            'total' => \$total,
            'datacount' => count(\$datas),
            'datas' => \$datas,
            'columns' => \$columns,
            'info' => \$info,
            'infos' => \$info,
            'domains' => \$domains,
            'method' => \$method,
            //'sql' => Capsule::getQueryLog(),
        ];
        // dump(\$data);
        return \$data;

}

protected function model(){
    return new {$model->model}();
}

}";
return $controller;

}

    private function makeroute(){

    }

    private function makecols($table,$ovr) 
    {

        $coldisable = ['id','created_at','updated_at','created_by','updated_by'];

        $t = new \stdClass();
        $pk = '';
        $timestamps = 0;
        $tb = $table;
        $t->table = $tb;
        $notusedtb = [];
        if (!in_array($tb, $notusedtb)) {
            echo $tb, "<br/>\n";

            $cols = Capsule::select("SELECT IS_NULLABLE,COLUMN_DEFAULT,TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,NUMERIC_PRECISION,NUMERIC_SCALE,COLUMN_TYPE,COLUMN_KEY,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME= ? AND Table_SCHEMA= ? ", [$tb, DB_NAME]);
            $i = 0;
            foreach ($cols as $col) {
                if (empty($pk) && $col->COLUMN_KEY == 'PRI') {
                    $pk = $col->COLUMN_NAME;
                }

                if ($col->COLUMN_NAME == 'created_at') {
                    $timestamps = 1;
                }

                $c = new Column();
                $c->table_id = $col->TABLE_NAME;
                $c->key = $col->COLUMN_NAME;
                $c->key_view = '';
                $cname = strtr($col->COLUMN_NAME, "_", " ");
                $c->label = ucwords($cname);

                if ($col->IS_NULLABLE == 'NO') {
                    $c->required = 'required';
                }

                if (in_array($col->DATA_TYPE, ['date', 'time', 'datetime', 'timestamp', 'year'])) {
                    $c->inputtype = 'datetime-local';
                } else if (in_array($col->DATA_TYPE, ['tinyint', 'boolean', 'smallint', 'mediumint', 'int', 'integer', 'bigint', 'decimal', 'dec', 'numeric', 'fixed', 'float', 'double', 'bit'])) {
                        // + "COLUMN_KEY"  : "int(10) unsigned"
                    if($col->DATA_TYPE == 'tinyint' && $col->NUMERIC_PRECISION <=3 ) {
                        $c->inputtype = 'checkbox';
                    } else {
                        $c->inputtype = 'number';
                    }
                    $c->numscale = $col->NUMERIC_SCALE;
                    $c->datalenth = $col->NUMERIC_PRECISION;
                        // $c->unsigned = 0;
                } elseif (in_array($col->DATA_TYPE, ['blob', 'mediumblob', 'longblob', 'tinytext', 'text', 'mediumtext', 'longtext', 'enum', 'set'])) {
                    $c->inputtype = 'textarea';
                } else {
                    if ($col->DATA_TYPE == 'varchar') {
                        if ($col->CHARACTER_MAXIMUM_LENGTH > 255) {
                            $c->inputtype = 'textarea';
                        } else {
                            $c->inputtype = 'textinput';
                        }
                    } else {
                        $c->inputtype = 'textinput';
                    }
                    $c->datalenth = $col->CHARACTER_MAXIMUM_LENGTH;
                }
                $c->datatype = $col->DATA_TYPE;
                if(in_array($col->COLUMN_NAME,$coldisable)){
                    $c->visible = 0;
                } else {
                    $c->visible = 1;
                }
                    // $c->classname = '';
                    // $c->width = '';
                    // $c->height = '';
                $c->searchable = 1;
                $c->orderable = 1;
                    // $c->search = '';
                $c->sort = $i;
                $c->json = json_encode($col, JSON_UNESCAPED_UNICODE);
                    // $c->datadic = '';
                $c->description = $col->COLUMN_COMMENT;
                // dump($ovr);
                if($ovr){
                    $c->save();
                }
                $i++;
            }
            $model = ucfirst($this->depluralize($tb));
            $t->model = $model;
            $t->table = $tb;
            $t->pk = $pk;

            if ($timestamps) {
                $t->timestamps = 'true';
            } else {
                $t->timestamps = 'false';
            }


        }

        return $t;
    }

    private function up() {
        Capsule::schema()->disableForeignKeyConstraints();
        if (!Capsule::schema()->hasTable('users')) {
            Capsule::schema()->create(
                'users',
                function ($table) {
                    $table->increments('id');
                    $table->string('email');
                    $table->string('password');
                    $table->string('ref_token')->nullable();
                    $table->unsignedInteger('profile_id');
                    $table->integer('level')->unsigned()->default(10);
                    $table->boolean('status')->default(1);
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('password_resets')) {
            Capsule::schema()->create(
                'password_resets',
                function ($table) {
                    $table->string('email');
                    $table->string('token');
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('dbinfos')) {
            Capsule::schema()->create(
                'dbinfos',
                function ($table) {
                    $table->increments('id');
                    $table->string('title');
                    $table->boolean('status')->default(1);
                    $table->boolean('v_insert')->default(1);
                    $table->boolean('v_update')->default(1);
                    $table->boolean('v_delete')->default(1);
                    $table->boolean('v_export')->default(1);
                    $table->boolean('v_print')->default(1);
                    $table->boolean('v_import')->default(1);
                    $table->boolean('v_view')->default(1);
                    $table->string('level')->default(10);
                    $table->string('table_name');
                    $table->string('sub_title');
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('columns')) {
            Capsule::schema()->create ('columns', function($table)
            {
                $table->increments('id');
                $table->string('table_id');
                $table->string('key');
                $table->string('key_view')->nullable();
                $table->string('key_id')->nullable();
                $table->string('key_ref')->nullable();
                $table->string('label');
                $table->string('inputtype');
                $table->string('datatype');
                $table->integer('level')->unsigned()->default(10);
                $table->boolean('visible')->default(true);
                $table->boolean('readonly')->default(false);
                $table->boolean('export')->default(true);
                $table->boolean('gridview')->default(true);
                $table->boolean('frmview')->default(true);
                $table->boolean('searchable')->default(true);
                $table->boolean('orderable')->default(true);
                $table->boolean('status')->unsigned()->default(1);
                $table->string('required')->nullable();
                $table->string('sort')->default(0);
                $table->integer('datalenth')->default(0);
                $table->integer('numscale')->default(0);
                $table->integer('unsigned')->default(0);
                $table->string('classname')->nullable();
                $table->string('width')->nullable();
                $table->string('height')->nullable();
                $table->string('datadic')->nullable();
                $table->text('description')->nullable();
                $table->string('created_by')->default('system');
                $table->string('updated_by')->default('system');
                $table->string('search')->default('{"search":"", "regex":"" }');
                $table->text('json')->nullable();
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('menus')) {
            Capsule::schema()->create(
                'menus',
                function ($table) {
                    $table->increments('id');
                    $table->string('menu_position')->nullable();
                    $table->tinyInteger('group')->nullable();
                    $table->string('table_name')->nullable();
                    $table->string('label')->nullable();
                    $table->string('permalink')->nullable();
                    $table->string('component')->nullable();
                    $table->string('icon_class')->nullable();
                    $table->string('classname')->nullable();
                    $table->boolean('status')->default(1);
                    $table->unsignedInteger('parent_id');
                    $table->string('description')->nullable();
                    $table->unsignedInteger('sort')->default(0);
                    $table->string('crated_by')->default('system');
                    $table->string('updated_by')->default('system');
                    $table->tinyInteger('level')->default(10);
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('permissions')) {
            Capsule::schema()->create('permissions', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->string('guard_name')->defaule('web');
                $table->string('description')->nullable();
                $table->integer('level')->unsigned()->default(10);                
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('roles')) {
            Capsule::schema()->create('roles', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->string('guard_name')->default('web');
                $table->integer('level')->unsigned()->default(10);                
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('model_has_permissions')) {
            Capsule::schema()->create('model_has_permissions', function ($table) {
                $table->integer('permission_id')->unsigned();
                $table->morphs('model');

                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions')
                    ->onDelete('cascade');

                $table->primary(['permission_id', 'model_id', 'model_type']);
            });
        }
        
        if (!Capsule::schema()->hasTable('model_has_roles')) {
            Capsule::schema()->create('model_has_roles', function ($table) {
                $table->integer('role_id')->unsigned();
                $table->morphs('model');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');

                $table->primary(['role_id', 'model_id', 'model_type']);
            });
        }
        
        if (!Capsule::schema()->hasTable('role_has_permissions')) {
            Capsule::schema()->create('role_has_permissions', function ($table)  {
                $table->integer('permission_id')->unsigned();
                $table->integer('role_id')->unsigned();

                $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions')
                    ->onDelete('cascade');

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade');

                $table->primary(['permission_id', 'role_id']);
            });
        }

        if (!Capsule::schema()->hasTable('packages')) {
            Capsule::schema()->create(
                'packages',
                function ($table) {
                    $table->increments('id');
                    $table->string('name');
                    $table->string('desc');
                    $table->string('uuid');
                    $table->string('comp_db');
                    $table->integer('account')->default(1);
                    $table->string('modules');
                    $table->integer('tb_limit')->default(0);
                    $table->string('remark');
                    $table->text('json_data');
                    $table->string('promotionid');
                    $table->string('showpublic');
                    $table->timestamp('deleted_at')->nullable();
                    $table->boolean('status')->default(1);
                    $table->integer('level')->unsigned()->default(10);                    
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');                                        
                    $table->timestamps();
                }
            );
        }
        
        if (!Capsule::schema()->hasTable('companies')) {
            Capsule::schema()->create(
                'companies',
                function ($table) {
                    $table->increments('id');
                    $table->string('companyname');
                    $table->string('comp_uuid');
                    $table->string('comp_code');
                    $table->string('path')->nullable();
                    $table->boolean('status')->default(1);
                    $table->integer('sort');
                    $table->timestamp('deleted_at');
                    $table->integer('level')->unsigned()->default(10);                    
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');                                        
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('profiles')) {
            Capsule::schema()->create(
                'profiles',
                function ($table) {
                    $table->increments('id');
                    $table->string('comp_code')->nullable();
                    $table->string('user_id')->nullable();
                    $table->string('fname')->nullable();
                    $table->string('lname')->nullable();
                    $table->string('email')->nullable();
                    $table->string('address1')->nullable();
                    $table->string('address2')->nullable();
                    $table->string('district',100)->nullable();
                    $table->string('provice',100)->nullable();
                    $table->string('country',100)->nullable();
                    $table->string('zipcode',20)->nullable();
                    $table->string('tel',50)->nullable();
                    $table->timestamp('deleted_at')->nullable();
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');
                    $table->integer('level')->unsigned()->default(10);                    
                    $table->timestamps();
                }
            );
        }

        if (!Capsule::schema()->hasTable('modules')) {
            Capsule::schema()->create(
                'modules',
                function ($table) {
                    $table->increments('id');
                    $table->string('name');
                    $table->string('description')->nullable();
                    $table->string('route')->nullable();
                    $table->string('doctype')->nullable();
                    $table->boolean('status')->default(1);
                    $table->integer('level')->default(10);
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');                    
                    $table->timestamps();
                }
            );
        }
        
        if (!Capsule::schema()->hasTable('syspackages')) {
            Capsule::schema()->create(
                'syspackages',
                function ($table) {
                    $table->increments('id');
                    $table->integer('level')->unsigned()->default(10);                    
                    $table->string('name');
                    $table->string('desc')->nullable();
                    $table->string('comp_db')->nullable();
                    $table->string('account')->nullable();
                    $table->string('modules')->nullable();
                    $table->string('tb_limit')->nullable();
                    $table->text('remark')->nullable();
                    $table->boolean('status')->default(1);
                    $table->text('json_data')->nullable();
                    $table->string('promotionid')->nullable();
                    $table->string('showpublic')->nullable();
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');                    
                    $table->timestamps();
                }
            );
        }
        
        if (!Capsule::schema()->hasTable('apps')) {
            Capsule::schema()->create(
                'apps',
                function ($table) {
                    $table->increments('id');
                    $table->string('popkey')->unique();
                    $table->string('pop_value');
                    $table->string('v1')->nullable();
                    $table->string('v2')->nullable();
                    $table->decimal('v3', 10, 2)->default(0);
                    $table->decimal('v4', 10, 2)->default(0);
                    $table->text('v5')->nullable();
                    $table->text('v6')->nullable();
                    $table->boolean('status')->default(1);
                    $table->string('created_by')->default('system');
                    $table->string('updated_by')->default('system');                    
                    $table->timestamps();
                }
            );
        }
        Capsule::schema()->enableForeignKeyConstraints();
    }

    private function down() {
        Capsule::schema()->disableForeignKeyConstraints();
        Capsule::schema()->dropIfExists('users');
        Capsule::schema()->dropIfExists('password_resets');
        
        Capsule::schema()->dropIfExists('dbinfos');
        Capsule::schema()->dropIfExists('columns');
        Capsule::schema()->dropIfExists('menus');
        
        Capsule::schema()->dropIfExists('permissions');
        Capsule::schema()->dropIfExists('roles');
        Capsule::schema()->dropIfExists('model_has_permissions');
        Capsule::schema()->dropIfExists('model_has_roles');
        Capsule::schema()->dropIfExists('role_has_permissions');
        
        Capsule::schema()->dropIfExists('packages');
        Capsule::schema()->dropIfExists('companies');
        Capsule::schema()->dropIfExists('profiles');
        Capsule::schema()->dropIfExists('modules');
        Capsule::schema()->dropIfExists('syspackages');
        Capsule::schema()->dropIfExists('apps');
        Capsule::schema()->enableForeignKeyConstraints();
    }
    
    private function seeds() {
        echo '<b>Start ----Seeding Data----</b>';
        //----------------apps--------------------
        echo '<hr/>Apps---Data<br/>';
        $app = App::where('popkey','APP_NAME')->first();
        if($app){}else{
            $app = new App();
        }
        $app->popkey = 'APP_NAME';
        $app->pop_value = 'MONGKOL';
        $app->save();

        $app = App::where('popkey', 'Company')->first();
        if($app){}else{
            $app = new App();
        }
        $app->popkey = 'Company';
        $app->pop_value = 'MONGKOL';
        $app->save();


        echo '<hr/>Add User Admin@admin.com/password---Data<br/>';
        $admin = new User();
        $admin->email = 'admin@admin.com';
        $admin->password =  'password';
        $admin->level = 99;
        $admin->save();
        //----------------permission--------------------
        echo '<hr/>Permissions---Data<br/>';
        $permission_created = new Permission();
        $permission_created->name = 'created articles';
        $permission_created->guard_name = 'web';
        $permission_created->save();
        $permission_edit    = new Permission();
        $permission_edit->name = 'edit articles';
        $permission_edit->guard_name = 'web';
        $permission_edit->save();
        $permission_delete  = new Permission();
        $permission_delete->name = 'delete articles';
        $permission_delete->guard_name = 'web';
        $permission_delete->save();
        $permission_read    = new Permission();
        $permission_read->name = 'read articles';
        $permission_read->guard_name = 'web';
        $permission_read->save();
        $permission_export  = new Permission();
        $permission_export->name = 'export articles';
        $permission_export->guard_name = 'web';
        $permission_export->save();
        $permission_print   = new Permission();
        $permission_print->name = 'print articles';
        $permission_print->guard_name = 'web';
        $permission_print->save();
        $permission_auth    = new Permission();
        $permission_auth->name = 'auth articles';
        $permission_auth->guard_name = 'web';
        $permission_auth->save();
        //----------------roles--------------------
        echo '<hr/>Role---Data<br/>';
        echo 'add employee role<br/>';
        $role_emp    = new Role();
        $role_emp->name ='employee';
        $role_emp->save();
        
        echo 'add leeder role<br/>';
        $role_leeder = new Role();
        $role_leeder->name ='leeder';
        $role_leeder->save();
        
        echo 'add owner role<br/>';
        $role_owner  = new Role();
        $role_owner->name ='owner';
        $role_owner->save();
        
        echo 'add admin role<br/>';
        $role_admin  = new Role();
        $role_admin->name ='admin';
        $role_admin->save();
        $permissions = Permission::get();

        $role_owner->syncPermissions($permissions);//----------------User--------------------
        $role_admin->syncPermissions($permissions);//----------------User--------------------
        $role_emp->givePermissionTo($permission_read);
        $role_leeder->givePermissionTo($permission_read);
        
        $role_emp->givePermissionTo($permission_created);
        $role_leeder->givePermissionTo($permission_created);

        $role_emp->givePermissionTo($permission_edit);
        $role_leeder->givePermissionTo($permission_edit);
        $role_emp->givePermissionTo($permission_print);
        $role_leeder->givePermissionTo($permission_print);
        
        $role_leeder->givePermissionTo($permission_export);
        $role_leeder->givePermissionTo($permission_auth);


        echo '<hr/>User---Data<br/>';
        $admin->assignRole('admin');
        echo '<hr/>';
        
    }


}