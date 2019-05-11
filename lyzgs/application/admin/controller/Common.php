<?php
namespace app\admin\controller;
use think\Controller;
Class Common extends Controller
{

    /*
    * 微信配置文件加载
    */
    public $APPID;//填写你微信公众号的appid
    public $APPSECRET;//填写你微信公众号的appsecret
    public $TOKEN;//定义你公众号自己设置的token
    public $access_token;//填写你微信公众号的appsecret
    public function _initialize() {
        if(!session('uid') || !session('username')){
            $this->error('您尚未登录系统',url('login/index'));
        }else{
            $data=\think\Db::name('wx')->where('id',1)->select();
            $this->APPID=$data[0]['appid'];
            $this->APPSECRET=$data[0]['appsecret'];
            $this->TOKEN=$data[0]['token'];
            $this->access_token=$data[0]['access_token'];
        }

    }
    
}

