<?php
namespace app\admin\controller;
use think\Controller;
Class Admin extends Common
{
    // 输出
    public function index(){
        if(request()->isPost()){
            $search=\think\Request::instance()->param('search');
            // dump($search);
            $search= \think\Db::name('user')->alias('a')->join('usergroup b','a.levelname=b.group_id')->where('username|nickname|loginip|groupname','like',"%$search%")->select();
            // dump($search);die;
            if($search){
                 $this->assign('data',$search);
                return view();
            }else{
               $this->error('未查询到相关内容'); 
            }
           
        }else{
            $data= \think\Db::name('user')->alias('a')->join('usergroup b','a.levelname=b.group_id')->select();
            $this->assign('data',$data);
            
            return view();
        }

           
    }
  
    public function ajaxpwd(){
       if (\think\Request::instance()->isAjax()){
            
            $id=\think\Request::instance()->param('id');
            $password=\think\Request::instance()->param('password');
            $data= \think\Db::name('user')->where('id',$id)->find();
            if($data['password']==$password){
                return ['info'=>'操作成功'];
            }else{
                // $this->error('错误');
            }          
        }else{
            // $this->error('错误');
        }      
    }
    // 添加
    public function add()
    {
        if(request()->isPost()){
            // echo "ok"; die;
            $password=input('password');
            $salt=randnum();//密码前缀
            $pwd=md5(md5($salt).md5($password));//密码
            $data=[
                'password'=>$pwd,
                'salt'=>$salt,
                'username'=>input('username'),
                'nickname'=>input('nickname'),
                'checkstate'=>input('checkstate'),
                'levelname'=>input('levelname'),
            ];

            $validate = \think\Loader::validate('User');
            if(!$validate->check($data)){
                return $this->error($validate->getError());
            }else{

                $data= \think\Db::name('user')->insert($data);
            // dump($data);die;
                if($data){
                    return $this->success('添加成功');
                }else{
                return $this->error('添加失败');
                }
            }
            return;
        }else{

            $data= \think\Db::name('usergroup')->select();
            $this->assign('data',$data);         
            return view();
        }
        
    }
    //修改
    public function mod(){
        if(request()->isGet()){
            $uid=\think\Request::instance()->param('uid');
            // dump($id);die;
         
            $data=\think\Db::query('select * from sxz_user where uid ='.$uid);
            
            $usergroup=\think\Db::query('select * from sxz_usergroup');
            
            $this->assign('usergroup',$usergroup);
            $this->assign('data',$data);
            return view('modify'); 
    }else{
         return $this->error('参数错误');
    }
    }
    
    public function modify(){    
            if(request()->isPost()){
            $uid=\think\Request::instance()->param('uid');
            // dump($id);die;
            if(empty(input('oldpassword'))){
                // dump('ok');die;
                $data=[
                'username'=>input('username'),
                'nickname'=>input('nickname'),
                'checkstate'=>input('checkstate'),
                'levelname'=>input('levelname'),
            ];
            }else{
                $data=[
                'username'=>input('username'),
                'nickname'=>input('nickname'),
                'password'=>input('password'),
                'checkstate'=>input('checkstate'),
                'levelname'=>input('levelname'),
            ];
            }    
            // dump($data);dump($id);
            // $data = \think\Db::name('user')->where('id',$id)->update($data);
            $data=db('user')->where('uid',$uid)->update($data);
            // dump($data);die;
            if($data){
                $this->success('修改成功',url('Admin/index'));
            }else{
                $this->error('修改失败');
            }
            
            }else{
                $this->error('参数错误');
            }
    }



    // 单个删除
    public function delete(){
        if(request()->isGet()){

        $delete=db('user')->delete(input('uid'));
        if($delete){
            $this->success('删除成功！',url('index'));
        }else{
            $this->error('删除失败！');
        }

        }else{
            $this->error('参数错误！');
        }
        
    }
    // 多个删除
    public function del(){
        if(request()->isPost()){
        $id=input('post.uid/a');
//            dump($id);die;
        $id_v=implode(',',$id);
        // dump($id_v);  die;
        $delete=db('user')->delete($id_v);
        if($delete){
            $this->success('删除成功！',url('index'));
        }else{
            $this->error('删除失败！');
        }

        }else{
            $this->error('参数错误！');
        }
        
    }
    
}
