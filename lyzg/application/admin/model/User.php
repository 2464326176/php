<?php
namespace app\admin\model;
use think\Model;
class User extends Model
{

    public function login($data){

        $admin= \think\Db::name('user')->alias('a')->join('usergroup b','a.levelname=b.group_id')->where('username',$data['username'])->find();

        if($admin){
            if($admin['checkstate']=='true'){
                if($admin['levelname']=='1') {
                    $loginnum = $admin['loginnum'] + 1;
                    $pwd = md5(md5($admin['salt']) . md5($data['password']));//密码
                    if ($admin['password'] === $pwd) {
                        $data = [
                            'loginnum' => $loginnum,
                            'loginip' => request()->ip(),
                            'logintime' => time(),
                        ];
                        $data = db('user')->where('uid', $admin['uid'])->update($data);
                        session('uid', $admin['uid']);
                        session('username', $admin['username']);
                        session('nickname', $admin['nickname']);
                        session('groupname', $admin['groupname']);
                        return 2; //登录密码正确的情况
                    } else {
                        return 3; //登录密码错误
                    }
                }else{
                    return 4; //本账号无权登录后台
                }

            }else{
                return 5;  //账号处于无审核状态
            }
        }else{
            return 1; //用户不存在的情况
        }
    }






}
