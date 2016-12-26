<?php
namespace Admin\Controller;
//use Think\Controller;
class GoodsController extends CommonController{
  //显示商品信息
  public function show(){
    $good = M('Goods');
    //判断是否是post提交的数据若是就显示处理数据 若不是就显示具体信息
    if(IS_POST){
      //获取需要查询品牌的id
      $key = I('post.brand_id');
      //三表链接查询显示信息页面的查询栏根据post来的关键字
      $good_list = $good->alias('g')
          ->field('g.goods_id,g.goods_name,g.goods_weight,g.goods_price,g.goods_number,g.goods_introduce,g.goods_big_img,g.goods_small_img,g.goods_create_time,b.brand_name,c.category_name')
          ->join('left join sw_brand b on g.goods_brand_id = b.brand_id')
          ->join('left join sw_category c on g.goods_category_id = c.category_id')
          ->where("goods_mark = 1 and goods_brand_id = '$key'")
          ->select();
    }else{
     // $good = M('Goods');
     // 默认显示页面 连接查询三表 显示分类 品牌 信息
      $good_list = $good->alias('g')
          ->field('g.goods_id,g.goods_name,g.goods_weight,g.goods_price,g.goods_number,g.goods_introduce,g.goods_big_img,g.goods_small_img,g.goods_create_time,b.brand_name,c.category_name')
          ->join('left join sw_brand b on g.goods_brand_id = b.brand_id')
          ->join('left join sw_category c on g.goods_category_id = c.category_id')
          ->where("goods_mark = 1")
          ->select();
    }
    //这个是显示页面查询栏的下拉菜单
    $brand = M('Brand');
    $brand_list = $brand->field('brand_name,brand_id')->select();
    $this->assign('brand_list',$brand_list);
    //dump($good_list);die;
    $this->assign('good_list',$good_list);
    $this->display();
  }
  //添加商品方法
  public function add(){
    //添加商品 和添加页面公用一个页面 判断是否是post提交 区别 若是就为新添加的商品
    if(IS_POST){
          $good = D('Goods');
         // $data = $good->create();
         // 接收post传递的数据 调用预防xss攻击的方法处理富文本上传的数据
          $data = I('post.');
          $data['goods_introduce'] = filterXSS($_POST['goods_introduce']);
          //自动添加时间
          $data['goods_create_time'] = time();
          //dump($data);die;
          if($good->add_save($data,'0')){
            $this->success('添加成功',U('show'),1);
          }else{
            $this->error('添加失败');
          }
    }else{
      //构建二级联动的处理若不是post传递的数据就走这步由ajax传递 一级分类的自动
          $type = I('get.type');
          if($type == 'c'){
            $cate = M('Category');
            $cate_list = $cate->field('category_id,category_name')->select();
            echo json_encode($cate_list); die;           //$this->assign('cate_list',$cate_list);
          }else if($type == 'b'){
            //二级 品牌的自动
              $category_id = I('get.category');
              $brand = M('Brand');
              $brand_list = $brand->field('brand_id,brand_name')->where("brand_cate_id = '$category_id'")->select();
              echo json_encode($brand_list);die;
              // $this->assign('brand_list',$brand_list);
          }
        $this->display();
    }
  }
  //修改记录的方法
  public function update(){
    //判断是否为post提交的表单数据
    if(IS_POST){
      $good = D('Goods');
      // 接收post传递的数据 调用预防xss攻击的方法处理富文本上传的数据
          $data = I('post.');
          $data['goods_introduce'] = filterXSS($_POST['goods_introduce']);
          //自动添加时间
          $data['goods_id'] = I('get.id');
          //dump($data);die;
          if($good->add_save($data,'1')){
           $this->success('修改成功',U('Goods/show'),1);die;
          }else{
            $this->error('修改失败');
          }
    }else{
        //构建二级联动 一级分类的自动
            $type = I('get.type');
             if($type == 'c'){
              $cate = M('Category');
              $cate_list = $cate->field('category_id,category_name')->select();
              echo json_encode($cate_list); die;           //$this->assign('cate_list',$cate_list);
            }else if($type == 'b'){
              //二级 品牌的自动
                $category = I('get.category');
                $brand = M('Brand');
                $brand_list = $brand->field('brand_id,brand_name')->where("brand_cate_id = '$category'")->select();
                echo json_encode($brand_list);die;
      }
      //获取需要修改记录的id
      $id = I('get.id');
      //三表联查 实例化商品表
      $good = M('Goods');
      $good_list = $good
            //->alias('g')
            //->field('g.goods_id,g.goods_name,g.goods_mark,g.goods_weight,g.goods_price,g.goods_number,g.goods_introduce,g.goods_big_img,g.goods_small_img,g.goods_create_time,b.brand_id,b.brand_name,c.category_id,c.category_name')
            //->join('left join sw_brand b on g.goods_brand_id = b.brand_id')
            //->join('left join sw_category c on g.goods_category_id = c.category_id')
            //->where("goods_id = '$id'")
            ->find($id);
      $this->assign('good_list',$good_list);
      //dump($good_list);die;
    }
     $this->display();
  }
  //修改商品信息的二级联动
  public function getInfo(){
    //构建二级联动 一级分类的自动
        $type = I('get.type');
         if($type == 'c'){
          $cate = M('Category');
          $cate_list = $cate->field('category_id,category_name')->select();
          echo json_encode($cate_list); die;           //$this->assign('cate_list',$cate_list);
        }else if($type == 'b'){
          //二级 品牌的自动
            $category = I('get.category');
            $brand = M('Brand');
            $brand_list = $brand->field('brand_id,brand_name')->where("brand_cate_id = '$category'")->select();
            echo json_encode($brand_list);die;
  }
 }
 //商品相册图片上传
 public function photos(){
    //判断提交方式 若为post就为处理数据
    if(IS_POST){
      //处理数据
      $model = D('Goods');
      $goods_id = I('get.id');
      if($model->addPics($goods_id)){
        $this->success('商品相册图片上传成功',U('Goods/photos',array('id'=>$goods_id)),1);
      }else{
        $this->error('商品相册图片上传失败');
      }
    }else{
      $goods_id = I('get.id');
      $data = $model = M('Goods_pics')->where("pics_goods_id = '$goods_id'")->select();
      $this->assign('data',$data);
      //不是post就是为展示模版
      $this->display();
    }
 }
 //删除相册图片方法
 public function del_pic(){
  $pics_id = I('get.pics_id');
  $info = M('Goods_pics')->find($pics_id);
  unlink($info['pics_ori']);
  unlink($info['pics_big']);
  unlink($info['pics_mid']);
  unlink($info['pics_sma']);

  $result = M('Goods_pics')->delete($pics_id);
  echo $result ? '1' : '0';
 }
 //删除商品的方法
   public function del(){
    $goods_id = I('get.id');
      if(M('Goods')->where("goods_id = $goods_id")->delete()){
        $this->success('删除商品成功',U('Goods/show'),3);
      }else{
        $this->error('删除商品失败');
      }
   }
}
?>