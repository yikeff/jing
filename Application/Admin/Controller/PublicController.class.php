<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller{
  public function login(){
    if(IS_POST){
        $data = I('post.');
        $data['admin_psd'] = getPwd($data['admin_psd']);
        $info = M('Admin')->where($data)->find();
        if($info){
          session('admin_user',$info['admin_user']);
          session('admin_lasttime',$info['admin_lasttime']);
          session('admin_roleid',$info['admin_roleid']);
          M('Admin')->save(array('admin_lasttime'=>time(),'admin_id'=>$info['admin_id']));
          $this->success('登录成功',U('Index/index'),3);
        }else{
          $this->error('用户名或密码错误');
        }
    }else{

        $this->display();
    }

  }
  //退出系统
  public function quit(){
    if(!session(null)){
      $this->success('退出成功',U('Public/login'),3);
    }else{
      $this->error('退出失败');
    }
  }
 /* public function getInit(){
	  echo getPwd('123456');
  }*/
}
?>