<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/22
 * Time: 16:08
 */
//验证token
 function valid()
{
    define("TOKEN","lyh_88475");
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    if( $tmpStr == $signature ){
        echo $_GET["echostr"];
    }else{
        echo "error";
    }
}

//POST请求
 function _requestPOST($url,$data,$ssl=true){
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
function _requestGet($url,$ssl=true){
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
//微信curl方法
function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

/*回复text
 * ToUserName	开发者微信号
 * FromUserName	发送方帐号（一个OpenID）
 * CreateTime	消息创建时间 （整型）
 * MsgType	text
 * Content	文本消息内容
 * MsgId	消息id，64位整型
 */
function _response_text($postObj){

    $toUsername = $postObj->ToUserName;
    $fromUsername = $postObj->FromUserName;
    $keyword = trim($postObj->Content);
    $time = time();
    $msgType = $postObj->MsgType;
    $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>%d</FuncFlag>
                </xml>";

    $contentStr = '<a href="http://www.baidu.com">hello welcome to</a>';
    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
    echo $resultStr;
}