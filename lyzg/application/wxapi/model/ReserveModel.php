<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/24 0024
 * Time: 16:12
 */

namespace app\wxapi\model;

use think\Model;

class ReserveModel extends Model

{
    /*
*按今天，本周，本月，本季度，本年，全部查询预约单数据
* $day 代表查询条件 $cid 代表 公司id
*返回array $data 查询条件 数组
*/


    public static function find_createtime($day,$cid){
        //查询当天数据
        if($day==1){
            $today=strtotime(date('Ymd 00:00:00'));
            $newday=strtotime(date('Ymd')+1);
            $data['time'] = array('between',array($today,$newday));
            return $data;
        //查询本周数据
        }else if($day==2){
            $arr=array();
            $arr=getdate();
            $num=$arr['wday'];
            $start=time()-($num-1)*24*60*60;
            $end=time()+(7-$num)*24*60*60;
            $data['cid']=$cid;
            $data['createtime'] = array('between',array($start,$end));
            return $data;
        //查询本月数据
        }else if($day==3){
            $start=strtotime(date('Y-m-01 00:00:00'));
            $end = strtotime(date('Y-m-d H:i:s'));
            $data['cid']=$cid;
            $data['createtime'] = array('between',array($start,$end));
            return $data;
        //查询本季度数据
        }else if($day==4){
            $month=date('m');
            if($month==1 || $month==2 ||$month==3){
                $start=strtotime(date('Y-01-01 00:00:00'));
                $end=strtotime(date("Y-03-31 23:59:59"));
            }elseif($month==4 || $month==5 ||$month==6){
                $start=strtotime(date('Y-04-01 00:00:00'));
                $end=strtotime(date("Y-06-30 23:59:59"));
            }elseif($month==7 || $month==8 ||$month==9){
                $start=strtotime(date('Y-07-01 00:00:00'));
                $end=strtotime(date("Y-09-30 23:59:59"));
            }else{
                $start=strtotime(date('Y-10-01 00:00:00'));
                $end=strtotime(date("Y-12-31 23:59:59"));
            }
            $data['cid']=$cid;
            $data['createtime'] = array('between',array($start,$end));
            return $data;
        //查询本年度数据
        }else if($day==5){
            $year=strtotime(date('Y-01-01 00:00:00'));
            $data['cid']=$cid;
            $data['createtime'] = array('egt',$year);
            return $data;
        //全部数据
        }else{
            $data['cid']=$cid;
            return $data;
        }
    }






















}