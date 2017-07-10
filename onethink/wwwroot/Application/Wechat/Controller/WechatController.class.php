<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wechat\Controller;
use Wechat\Controller\UserController;
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
        if(IS_POST){
            $i=I('page');
            if($i==null){
                $i=1;
            }
            $page=($i-1)*2;
            $result=$action->where(['category_id'=>41])->limit($page,2)->select();
            $active=M('Picture');
            $info=[];
            $i++;
            foreach ($result as $row){
                $id=$row['cover_id'];
                $rs=$active->where("id=$id")->select();

                $img=$rs[0]['path'];
                $row['img']=$img;
                $info[]=$row;
            }

            echo json_encode($info);
        }else{
            $i=I('page');
            if($i==null){
                $i=1;
            }
            $page=($i-1)*2;
            $result=$action->where(['category_id'=>41])->limit($page,2)->select();
            $active=M('Picture');
            $info=[];
            $i++;
            foreach ($result as $row){
                $id=$row['cover_id'];
                $rs=$active->where("id=$id")->select();

                $img=$rs[0]['path'];
                $row['img']=$img;
                $info[]=$row;
            }



            $this->assign('info',$info);
            $this->assign('i',$i);
            $this->display('active');
        }

    }






    public function activeinfo(){

        $id=I('id');
        $action=M('Document');
        $info=$action->where(['id'=>$id,'category_id'=>41])->select();
        $info[0]['view']+=1;
        $date['view']=$info[0]['view'];
        $action->where("id=$id")->save($date);
        $active=M('Picture');
        $id=$info[0]['cover_id'];
        $rs=$active->where("id=$id")->select();
        $img=$rs[0]['path'];
        $info[0]['img']=$img;
        $info[0]['view']=$date['view'];


        $mid=$info[0]['uid'];
        $member=M('Member');
        $res=$member->where("uid=$mid")->select();



        $info[0]['user']=$res[0]['nickname'];

        $this->assign('info',$info);

        $this->display('activeinfo');
    }





    public function notice(){
        $action=M('Document');
        if(IS_POST){
            $i=I('page');
            if($i==null){
                $i=1;
            }
            $page=($i-1)*2;
            $result=$action->where(['category_id'=>40])->limit($page,2)->select();
            $active=M('Picture');
            $info=[];
            $i++;
            foreach ($result as $row){
                $id=$row['cover_id'];
                $rs=$active->where("id=$id")->select();

                $img=$rs[0]['path'];
                $row['img']=$img;
                $info[]=$row;
            }

            echo json_encode($info);
        }else{
            $i=I('page');
            if($i==null){
                $i=1;
            }
            $page=($i-1)*2;
            $result=$action->where(['category_id'=>40])->limit($page,2)->select();
            $active=M('Picture');
            $info=[];
            $i++;
            foreach ($result as $row){
                $id=$row['cover_id'];
                $rs=$active->where("id=$id")->select();

                $img=$rs[0]['path'];
                $row['img']=$img;
                $info[]=$row;
            }



            $this->assign('info',$info);
            $this->assign('i',$i);
            $this->display('notice');
        }

    }


    public function noticeinfo(){

        $id=I('id');
        $action=M('Document');
        $info=$action->where(['id'=>$id,'category_id'=>40])->select();
        $info[0]['view']+=1;
        $date['view']=$info[0]['view'];
        $action->where("id=$id")->save($date);
        $active=M('Picture');
            $id=$info[0]['cover_id'];
            $rs=$active->where("id=$id")->select();
            $img=$rs[0]['path'];
           $info['img']=$img;
           $info[0]['view']=$date['view'];


         $mid=$info[0]['uid'];
         $member=M('Member');
         $res=$member->where("uid=$mid")->select();



        $info['user']=$res[0]['nickname'];


        $this->assign('info',$info);

        $this->display('noticeinfo');
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
        is_login() || $this->error('您还没有登录，请先登录！', U('Wechat/user_login'));
        $username= $_SESSION['name'];
//var_dump($username);exit;
        $this->assign('username',$username);

            $this->display('content');
    }

    public function addactive(){

        if(is_login()==0){

            echo json_encode(3);

            exit;
        }


        $username=$data['username']=$_SESSION['name'];
        $document=$data['document']=I('document');
        $document+=0;
        $userd=M('Userd');
        if($data['document']==null){
            echo json_encode(0);
            exit;
        }

        $re=$userd->where(['username'=>$username, 'document'=>$document])->find();
        if($re==null){
            $userd->data($data)->add();
            echo json_encode(1);
            exit;
        }else{
            echo json_encode(0);
            exit;


        }


    }



    public function loginout(){
        $this->logout();
    }


    public function myactive(){
     $username=I('username');
     $userd=M('Userd');
     $document=M('Document');
     $result=$userd->where(['username'=>$username])->select();

     $myactive=[];
     foreach($result as $row){
       $id=$row['document']-0;

         $result=$document->where(['id'=>$id])->select();

         $row['title']=$result[0]['title'];
         $row['description']=$result[0]['description'];
         $myactive[]=$row;
     }
        echo json_encode($myactive);
    }


    public function online(){
        is_login()||$this->error('你还没有登录,请登录',U('Wechat/user_login'));
        if(IS_POST){
            $online=D('Online');
            $data=I();
            $data['member']=$_SESSION['name'];
            $data['create_time']=date('Y-m-dH:i:s',time());
                $online->add($data);
                $this->redirect('Wechat/content');
        }else{

            $this->display('online');
        }
    }

    public function myfix(){

        $username=I('username');

        $online=M('Online');

        $result=$online->where(['member'=>$username])->select();


        echo json_encode($result);
    }

}