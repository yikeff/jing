<?php
namespace Admin\Controller;
//use Think\Controller;
class IndexController extends CommonController{
    public function index(){
        $this->display();
    }
    public function head(){
      $this->display();
    }
    public function left(){
      $admin_roleid = session('admin_roleid');
      if($admin_roleid == '1'){
        $levelA = M('Auth')->where("auth_pid = '0' and auth_isnav = '1'")->select();
        $levelB = M('Auth')->where("auth_pid > '0' and auth_isnav = '1'")->select();

      }else{
        $ids = M('Role')->find($admin_roleid);
        $ids_info = $ids['role_auth_ids'];
        $levelA = M('Auth')->where("auth_id in ($ids_info) and auth_pid = '0' and auth_isnav = '1'")->select();
        $levelB = M('Auth')->where("auth_id in ($ids_info) and auth_pid > '0' and auth_isnav = '1'")->select();
      }

      $this->assign('levelA',$levelA);
      $this->assign('levelB',$levelB);
      $this->display();
    }
    public function right(){
      $this->display();
    }
}