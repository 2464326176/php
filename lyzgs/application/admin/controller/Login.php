<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            // $this->check(input('code'));
        	$user=new User();
        	$num=$user->login(input('post.'));
        	return $num;
        }
        return view();
    }




    public function code(){
        $captcha = new Captcha();
        return $captcha->entry();
    }
    // 验证码检测
    // public function check($code='')
    // {
    //     if (!captcha_check($code)) {
    //         $this->error('验证码错误');
    //     } else {
    //         return true;
    //     }
    // }
     public function logout(){
         $data=\think\Db::table('sxz_user')->update(['outtime' =>time(),'uid'=>session('uid')]);
             session(null);
             $this->success('退出系统成功！',url('Login/index'));
    }


}
