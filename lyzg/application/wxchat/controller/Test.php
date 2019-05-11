<?php
/**
 *Author Timson^(*(oo)*)^
 *Time 2016/1/29
 */
define('APPID','INPUT YOUR APPID');
define('SECRET','INPUT YOUR SECRET');
class GetWCApi {
    private $grant_type = array('accesstoken'=>'client_credential');
    private $curl_url = array('accesstoken'=>'https://api.weixin.qq.com/cgi-bin/token?','sendMenu'=>'https://api.weixin.qq.com/cgi-bin/menu/create?','upload'=>'http://file.api.weixin.qq.com/cgi-bin/media/upload?','getmedia'=>'https://api.weixin.qq.com/cgi-bin/media/get?');
    private $uploadtype = array(1=>'image',2=>'voice',3=>'video',4=>'thumb');
    private $appid;
    private $secret;
    private $accesstoken;
    function __construct($appid,$secret,$accesstoken = NULL) {
        $this ->appid = $appid;
        $this ->secret = $secret;
        $this ->accesstoken = $accesstoken;
    }

    public function GetMaterial($type,$mediaid) {
        if(!$this ->accesstoken) {
            $resultjson = $this ->GetAccessToken();
            $resultarr = json_decode($resultjson,true);
            $this ->accesstoken = $resultarr['access_token'];
            $accesstoken = $this ->accesstoken;
        }
        $url = $this->curl_url['getmedia'];
        $param = array();
        $param['access_token'] = $this ->accesstoken;
        $param['media_id'] = $mediaid;
        $url = $this->GetUrl($url,$param);
        $resultcontent = $this ->_requestUrl($url);
        $imagepath = dirname(__File__).'/../images/wechat/'.$type.'/'.time().rand(0,999).'.'.$type;
        $result = $this ->saveWeChatFile($imagepath,$resultcontent);
        if($result) {
            return $imagepath;
        }
        else {
            return false;
        }
    }
    public function UploadMaterial($type,$filepath) {
        if(!$this ->accesstoken) {
            $resultjson = $this ->GetAccessToken();
            $resultarr = json_decode($resultjson,true);
            $this ->accesstoken = $resultarr['access_token'];
        }
        $url = $this->curl_url['upload'];
        $param = array();
        $param['access_token'] = $this ->accesstoken;
        $param['type'] = $this ->uploadtype[$type];
        $url = $this->GetUrl($url,$param);
        $postfile = array('media'=>'@'.$filepath);
        $result = $this ->_requestUrl($url,$postfile,true);
        return $result;
    }
    private function GetAccessToken() {
        $url = $this->curl_url['accesstoken'];
        $param = array();
        $param['grant_type'] = $this ->grant_type['accesstoken'];
        $param['appid'] = $this ->appid;
        $param['secret'] = $this ->secret;
        $url = $this->GetUrl($url,$param);
        $accesstoken = $this ->_requestUrl($url);
        return $accesstoken;
    }
    private function _requestUrl($url,$param = null,$ispost = false) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if($ispost) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;


    }
    private function GetUrl($url,$param) {
        $params = http_build_query($param);
        $url = $url.$params;
        return $url;
    }
    private function saveWeChatFile($filename,$filecontent) {
        $local_file = fopen($filename,'w');
        if($local_file !== false) {
            if(fwrite($local_file,$filecontent) !== false) {
                fclose($local_file);
                return true;
            }
            else {
                return false;
            }

        }
        else {
            return false;
        }
    }
}
$GetWCApi = new GetWCApi(APPID,SECRET);



//2声明上传(临时素材)
/*$upfile = dirname(__File__)."/../images/trainstop .png";
$getresult = $GetWCApi ->UploadMaterial(1,$upfile);
    */

//3获取临时元素
/*$getresult = $GetWCApi ->GetMaterial('jpg','3Xqin7qm8wXktNQs9GkOJjqRVM3WkBi8qtKhOMduljwunq0KlaWRRbAGfuiBOkbG');*/






?>