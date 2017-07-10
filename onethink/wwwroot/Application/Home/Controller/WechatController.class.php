<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class WechatController extends UserController {

	//系统首页
    public function index(){

                 
        $this->display();
    }


    public function sale(){
        $property=M('Property');
        $zu=$property->where('class=1')->select();
        $cu=$property->where('class=2')->select();
        $this->assign('zu', $zu);
        $this->assign('cu',$cu);

        $this->display('zu');
    }



    public function info(){
        $id=I('id',0);
        $property=M('Property');
        $info=$property->where("id=$id")->select();
        $this->assign('info',$info);
        $this->display('info');
    }


    public function active(){
        $action=M('Document');
        $result=$action->select();
        $active=M('Picture');
        $info=[];
        foreach ($result as $row){
            $id=$row['cover_id'];
            $rs=$active->where("id=$id")->select();

            $img=$rs[0]['path'];
           $row['img']=$img;
           $info[]=$row;

        }


        $this->assign('info',$info);

        $this->display('notice');
    }



    public function notice(){
        $id=I('id');
        $action=M('Document');
        $info=$action->where("id=$id")->select();
        $active=M('Picture');
            $id=$info[0]['cover_id'];
            $rs=$active->where("id=$id")->select();
            $img=$rs[0]['path'];
           $info['img']=$img;


         $mid=$info[0]['uid'];
         $member=M('Member');
         $res=$member->where("uid=$mid")->select();



        $info['user']=$res[0]['nickname'];


        $this->assign('info',$info);

        $this->display('notice1');
    }

    public function user_login(){

        $password=I('password');
        $username=I('username');
        $verify=I('verify');

        if(IS_POST){
//            $username = '', $password = '', $verify = '';
//            var_dump($username,$password,$verify);
            $_SESSION['name']=$username;

            $this->login($username,$password,$verify);


        }else{

           $re=$this->buildhtml('user_login.html','','Wechat:user_login');

            $this->display('user_login');
        }


    }


    public function content(){

        $username= $_SESSION['name'];
//var_dump($username);exit;
        $this->assign('username',$username);

            $this->display('content');
    }


}