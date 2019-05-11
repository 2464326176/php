<?php
namespace app\wxapi\controller;
use think\Controller;
use app\wxapi\model\Plans;
class Getinfo extends Controller
{

    /*
     * 全体查询统计数
     */
    public function getAll(){
        $data=\think\Request::instance()->param();
        $num=$data['taskID'];
        $query_section=[$data['startDate'],$data['endDate']];
        $daily_data=Plans::getAllTotalNum($data['type'],$num,$query_section);
        return json(['data'=>$daily_data]);
    }
    /*
     * 个人查询统计数
     */
    public function getSing(){
        $data=\think\Request::instance()->param();
        $openid=$data['openId'];
        $num=$data['taskID'];
        $query_section=[$data['startDate'],$data['endDate']];
        $sign_data=Plans::getSingleNum($data['type'],$openid,$num,$query_section,$data['detail']);
        return json(['data'=>$sign_data]);
    }


}