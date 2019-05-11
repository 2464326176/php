<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq:2464326176
 * Date: 2018/2/2 0002
 * Time: 11:23
 */
namespace app\admin\controller;
use think\Controller;
Class Wxchat extends Common
{

    public function index(){
        $data=db('')->insert();
        return view();
    }



}