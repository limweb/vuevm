<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Servit\Restsrv\Libs\Request;
use Carbon\Carbon;
use \Servit\Restsrv\Traits\DbTrait;

class Password_resetController extends BaseController {

use DbTrait;

public function authorize(){
    return true;
}

/**
 *@noAuth
 *@url GET /all/
 *@url GET /all/$page
 *@url GET /all/$page/$perpage
 *@url GET /all/$page/$perpage/$ajax
 *@url GET /all/$page/$perpage/$ajax/$kw
 */
public function all($page = 1, $perpage = 10, $kw = '', $ajax = 0){
        //Capsule::enableQuerylog();
        $columns = Column::where('table_id', 'password_resets')->orderBy('sort', 'asc')->get();
        $kws = [];
        if ($kw) {
            $kws = explode(',', $kw);
        }
        $qry = Password_reset::query();
        $qry->whereRaw('1 = 1');
        $vkw = '';
        if ($kws) {
            foreach ($kws as $value) {
                $vv = '';
                @list($k, $v) = explode('=', $value);
                if ($v) {
                    $v1 = str_replace('#', '/', $v);
                    if ($v1) {
                        $v2 = str_replace('@', '.', $v1);
                        $vkw .= $v2 . ',';
                        $vv = $v2;
                    }
                } else {
                    $vv = $k;
                }

                if ($k && $v) {
                    $qry->Where($k, 'like', '%' . $vv . '%');
                } else {
                    $qry->where(function($query) use($columns,$vv){
                        foreach ($columns as $column) {
                            if($column->searchable){
                                $query->orWhere($column->key, 'like', '%' . $vv . '%');
                            }
                        }
                    });
                }
            }
        }

        $total = $qry->count();
        $skip = 0;
        if ($total >= $_ENV['MAXROWAJAX'] || $ajax) {
            if ($ajax == 0) {
                $ajax = 1;
            }

            $take = $perpage;
            $skip = ((($page - 1) < 0) ? 0 : $page - 1) * $perpage;
            if ($total < $skip) {
                $skip = 0;
            }
            $datas = $qry->skip($skip)->take($perpage)->get();
        } else {
            $datas = $qry->get();
        }

        $info = Dbinfo::where('table_name', 'password_resets')->first();
        //---addition----
        $method = [];
        $domains = [];

        $data = [
            'ajax' => $ajax,
            'status' => '1',
            'page' => $page,
            'perpage' => $perpage,
            'skip' => $skip,
            'total' => $total,
            'datacount' => count($datas),
            'datas' => $datas,
            'columns' => $columns,
            'info' => $info,
            'infos' => $info,
            'domains' => $domains,
            'method' => $method,
            //'sql' => Capsule::getQueryLog(),
        ];
        // dump($data);
        return $data;

}

protected function model(){
    return new Password_reset();
}

}