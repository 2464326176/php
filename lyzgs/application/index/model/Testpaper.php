<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq:2464326176
 * Date: 2018/1/30 0030
 * Time: 09:44
 */
namespace app\index\model;
use think\Model;
class Testpaper extends Model
{
   public $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 数据库连接DSN配置
        'dsn'         => '',
        // 服务器地址
        'hostname'    => '47.94.175.62',
        // 数据库名
        'database'    => 'questions',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => 'Qwer666666',
        // 数据库连接端口
        'hostport'    => '3306',
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'sxz_',
        ];


    public function select_($select_id,$form){
        if($form=="city"){
            $data=\think\Db::query("select * from lyzg_city  where province=".$select_id);
            return $data;
        }
        if($form=="sta"){
            $data=\think\Db::connect($this->connection,true)->query('select * from sxz_stage');
            return $data;
        }
        if($form=="edi"){
            $data=\think\Db::connect($this->connection,true)->query('select * from sxz_stage a,sxz_edition b where a.sta_sub=b.sta_sub and a.sta_sub='.$select_id);
            return $data;
        }
        if($form=="gra"){
            $data=\think\Db::connect($this->connection,true)->query('select * from sxz_grade a,sxz_edition b where a.edi_num=b.edi_num and a.edi_num='.$select_id);
            return $data;
        }

    }


}