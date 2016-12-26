<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
  //判断用户是否登录
  public function _initialize(){
    if(!session("?admin_user")){
      $url = U('Public/login');
      echo "<script>top.location.href='$url';</script>";
    }
    $admin_roleid = session('admin_roleid');
    if($admin_roleid != '1'){
      $nowPath = strtolower(CONTROLLER_NAME.'-'.ACTION_NAME);
      $role = M('Role')->find($admin_roleid);
      $role_ac = strtolower($role['role_auth_ac']."Index-index,Index-left,Index-head,Index-right");
      if(strpos($role_ac,$nowPath) === false ){
        $this->error('无权访问该页面',U('Public/login'),3);
      }
    }

  }
}
?>