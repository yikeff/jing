<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
  //处理商品相册图片
  public function addPics($goods_id){
    //判断是否有必要上传 设置一个参数
    if(in_array('0',$_FILES['goods_pic']['error'])){
      $flag = 1;
    }
    //处理上传 缩略图
    if($flag){
      $config = array(
          'rootPath' => './Uploads/',
          'maxSize' => 5242880,
          'exts' => array('jpg','png','gif','bmp'),
        );
      $upload = new \Think\Upload($config);
      $info = $upload->upload();
      if(!$info){
        $errorInfo = $upload->getError();
        echo "<script>alert('$errorinfo');history.back(-1);</script>";
      }else{
        $img = new \Think\Image();
        foreach($info as $k=>$val){
          $img->open($config['rootPath'].$val['savepath'].$val['savename']);
          $img->thumb(800,800);
          $big = $config['rootPath'].$val['savepath'].'big_'.$val['savename'];
          $img->save($big);

          $img->thumb(333,333);
          $mid = $config['rootPath'].$val['savepath'].'mid_'.$val['savename'];
          $img->save($mid);

          $img->thumb(50,50);
          $sma = $config['rootPath'].$val['savepath'].'sma_'.$val['savename'];
          $img->save($sma);

          $data[$k]['pics_goods_id'] = $goods_id;
          $data[$k]['pics_ori'] = $config['rootPath'].$val['savepath'].$val['savename'];
          $data[$k]['pics_big'] = $big;
          $data[$k]['pics_mid'] = $mid;
          $data[$k]['pics_sma'] = $sma;
        }
          return M('Goods_pics')->addAll($data);
      }
    }
  }
  //添加商品
  public function add_save($data,$tip){
    if($_FILES['file']['error'] == '0'){
      //配置上传域的参数
        $config = array(
            'maxSize' => 5242880,
            'exts' => array('jpg','png','gif','bmp'),
            'rootPath' => './Uploads/'
          );
        //实例化上传类
        $upload = new \Think\Upload($config);
        $info = $upload->upload();
        //dump($info);die;
        if(!$info){
          $errorInfo = $upload->getError();
          echo "<script>alert('$errorinfo');history.back(-1);</script>";
          //echo $upload->getError();
        }else{
          //实例化图像处理类 生成缩略图
          $img = new \Think\Image();
          $path = './Uploads/'.$info['file']['savepath'].$info['file']['savename'];
          $img->open($path);
          $img->thumb(35,50);
          $smallpath = './Uploads/'.$info['file']['savepath'].'thumb_'.$info['file']['savename'];
          $img->save($smallpath);
          $data['goods_big_img'] = $path;
          $data['goods_small_img'] = $smallpath;
        }
    }
    if('0' == $tip){
     return $this->add($data);
    }else if('1' == $tip){
      //修改信息需要删除原来的文件
      $model = M('Goods')->find($data['goods_id']);
      unlink($model['goods_big_img']);
      unlink($model['goods_small_img']);
      return $this->save($data);
    }

  }

}
?>