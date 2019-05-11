<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq:2464326176
 * Date: 2018/2/5 0005
 * Time: 15:29
 */
namespace app\wxapi\controller;
use think\Controller;
use app\wxapi\model\User;
class Login extends Controller
{
    protected $code;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('app_id');
        $this->wxAppSecret = config('app_secret');
        $this->wxLoginUrl = sprintf(
            config('login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    /*
     * code 获取 session_key 和 openid
     * session_key 是对用户数据进行加密签名的密钥
     */
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);

        if (empty($wxResult)) {
            var_dump('获取session_key及openID时异常，微信内部错误');
        }
        else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {

            }
            else {
                return $wxResult['openid'];
            }
        }
    }


    // 颁发令牌
    public function grantToken($wxResult)
    {

        //        $token = Request::instance()->token('token', 'md5');
        $openid = $wxResult['openid'];
        $user = User::getByOpenID($openid);
        if (!$user)
        {
            $uid = $this->newUser($openid);
        }
        else {
            $uid = $user['id'];
        }
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }





}