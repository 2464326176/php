<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/23
 * Time: 11:07
 */
namespace app\index\controller;
use think\Controller;
use org\util\AjaxUpload;
class Index extends Controller
{
    /*
   * 微信配置文件加载
   */
    private $APPID;//填写你微信公众号的appid
    private $APPSECRET;//填写你微信公众号的appsecret
    protected function _initialize() {
        $data=\think\Db::name('wx')->where('id',1)->select();
        $this->APPID=$data[0]['appid'];
        $this->APPSECRET=$data[0]['appsecret'];
    }

    /******************************************************************************************************/

    /*
     * 信息提取页面
     */
    public function index($user_id="123456"){
        $this->assign("user_id",$user_id);

        return view();
    }


    public function testpaper($user_id="123456"){

        $this->assign("user_id",$user_id);
        return view();
    }

    public function home(){

        return view();
    }


    //测试页面
    public function ceshi(){
        if (\think\Request::instance()->isPost()){
                $form_name = $_GET['form_name'];
                $file_size = intval($_GET['file_size']);
                $upload = new AjaxUpload($form_name, $file_size);
                dump($upload);
        }else{
            return view();
        }
    }



    /*
     * 提交表单
     */
    public function ajax_form(){
        $data=\think\Request::instance()->param();
        $file = request()->file('images');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }else {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/questions/');
            if ($info) {
                $picurl = '/lyzg/public/uploads/questions/';
                $data = [
                    'picurl' => $picurl . date('Ymd') . '/' . $info->getFilename(),
                    'user_id' => $data['user_id'],
                    'name' => $data['name'],
                    'phonenum' => $data['phonenum'],
                    'source' => $data['source'],
                    'schoolname' => $data['schoolname'],
                    'classname' => $data['classname'],
                    'time' => time(),
                    'subject' => $data['subject'],
                    'region' => $data['region'],
                ];
            }
        }
        $datas=db('content')->insert($data);
        if($datas){
            $this->success('提交成功');
        }else{
            $this->error('提交失败');
        }
    }

    /*
     * 跳转网页第三方授权
     */
    //第一步：用户同意授权，获取code
    public function accept(){
        $REDIRECT_URI = "http://liuyuhang.xin/lyzg/public/index.php/index/index/getCode";
        $REDIRECT_URI = urlencode($REDIRECT_URI);
        $scope = "snsapi_userinfo";
        $state = time();
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->APPID."&redirect_uri=".$REDIRECT_URI."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";
        dump($url);die;
        header("location:$url");
    }
    //第二步  用户同意之后就获取code
    public function getCode(){
        $code = $_GET["code"];
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->APPID."&secret=".$this->APPSECRET."&code=".$code."&grant_type=authorization_code";
        $res=https_request($url);
        $res=json_decode($res,true);
        $openid=$res["openid"];
        $access_token = $res["access_token"];
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $res = https_request($url);
        $res = json_decode($res,true);
        $openid= $res["openid"];
        $nickname = $res["nickname"];
        $sex = $res["sex"];
        $address = $res["country"].$res["province"].$res["city"];
        $data = [
            'openid' => $openid,
            'nickname' => $nickname,
            'sex' => $sex,
            'address' => $address,
        ];
        $user_id=db('consult')->where('openid',$openid)->value("id");
        if(!$user_id){
            $user_id=db('consult')->insertGetId($data);
        }
        $this->redirect('index/index', array('user_id'=>$openid));
    }


}