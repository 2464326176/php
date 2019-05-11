<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24 0024
 * Time: 16:12
 */

namespace app\wxapi\model;

use think\Model;

class Plans extends Model

{

    /**
     * 查询打卡计划
     * 返回查询信息
     * @param 通过openid查询个人所有的打卡计划
     */
    public static function getByOpenID($openid)
    {
        $user=db('plan')->alias('a')->join('lyzg_planlist c','a.num=c.num')->join('lyzg_spuser b','b.openid=c.openid')->where('b.openid',$openid)->select();
        return $user;
    }

    /**
     * 查询打卡计划
     * 返回查询信息
     * @param 通过num查询所有参与的人员
     */
    public static function getByNum($num)
    {
        $user=db('plan')->alias('a')->join('lyzg_planlist c','a.num=c.num')->join('lyzg_spuser b','b.openid=c.openid')->where('c.num',$num)->select();
        return $user;
    }
    /**
     * 更新打卡计划的信息
     */
    public static function getByOpenNum($num)
    {
        $findNumdata=db('plan')->where('num',$num)->find();
        $totalNum=$findNumdata['totalNum'];
        $totalNum+=1;
        db('plan')->where('num',$num)->update(['totalNum'=>$totalNum]);
    }

    public static function getSignList($openid){
        $planList=self::getByOpenID($openid);
        foreach ($planList as $key=>$value){
            $query_data=[
                'num'=>$value['num'],
                'openid'=>$value['openid'],
            ];
            $query=db('planum')->where($query_data)->whereTime('time', 'today')->find();
            if($query){
                $planList[$key]=array_merge($planList[$key],$query);
            }else{
                $signState=[
                    'signstate'=>'0'
                ];
                $planList[$key]=array_merge($planList[$key],$signState);
            }
        }

        return $planList;

    }
    /*
     * 全体查询统计
     */
    public static function getAllTotalNum($type,$num,$query_section){
        if($type=='daily'){
                $return_info=[
                    'ontime'=>self::queryPlanum($num,'1',$query_section),
                    'late'=>self::queryPlanum($num,'3',$query_section),
                    'leave'=>self::queryPlanum($num,'2',$query_section),
                    'absent'=>self::queryPlanum($num,'4',$query_section),
                ];
                return $return_info;
        }else{
            $user_listInfo=db('spuser')->alias('a')->join('planlist b','a.openid=b.openid')->where('b.num',$num)->select();
            foreach($user_listInfo as $user_key=>$user_value){
                $queryNum=[
                    'ontime'=>self::queryOpenPlanum($num,$user_value['openid'],'1',$query_section),
                    'late'=>self::queryOpenPlanum($num,$user_value['openid'],'3',$query_section),
                    'leave'=>self::queryOpenPlanum($num,$user_value['openid'],'2',$query_section),
                    'absent'=>self::queryOpenPlanum($num,$user_value['openid'],'4',$query_section),
                ];
                $user_listInfo[$user_key]=array_merge($user_listInfo[$user_key],$queryNum);
            }
            return $user_listInfo;
        }

    }

    /*
     * 个人查询统计
     */

    public static function getSingleNum($type,$openid,$num,$query_section,$detail){
        if($type=="individual"){
            $queryNum=[
                'ontime'=>self::queryOpenPlanum($num,$openid,'1',$query_section),
                'late'=>self::queryOpenPlanum($num,$openid,'3',$query_section),
                'leave'=>self::queryOpenPlanum($num,$openid,'2',$query_section),
                'absent'=>self::queryOpenPlanum($num,$openid,'4',$query_section),
            ];
            return $queryNum;
        }else{
            switch ($detail){
                case 'late':
                    $data_userValue=self::queryDetail($num,$openid,'3',$query_section);
            break;
                case 'leave':
                    $data_userValue=self::queryDetail($num,$openid,'2',$query_section);

            break;
                case 'absent':
                    $data_userValue=self::queryDetail($num,$openid,'4',$query_section);
            break;
                case 'ontime':
                $data_userValue=self::queryDetail($num,$openid,'1',$query_section);

            break;
            }
            return $data_userValue;
        }



    }

    /*
     * 返回查询统计数量
     */
    public static function queryPlanum($num,$signstate,$query_section){
        $totalNum=db('planum')->where([
            'num'=>$num,
            'signstate'=>$signstate,
        ])->whereTime('time', 'between',$query_section)->count();
        return $totalNum;
    }

    public static function queryOpenPlanum($num,$openid,$signstate,$query_section){
        $totalNum=db('planum')->where([
            'num'=>$num,
            'openid'=>$openid,
            'signstate'=>$signstate,
        ])->whereTime('time', 'between',$query_section)->count();
        return $totalNum;
    }

    public static function queryInfo($num,$openid,$signstate,$query_section){
        $info_data=db('planum')->where([
            'num'=>$num,
            'openid'=>$openid,
            'signstate'=>$signstate,
        ])->whereTime('time', 'between',$query_section)->select();
        return $info_data;
    }

    public static  function queryDetail($num,$openid,$signstate,$query_section){
        $data_userValue=self::queryInfo($num,$openid,$signstate,$query_section);
        foreach ($data_userValue as $data_key=>$data_value){
            $start_userTime=date('Ymd',$data_value['time']);
            $end_userTime=$start_userTime+1;
            //当前出勤率
            $sign_num=db('planum')->where([
                'num'=>$num,
                'signstate'=>'1',
            ])->whereTime('time','between',[$start_userTime,$end_userTime])->count();
            $total_num=db('planlist')->where([
                'num'=>$num,
            ])->count();
            $ratio=round((($sign_num/$total_num)*100),2).'%';

            //打卡排名
            $user_data=db('planum')->where([
                'num'=>$num,
            ])->whereTime('time','between',[$start_userTime,$end_userTime])->order('time')->select();
            if($signstate=='1'){
                foreach ($user_data as $user_datakey=>$user_datavalue){
                    if($user_datavalue['openid']==$openid){
                        $position=$user_datakey;
                    }
                }
                $userInfo_data=[
                    'position'=>$position,
                    'date'=>$start_userTime,
                    'ratio'=>$ratio,
                ];
            }else if($signstate=='2'){
                $userInfo_data=[
                    'date'=>$start_userTime,
                    'ratio'=>$ratio,
                ];
            }else if($signstate=='3'){
                $plan=db('plan')->where([
                    'num'=>$num,
                ])->find();
                $plan_time=date('Y-m-d',time()).''.$plan['signTime'];
                $Infoduration=timediff(strtotime($plan_time),$data_value['time']);
                $duration=$Infoduration['hour'].'h'.$Infoduration['min'].'m'.$Infoduration['sec'].'s';
//                $signTime=date('H:i:s',$data_value['time']);
                $userInfo_data=[
                    'duration'=>$duration,
                    'signTime'=>$plan['signTime'],
                    'date'=>$start_userTime,
                    'ratio'=>$ratio,
                ];
            }else if($signstate=='4'){
                $userInfo_data=[
                    'date'=>$start_userTime,
                    'ratio'=>$ratio,
                ];
            }

            $data_userValue[$data_key]=array_merge($data_userValue[$data_key],$userInfo_data);
        }

        return $data_userValue;
    }










}