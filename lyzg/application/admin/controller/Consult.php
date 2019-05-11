<?php
namespace app\admin\controller;
use think\Controller;
Class Consult extends Common
{
    //获得access_token 存储起来
    public function get_access_token(){
        $condition = array('appid' => $this->APPID, 'appsecret' => $this->APPSECRET);
        $data=db('wx')->where($condition)->find();
        if ($data) {
            if ($data['createtime'] > time()) {
                return $data['access_token'];
            } else {
                //已超时，重新获取
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->APPID . '&secret=' . $this->APPSECRET;
                $json = json_decode(https_request($url, null)); //获取参数；
                $url_access_token = $json->access_token;
                $createtime = time() + intval($json->expires_in);
                $get_data=[
                    'access_token'=> $url_access_token,
                    'createtime'=>$createtime,
                ];
                $result =db('wx')->where($condition)->update($get_data);
                return $url_access_token;
            }
        }
    }


    public function phone(){

        $data=db('consult')->alias('a')
            ->join('lyzg_content b','a.openid = b.user_id')->where('b.content_id','>',1)->order("id","asc")->paginate(7);
        $page = $data->render();

        $this->assign('data', $data);
        $this->assign("page",$page);
        return $this->fetch();

    }


    public function index(){
        $data=db('consult')->alias('a')
            ->join('lyzg_content b','a.openid = b.user_id')->select();
        $this->assign("data",$data);
        return view();
    }

    public function ajax_form(){

        $content_id=\think\Request::instance()->param('content_id');
        $file = request()->file('file');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }else {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/answer/');
            if ($info) {
                $answer = '/lyzg/public/uploads/answer/';
                $data = [
                    'answer' => $answer . date('Ymd') . '/' . $info->getFilename(),
                    'state' => '已处理',
                ];
            }
        }
        $datas=db('content')->where('content_id',$content_id)->update($data);
        $wx_url='../public/uploads/answer/'. date('Ymd') . '/' . $info->getFilename();
        $data_obj=db('content')->where('content_id',$content_id)->find();
        $result=$this->uploadImg($wx_url,$data_obj['user_id']);
        if($result->errmsg=="ok"){
            $this->success('发送成功');
        }else{
            $this->success('发送失败');
        }
    }


    public function ajax_pic(){

        $content_id=\think\Request::instance()->param('content_id');
        $file = request()->file('file');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }else {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/answer/');
            if ($info) {
                $answer = '/lyzg/public/uploads/answer/';
                $data = [
                    'answer' => $answer . date('Ymd') . '/' . $info->getFilename(),
                    'state' => '已处理',
                ];
            }
        }
        $datas=db('content')->where('content_id',$content_id)->update($data);

        $data_obj=db('content')->where('content_id',$content_id)->find();
        $wx_url='../public/uploads/answer/'. date('Ymd') . '/' . $info->getFilename();
        $result=$this->uploadImg($wx_url,$data_obj['user_id']);
        if($result->errmsg=="ok"){
            return ['data'=>'发送成功'];
        }else{
            return ['data'=>'发送失败'];
        }
    }






    public function uploadImg($imgurl,$touser){
        $TOKEN=$this->get_access_token();
        $URL ='http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$TOKEN.'&type=image';
        if (class_exists('\CURLFile')) {
            $data = array('fieldname' => new \CURLFile(realpath($imgurl)));
        } else {
            $data = array('fieldname' => '@' . realpath($imgurl));
        }
        $result=_requestPOST($URL,$data);
        $result_obj=json_decode($result);
        $id=$result_obj->media_id;
        $data_content=[
            "touser"=>$touser,
            "msgtype"=>"image",
            "image"=>["media_id"=>$id],
        ];
        $data_content=json_encode($data_content);
        $img_url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->get_access_token();
        $final = json_decode(https_request($img_url,$data_content));
        return $final;
}


}

