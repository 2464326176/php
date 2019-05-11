<?php
/**
 * Created by PhpStorm.
 * User: 24643
 * Date: 2018/1/7
 * Time: 17:15
 */
namespace app\wxchat\model;
use think\Model;
class Config extends Model
{

    protected function initialize()
    {
        $data=Wx::where('id','=',1)->select();
        dump($data);
    }








}