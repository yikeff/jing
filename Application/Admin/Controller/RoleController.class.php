<?php
namespace Admin\Controller;
//use Think\Controller;
class RoleController extends CommonController{
  //显示角色列表
  public function show(){
    if(IS_POST){

    }else{
      $role = D('Role');
      $info = $role->select();
      $this->assign('info',$info);
      $this->display();
    }

  }
  //删除单个角色
  public function del(){
    $role_id = I('get.role_id');
    if(D('Role')->where("role_id = $role_id")->delete()){
      $this->success('删除角色成功',U('show'),3);
    }else{
      $this->error('删除角色失败');
    }
  }
  //删除多个角色
  public function dels(){
    $role_ids = I('get.id');
    $role_ids = ltrim($role_ids,',');
      if(D('Role')->delete($role_ids)){
        $this->success('删除角色成功',U('show'),3);
      }else{
        $this->error('删除角色失败');
      }
  }
  //设置权限
  public function setAuth(){
    if(IS_POST){
      $data = I('post.');
      $role_id = I('get.role_id');
      $role = D('Role');
      if($role->saveAuth($role_id,$data)){
        $this->success('分配权限成功',U('show'),3);
      }else{
        $this->error('分配权限失败');
      }

    }else{
      $role_id = I('get.role_id');
      $role = D('Role');
      $role_ids = $role->find($role_id);

      $auth = M('Auth');
      $levelA = $auth->where("auth_pid = 0")->select();
      $levelB = $auth->where("auth_pid > 0")->select();

      $this->assign('levelA',$levelA);
      $this->assign('levelB',$levelB);
      $this->assign('role_ids',$role_ids);
      $this->display();
    }

  }
}
?>