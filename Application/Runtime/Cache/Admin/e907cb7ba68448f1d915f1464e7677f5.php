<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <style type="text/css">
        .btn11{width:137px;height:35px; background:url(/Public/Admin/img/btnback.png) no-repeat; font-size:14px;font-weight:bold;color:#fff; cursor:pointer;}
    </style>
</head>

<body>
    <div class="div_head">
        <span>当前位置是：</span>
        <span class="placeul">
            <span>产品中心-》</span>
            <span>商品相册</span>
        </span>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>商品相册</span></div>

        <li id="photolist" style="border: 1px solid grey;margin-bottom: 20px;">
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><span><img src="<?php echo (ltrim($v["pics_mid"],'.')); ?>" height="178"><a data="<?php echo ($v["pics_id"]); ?>" href="javascript:;" class="del_pic">[-]</a>&emsp;</span><?php endforeach; endif; else: echo "" ;endif; ?>
        </li>

        <form action="" method="post" enctype="multipart/form-data">
            <ul class="forminfo">
                <li>
                    <label>商品图片[<a href="javascript:;" class="add">+</a>]</label>
                    <input name="goods_pic[]" type="file" />
                </li>

                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn11" value="确认上传" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
$(function(){
    $('#btnSubmit').on('click',function(){
        $('form').submit();
    });
    //给+绑定点击事件添加
    $('.add').click(function(){
        var str = "<li><label>商品图片[<a href='javascript:;'' class='del'>-</a>]</label><input name='goods_pic[]'' type='file' /></li>";
        $(this).parent().parent().after(str);
        //给添加上的li绑定点击移除事件
        $('.del').live('click',function(){
            $(this).parent().parent().remove();
        });
    });
    $('.del_pic').click(function(){
        var pics_id = $(this).attr('data');
        var _this = this;
        $.get('/index.php/Admin/Goods/del_pic/pics_id/'+pics_id,function(data){
            if(data == 1){
                $(_this).parent().remove();
            }else{
                alert('删除相册图片失败');
            }

        });
    });
});
</script>
</html>