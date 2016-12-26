<?php
namespace Admin\Controller;
//use Think\Controller;
class AuthController extends CommonController{
  //首页显示
  public function show(){
    $auth = M('Auth');
    $data = $auth->select();
    load('@/tree');
    $data = getTree($data);
    $this->assign('data',$data);
    $this->display();
  }
  //删除单条
  public function del(){
    $auth_id = I('get.auth_id');
    if(M('Auth')->delete($auth_id)){
      $this->success('删除权限成功',U('show'),3);
    }else{
      $this->error('删除权限失败');
    }
  }
  //删除多条
  public function dels(){
    $auth_ids = I('get.id');
    $auth_ids = ltrim($auth_ids,',');
    if(M('Auth')->delete($auth_ids)){
      $this->success('删除权限成功',U('show'),3);
    }else{
      $this->error('删除权限失败');
    }
  }
  //添加权限
  public function add(){
    if(IS_POST){
      $auth = M('Auth');
      $auth->create();
      if($auth->add()){
        $this->success('添加权限成功',U('show'),3);
      }else{
        $this->error('添加权限失败');
      }

    }else{
      $auth = M('Auth')->where('auth_pid = 0')->select();
      $this->assign('auth',$auth);
      $this->display();
    }
  }
}
?>