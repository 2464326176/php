<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24 0024
 * Time: 08:34
 */
namespace app\wxapi\controller;
use think\Controller;
use app\wxapi\model\User;
class Spuser extends Controller
{

    /*
     * 存贮微信小程序用户信息
     */
    public function insert_user(){
        $data=\think\Request::instance()->param();
        $openid=$data['openid'];
        $user = User::getByOpenID($openid);
        if (!$user)
        {
            User::newUser($data);
        }else{
            User::updateUser($data);
        }
        return $openid;
    }














}