<?php
/**
 * Created by PhpStorm.
 * User: 刘宇航
 * Qq:2464326176
 * Date: 2018/2/8 0008
 * Time: 14:45
 */
namespace app\wxapi\controller;
use think\Controller;
use app\wxapi\model\Plans;
use app\wxapi\model\ReserveModel;
use org\util\Binary;
class Plan extends Controller
{
    /*
     * 新建打卡计划
     * @param 存储打卡计划的信息
     * @return  返回打卡计划的唯一口令
     */
    public function getplan(){
        $data=\think\Request::instance()->param();
        $num=Inequable();
        $add_data=[
            'name'=>$data['name'],
            'address'=>$data['address'],
            'endDay'=>$data['endDay'],
            'startDay'=>$data['startDay'],
            'signTime'=>$data['signTime'],
            'latitude'=>$data['latitude'],
            'longitude'=>$data['longitude'],
            'monday'=>$data['monday'],
            'tuesday'=>$data['tuesday'],
            'wednesday'=>$data['wednesday'],
            'thursday'=>$data['thursday'],
            'friday'=>$data['friday'],
            'saturday'=>$data['saturday'],
            'sunday'=>$data['sunday'],
            'content'=>$data['content'],
            'openidadmin'=>$data['openId'],
            'num'=>$num,
            'signEarlyTime'=>$data['signEarlyTime'],
        ];
        db('plan')->insert($add_data);
        db('planlist')->insert([
            'num'=>$num,
            'openid'=>$data['openId'],
        ]);
        return $num;
    }
    public function follow(){
        $data=db('follow')->select();
        $num=count($data);
        return json(['data'=>$data[rand(0,($num-1))]]);
    }
    public function ceshi(){

    }
    public function plan_all(){
        $openid=\think\Request::instance()->param('openId');
        $data=Plans::getSignList($openid);
        return json(['data'=>$data]);
    }



    /**
     * 查询个人的打卡计划 同时显示所有的参与人员以及打卡情况
     * @param $totalNum 一个打卡计划所有的参与人员
     * @param $signedNum 一个打卡计划所有的打卡人数
     */
    public function plan_list(){
        $openid=\think\Request::instance()->param('openId');
        $data=Plans::getByOpenID($openid);
        if($data){
            foreach ($data as $key=>$value){
                $totalNum=db('planlist')->where(['num'=>$value['num']])->count();
                $signedNum=db('planum')->where(['num'=>$value['num'],'signstate'=>'1'])->whereTime('time', 'today')->count();
                $Num=[
                    'totalNum'=>$totalNum,
                    'signedNum'=>$signedNum,
                ];
                $data[$key]=array_merge($data[$key],$Num);
                $plansign=db('planum')->where([
                    'num'=>$value['num'],'openid'=>$value['openid']
                ])->whereTime('time', 'today')->find();
                if($plansign){
                    $data[$key]=array_merge($data[$key],$plansign);
                }else{
                    $data[$key]=array_merge($data[$key],['signstate'=>'0']);
                }
            }
            return json(['data'=>$data]);
        }else{
            return json(['data'=>'no']);
        }
    }


    /*
    * 加入打卡计划
    */
    public function add(){
        $data=\think\Request::instance()->param();
        $add_data=[
            'num'=>$data['taskId'],
            'openid'=>$data['openId'],
        ];
        db('planlist')->insert($add_data);
        return json('ok');
    }
    /*
     * 打卡签到
     */
    public function punch(){
        $data=\think\Request::instance()->param();
        $currentTimeFlag=$data['currentTimeFlag'];
        //已经迟到状态
        if($currentTimeFlag=='1'){
            $add_date=[
                'time'=>time(),
                'signlongitude'=>$data['longitude'],
                'signlatitude'=>$data['latitude'],
                'say'=>$data['say'],
                'signstate'=>'3',
                'openid'=>$data['openId'],
                'num'=>$data['taskID'],
            ];
        }else{
            $add_date=[
                'time'=>time(),
                'signlongitude'=>$data['longitude'],
                'signlatitude'=>$data['latitude'],
                'say'=>$data['say'],
                'signstate'=>'1',
                'openid'=>$data['openId'],
                'num'=>$data['taskID'],
            ];

        }
        db('planum')->insert($add_date);
        return json('ok');
    }
    /*
     * 查询打卡计划
     * @param 通过口令来查询所有参与打卡计划的人员
     * @return 返回查询的信息
     */
    public function getNum(){
        $data=\think\Request::instance()->param();
        $num=$data['taskID'];
        $finddata=db('plan')->alias('a')->join('lyzg_planlist c','a.num=c.num')->where('a.num',$num)->select();
        foreach ($finddata as $key=>$value){
            if($value['openid']){
                $userList=db('spuser')->where('openid',$value['openid'])->select();
                return json(['data'=>$finddata,'userList'=>$userList]);
            }else{
                return json(['data'=>$finddata,'userList'=>""]);
            }
        }
    }

    /*
     * 通过查询 打卡口令 查询打卡的详细信息
     *
     */
    public function findNum(){
        $data=\think\Request::instance()->param();
        $num=$data['taskID'];
        $finddata=db('plan')->where('num',$num)->find();
        $userList=array();
        $data_userList=db('plan')->alias('a')->join('lyzg_planlist c','a.num=c.num')->join('lyzg_spuser b','b.openid=c.openid')->where('a.num',$num)->select();
        foreach ($data_userList as $key=>$value){
                $user_data=db('spuser')->where('openid',$value['openid'])->find();
                $userList[$key]=$user_data;
        }
       return json(['data'=>$finddata,'userList'=>$userList]);
    }

    /*
     * 删除打卡计划
     *
     */
    public function plan_delete(){
        $data=\think\Request::instance()->param();
        $delete_data=[
            'num'=>$data['taskid'],
            'openid'=>$data['openId'],
        ];
        db('planlist')->where($delete_data)->delete();
        return json(['data'=>'ok']);
    }

    /**
     * 申请请假
     * 2状态
     */
    public function leave(){
        $data=\think\Request::instance()->param();
        $add_date=[
            'time'=>time(),
            'signstate'=>'2',
            'openid'=>$data['openId'],
            'num'=>$data['taskID'],
            'reason'=>$data['reason'],
        ];
        db('planum')->insert($add_date);
        return json('ok');
    }

    /*
     * 定时函数  到11点截止查询任务有没有打卡
     * 不存在则存贮4状态  未打卡
     */
        public function timing(){
            $data=\think\Request::instance()->param();
            foreach($data['data'] as $key=>$value){
                $query_planum=db('planum')->where([
                    'num'=>$value['num'],
                    'openid'=>$value['openid'],
                ])->whereTime('time','today')->select();
                if(!$query_planum){
                    db('planum')->insert([
                        'num'=>$value['num'],
                        'openid'=>$value['openid'],
                        'signstate'=>'4',
                        'time'=>time(),
                    ]);
                }
            }
            return json(['data'=>'ok']);
        }

        /*
         * 获取小程序二维码
         */
        public function generate()
        {
            $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . config('app_id') . "&secret=" . config('app_secret');
            $getArr = array();
            $tokenArr = json_decode(send_post($tokenUrl, $getArr, "GET"));
            $access_token = $tokenArr->access_token;

            $path = "pages/home/home";
            $width = 430;
            $post_data = '{"path":"' . $path . '","width":' . $width . '}';
            $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token=" . $access_token;
            $result = _requestPOST($url, $post_data);
            $filename = '11'.'.jpg';
            $xmlstr = $result;
            if(empty($xmlstr)) {
                $xmlstr = file_get_contents('php://input');
            }
            if(!$xmlstr){
                exit( '没有接收到数据流.' );
            } //by www.jbxue.com
            $jpg = $xmlstr;//得到post过来的二进制原始数据
            $file = fopen("../public/uploads/wxcode/".$filename,"w");//打开文件准备写入
            fwrite($file,$jpg);//写入
            fclose($file);//关闭

        }
}