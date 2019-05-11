<?php
namespace app\wxapi\model;

use think\Model;

class User extends Model
{

    /**
     * 用户是否存在
     * 返回查询信息
     */
    public static function getByOpenID($openid)
    {
        $user = db('spuser')->where("openid",$openid)->find();
        return $user;
    }
    //新增用户信息
    public static function newUser($data){
        return $user = db('spuser')->insert([
            'openid' => $data['openid'],
            'nickname'=>$data['nickname'],
            'avatarual'=>$data['avatarurl'],
            'gender'=>$data['gender'],
            'city'=>$data['city'],
            'province'=>$data['province'],
            'country'=>$data['country'],
            'language'=>$data['language'],
            ]);
    }
    public static  function updateUser($data){
        $update_date=[
            'nickname'=>$data['nickname'],
            'avatarual'=>$data['avatarurl'],
            'gender'=>$data['gender'],
            'city'=>$data['city'],
            'province'=>$data['province'],
            'country'=>$data['country'],
            'language'=>$data['language'],
        ];
        return $user=db('spuser')->where('openid',$data['openid'])->update($update_date);
    }
}