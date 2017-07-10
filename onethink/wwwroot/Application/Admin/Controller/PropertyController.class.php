<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;


/**
 * 后台用户控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class PropertyController extends AdminController {

    public function index(){

        $list   = $this->lists('Property');
        int_to_string($list);
        $this->assign('_list', $list);

        $this->display();
    }

    public function add(){

        if(IS_POST){
            $Property = D('Property');
            $data = $Property->create();

            if($data){
                $id = $Property->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Property->getError());
            }
        } else {
            $this->display('add');
        }

    }


   public function del(){
       $id = array_unique((array)I('id',0));
      if(empty($id)){
          $this->error('id错误');
      }
       $map = array('id' => array('in', $id) );

      if(M('Property')->where($map)->delete()){
          $this->success('删除成功');
      }else{
          $this->error('删除失败');
      }
   }

   public function edit($id=0){

       if(IS_POST){
           $Property = M('Property');
           $data = $Property->create();
           $id = I('id',0)+0;

           if($data){
               if(($Property->where('id='.$id)->save($data))){

                   $this->success('编辑成功', U('index'));
               } else {
                   $this->error('编辑失败');
               }

           } else {
               $this->error($Property->getError());
           }





       }else{

           $info = array();
           /* 获取数据 */
           $info = M('Property')->find($id);

           if(false === $info){
               $this->error('获取配置信息错误');
           }

           $this->assign('info', $info);

           $this->display('edit');
       }

   }


   public function tool(){
       $this->display('box');
   }



   public function active(){
       $id=I('id');
       $action=M('Userd');
       $info=$action->select();

       $document=M('Document');
       $activeall=[];
       foreach($info as $row){
           $rs=$document->where(['id'=>$row['adocument']])->select();
           $res=array_merge($rs[0],$row);

           $activeall[]=$res;
       }
       $this->assign('activeall', $activeall);
       $this->display('active');
   }


   public function activestatus(){
       $aid=I('re');
       $action=M('Userd');
       $info=$action->where(['aid'=>$aid])->select();
       if($info[0]['activestatus']==0){
           $info[0]['activestatus']=1;
           $date['activestatus']=$info[0]['activestatus'];
           $action->where("aid=$aid")->save($date);
           echo json_encode(1);
           exit;
       }else{
           $info[0]['activestatus']=0;
           $date['activestatus']=$info[0]['activestatus'];
           $action->where("aid=$aid")->save($date);
           echo json_encode(0);
           exit;
       }


   }


   public function activedel(){
       $aid=I('del');
       $action=M('Userd');
       $info=$action->where(['aid'=>$aid])->delete();
       echo json_encode(1);
   }

}
