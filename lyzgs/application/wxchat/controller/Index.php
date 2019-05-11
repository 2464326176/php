<?php
namespace app\wxchat\controller;
use think\Controller;
use app\admin\model\Wxconfig;
class Index extends Controller
{
    /*
    * 微信配置文件加载
    */
    private $APPID;//填写你微信公众号的appid
    private $APPSECRET;//填写你微信公众号的appsecret
    private $TOKEN;//定义你公众号自己设置的token
    private $access_token;//填写你微信公众号的appsecret
    protected function _initialize() {
        $data=\think\Db::name('wx')->where('id',1)->select();
        $this->APPID=$data[0]['appid'];
        $this->APPSECRET=$data[0]['appsecret'];
        $this->TOKEN=$data[0]['token'];
        $this->access_token=$data[0]['access_token'];
    }

    //测试专用
    public function ceshi(){
//        $access_token=$this->get_access_token();
//        dump($access_token);
        return view();
    }
//入口
    public function index(){
        $nonce     = $_GET['nonce'];
        $token     = $this->TOKEN;
        $timestamp = $_GET['timestamp'];
        $echostr   = $_GET['echostr'];
        $signature = $_GET['signature'];
        $array = array();
        $array = array($nonce, $timestamp, $token);
        sort($array);
        $str = sha1( implode( $array ) );
        if( $str  == $signature && $echostr ){
            echo  $echostr;
            exit;
        }else{
            $this->definedItem();
        }
    }
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


    //上传素材
    public function uploadImg(){
        $TOKEN=$this->get_access_token();
        $URL ='http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$TOKEN.'&type=image';



        if (class_exists('\CURLFile')) {
            $data = array('fieldname' => new \CURLFile(realpath('../public/12.jpg')));
        } else {
            $data = array('fieldname' => '@' . realpath('../public/12.jpg'));
        }

        $result=$this->_requestPOST($URL,$data);
        $result_obj=json_decode($result);
//        dump($result_obj);
        $this->reply_customer($result_obj->media_id);


    }

    //    回复客服消息

    public function reply_customer($id){
//        $data = '{
//        "touser":"or2V50sOzJs-gDwvHZfu7MP2DYSk",
//        "msgtype":"text",
//        "text":
//        {
//             "content":"研发成功"
//        }
//        }';
//        }';

        $data=[
            "touser"=>"or2V50sOzJs-gDwvHZfu7MP2DYSk",
            "msgtype"=>"image",
            "image"=>["media_id"=>"cTAV2YNpvIyGSQvhAkGrkK2YFINHvgkCAIU3LKlF37gCFInRJQ3rqmPODtHRBpgS"],
    ];
        $data=json_encode($data);

        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->get_access_token();
        $result = https_request($url,$data);
        $final = json_decode($result);
        var_dump($final);

    }

    public function get_sucai($id){
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->get_access_token().'&media_id='.$id;
        dump($url);
        $data=https_request($url);
        header("Content-type:text/html;charset=utf-8");
//        $data=iconv('gb2312', 'UTF-8//IGNORE', $data);
        dump($data);
    }

    public function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }




    //POST请求
    public function _requestPOST($url,$data,$ssl=true){
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        $user_agant=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']:'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36';
        curl_setopt($curl, CURLOPT_USERAGENT,$user_agant);
        curl_setopt($curl, CURLOPT_AUTOREFERER,true);
        if($ssl){

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }
        //处理post
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //var_dump($data);
        $response = curl_exec($curl);
        //var_dump($response);
        if(false===$response){
            echo curl_error($curl),'<br/>';
            return false;
        }
        //var_dump($response);die;
        return $response;
    }

    //GET请求
    private function _requestGet($url,$ssl=true){
        $curl=curl_init();

        curl_setopt($curl, CURLOPT_URL,$url);
        $user_agant=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']:'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36';
        curl_setopt($curl, CURLOPT_USERAGENT,$user_agant);
        curl_setopt($curl, CURLOPT_AUTOREFERER,true);
        if($ssl){

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        }
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        if(false===$response){
            echo curl_error($curl),'<br/>';
            return false;
        }
        //var_dump($response);die;
        return $response;
    }










    public function getSource($id="cTAV2YNpvIyGSQvhAkGrkK2YFINHvgkCAIU3LKlF37gCFInRJQ3rqmPODtHRBpgS")
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->get_access_token().'&media_id='.$id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        //返回的内容作为变量储存，而不是直接输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //   curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
        // curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        //发出请求
        $response = curl_exec($ch);
        $response= json_decode($response);
        // $rs = mb_detect_encoding($response);
        dump($response);
    }








    public function get_imgid(){

        $data='{
        "type":"image",
        "offset":0,
        "count":10,
        }';
        $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$this->get_access_token();

        $result = https_request($url,$data);
        var_dump($result);
        $final = json_decode($result);
        var_dump($final);
    }

    public function get_mediaList($type="image",$offset=0,$count=20){
        if (!$this->get_access_token()) return false;
        $data = array(
            'type'=>$type,
            'offset'=>$offset,
            'count'=>$count
        );
        $curl = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->get_access_token();
        $result = $this->_request($curl,true,'POST',json_encode($data));
        if ($result){
            $json = json_decode($result,true);

            return $json;
        }
        return false;
    }


    public function menu($num="1"){
        header('content-type:text/html;charset=utf-8');
        $url_add ='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->get_access_token();
        $url_del ='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->get_access_token();

        $postArr=array(
            'button'=>array(
                array(
                    'name'=>urlencode('网站首页'),
                    'type'=>'click',
                    'key'=>'item1',
                ),
                array(
                    'name'=>urlencode('关于我们'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('歌曲'),
                            'type'=>'click',
                            'key'=>'songs'
                        ),//第一个二级菜单
                        array(
                            'name'=>urlencode('电影'),
                            'type'=>'view',
                            'url'=>'http://www.baidu.com'
                        ),//第二个二级菜单
                    )
                ),
                array(
                    'name'=>urlencode('在线咨询'),
                    'type'=>'view',
                    'url'=>'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx00832bfe6b635d1d&redirect_uri=http%3A%2F%2Fliuyuhang.xin%2Flyzg%2Fpublic%2Findex.php%2Findex%2Findex%2FgetCode&response_type=code&scope=snsapi_userinfo&state=1515556935#wechat_redirect',
                ),//第三个一级菜单

            ));
        if($num=="1"){
            $postJson = urldecode(json_encode($postArr));
            $res = https_request($url_add, $postJson);
            var_dump($res."添加");
        }else{
            $postJson = urldecode(json_encode($postArr));
            $res = https_request($url_del, $postJson);
            var_dump($res."删除");
        }




}






//    自定义菜单
    public function  definedItem(){
        header('content-type:text/html;charset=utf-8');
        $url ='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->get_access_token();
        $postArr=array(
            'button'=>array(
                array(
                    'name'=>urlencode('菜单一'),
                    'type'=>'click',
                    'key'=>'item1',
                ),
                array(
                    'name'=>urlencode('菜单二'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('歌曲'),
                            'type'=>'click',
                            'key'=>'songs'
                        ),//第一个二级菜单
                        array(
                            'name'=>urlencode('电影'),
                            'type'=>'view',
                            'url'=>'http://www.baidu.com'
                        ),//第二个二级菜单
                    )
                ),
                array(
                    'name'=>urlencode('在线咨询'),
                    'type'=>'view',
                    'url'=>'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx00832bfe6b635d1d&redirect_uri=http%3A%2F%2Fliuyuhang.xin%2Flyzg%2Fpublic%2Findex.php%2Findex%2Findex%2FgetCode&response_type=code&scope=snsapi_userinfo&state=1515556935#wechat_redirect',
                ),//第三个一级菜单

            ));
        $postJson = urldecode(json_encode($postArr));
        $res = https_request($url, $postJson);
        var_dump($res."菜单创建成功");
    }
//删除菜单
    public function  deleteItem(){
        header('content-type:text/html;charset=utf-8');

        $url ='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->get_access_token();
        $postArr=array(
            'button'=>array(
                array(
                    'name'=>urlencode('菜单一'),
                    'type'=>'click',
                    'key'=>'item1',
                ),
                array(
                    'name'=>urlencode('菜单二'),
                    'sub_button'=>array(
                        array(
                            'name'=>urlencode('歌曲'),
                            'type'=>'click',
                            'key'=>'songs'
                        ),//第一个二级菜单
                        array(
                            'name'=>urlencode('电影'),
                            'type'=>'view',
                            'url'=>'http://www.baidu.com'
                        ),//第二个二级菜单
                    )
                ),
                array(
                    'name'=>urlencode('在线咨询'),
                    'type'=>'view',
                    'url'=>'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx00832bfe6b635d1d&redirect_uri=http%3A%2F%2Fliuyuhang.xin%2Flyzg%2Fpublic%2Findex.php%2Findex%2Flogin%2FgetCode&response_type=code&scope=snsapi_userinfo&state=1513999434#wechat_redirect',
                ),

            ));
        $postJson = urldecode(json_encode($postArr));
        $res = https_request($url, $postJson);
        var_dump($res);
    }




    //消息处理函数
    public function reponseMsg(){
        //1.获取到微信推送过来post数据（xml格式）
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //2.处理消息类型，并设置回复类型和内容
        /*<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[FromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>*/
        $postObj = simplexml_load_string( $postArr );
        //$postObj->ToUserName = '';
        //$postObj->FromUserName = '';
        //$postObj->CreateTime = '';
        //$postObj->MsgType = '';
        //$postObj->Event = '';
        // gh_e79a177814ed
        //判断该数据包是否是订阅的事件推送
        if( strtolower( $postObj->MsgType) == 'event'){
            //如果是关注 subscribe 事件
            if( strtolower($postObj->Event == 'subscribe') ){
                //回复用户消息(纯文本格式)
                $toUser   = $postObj->FromUserName;
                $fromUser = $postObj->ToUserName;
                $time     = time();
                $msgType  =  'text';
                $content  = '欢迎关注我们的微信公众账号'.$postObj->FromUserName.'-'.$postObj->ToUserName;
                $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";
                $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                echo $info;
                /*<xml>
                <ToUserName><![CDATA[toUser]]></ToUserName>
                <FromUserName><![CDATA[fromUser]]></FromUserName>
                <CreateTime>12345678</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[你好]]></Content>
                </xml>*/


            }
        }
        //根据用户输入消息进行回复
        else if(strtolower( $postObj->MsgType) == 'text'){
            $toUser   = $postObj->FromUserName;
            $fromUser = $postObj->ToUserName;
            $time     = time();
            $msgType  =  'text';
            //$content  = 'imooc is very good'.$postObj->FromUserName.'-'.$postObj->ToUserName;
            $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";
            switch( trim($postObj->Content)){
                case 1:
                    $content = '您输入的数字是1';
                    break;
                case 2:
                    $content = '您输入的数字是2';
                    break;
                case 3:
                    $content = '<a href="http://www.baidu.com">百度</a>';
                    break;
                case tuwen:
                    $arr=array(
                        array('title'=>'imooc',
                            'description'=>'imooc描述',
                            'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
                            'url'=>'http://www.baidu.com'),
                        array('title'=>'hao123',
                            'description'=>'hao123描述',
                            'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
                            'url'=>'http://www.hao123.com'),
                        array('title'=>'baidu',
                            'description'=>'baidu描述',
                            'picUrl'=>'http://www.imooc.com/static/img/common/logo.png',
                            'url'=>'http://www.baidu.com'),
                    );
                    $content = '<a href="http://www.baidu.com">百度</a>';
                    $template_tuWen = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <ArticleCount>".count($arr)."</ArticleCount>
                                <Articles>";
                    foreach($arr as $k=>$v){
                        $template_tuWen .= "<item>
                                <Title><![CDATA[".$v['title']."]]></Title>
                                <Description><![CDATA[".$v['description']."]]></Description>
                                <PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
                                <Url><![CDATA[".$v['url']."]]></Url>
                                </item>";
                    }

                    $template_tuWen .="</Articles>
                                </xml>";
                    $info     = sprintf($template_tuWen, $toUser,$fromUser,$time,'news');
                    echo $info;
                    break;
            }

            $info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
            echo $info;
        }

    }



    //获取微信服务器IP地址
    function  getWxServerIp(){
        $accessToken ="Y7cYto0UvJz1U-9NpN04lhQuBkO5BO7Sim6hCZ0GkZlLLfisnvXLjg6VTX_v7veESGX24zAIlu31GD5YXjQFWd5AYXkQTv5a1iGIwk9oxL4gPeWC3fCciWTp2e5ftVZvUXFcAHAHKS";
        $url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$accessToken;
        $ch  =curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $res =curl_exec($ch);
        //5.关闭curl
        curl_close($ch);
        if(curl_error($ch)){
            var_dump(curl_error($ch));
        }
        $arr=json_decode($res,true);
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
    }








}
