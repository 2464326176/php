<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/2 0002
 * Time: 14:28
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Vxreply;
define("TOKEN", "lyh_88475");//你微信定义的token
define("APPID", "wx00832bfe6b635d1d");//你微信定义的appid
define("APPSECRET","992b9f5d993cdab31562034bde5f44b9");//你微信公众号的appsecret
class Reply extends Controller
{


    //上传图片
    public function ajax_upload(){
        $user_id=\think\Request::instance()->param('user_id');
        $file = request()->file('file');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }else{
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/answer');
            if ($info) {

                $answer='/lyzg/public/uploads/answer/';
                $data=[
                    'answer'=>$answer.date('Ymd').'/'.$info->getFilename(),
                ];


                $datas=db('content')->where('user_id',$user_id)->update($data);

                if($datas){
                    $this->reply($user_id,$data['answer']);
                    return json(array('code'=>0,'path'=>$data['answer']));
                }else{
                    return json(array('code'=>1));
                }
            }
        }
    }

    public function reply($oUserName="or2V50sOzJs-gDwvHZfu7MP2DYSk",$picurl="https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=138126325,1485620701&fm=85&s=7FAB2EC3909A35D01E299C1A030010D2"){

        
        $newsTplHead = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>";

        $newsTplBody = "<item>
                <PicUrl><![CDATA[%s]]></PicUrl>
                </item>";
        $newsTplFoot = "</Articles>
                <FuncFlag>0</FuncFlag>
                </xml>";
        $header = sprintf($newsTplHead, APPID,$oUserName, time());
        $picUrl = $picurl;
        $body = sprintf($newsTplBody, $picUrl);
        $FuncFlag = 0;
        $footer = sprintf($newsTplFoot, $FuncFlag);
        return $header.$body.$footer;


    }





}