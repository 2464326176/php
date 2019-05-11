<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq：2464326176
 * Date: 2018/1/31
 * Time: 16:34
 */


namespace app\admin\controller;
use think\Controller;
Class Testpaper extends Common
{

        public function index(){
            $data=db('consult')->alias('a')
                ->join('lyzg_testpaper b','a.openid = b.user_id')->select();
            $this->assign("data",$data);
            return view();
        }

        public function reply(){
            $data=\think\Request::instance()->param();
            $id=$data['id'];
            $user_id=$data['user_id'];
            $content=$data['content'];
            $updata=[
                'content'=>$content,
            ];
            $dataup=db('testpaper')->where('id',$id)->update($updata);
            $ACCESS_TOKEN=get_access_token($this->APPID,$this->APPSECRET);
            _response($user_id,"text",$content,$ACCESS_TOKEN);

        }











}