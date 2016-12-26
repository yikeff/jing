<?php
namespace Admin\Controller;
//use Think\Controller;
class AdminController extends CommonController{
  //显示首页
  public function show(){

    $info = M('Admin')->alias('m')
                      ->field('m.admin_id,m.admin_user,m.admin_lasttime,r.role_name')
                      ->join('left join sw_role r on r.role_id = m.admin_roleid')
                      ->select();
    $this->assign('info',$info);
    $this->display();
  }
  //删除单个
  public function del(){
    $admin_id = I('get.admin_id');
     if(M('Admin')->delete($admin_id)){
        $this->success('删除用户成功',U('show'),3);
     }else{
        $this->error('删除用户失败');
     }
  }
  //删除多个
  public function dels(){
    $admin_ids = I('get.id');
    $admin_ids = ltrim($admin_ids,',');
    if(M('Admin')->delete($admin_ids)){
        $this->success('删除多个用户成功',U('show'),3);
    }else{
        $this->error('删除多个用户失败');
    }
  }
}
?>