<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：产品中心-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加商品】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="" method="post">
                    品牌<select name="brand_id" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <?php if(is_array($brand_list)): foreach($brand_list as $key=>$val): ?><option value="<?php echo ($val["brand_id"]); ?>"><?php echo ($val["brand_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <th>序号</th>
                        <th>商品名称</th>
                        <th>库存</th>
                        <th>价格</th>
                        <th>图片</th>
                        <th>缩略图</th>
                        <th>分类</th>
                        <th style="width:105px;">品牌</th>
                        <th style="width:145px;">创建时间</th>
                        <th style="width:115px;">操作</th>
                    </tr>
                    <?php if(is_array($good_list)): $i = 0; $__LIST__ = $good_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="product1">
                        <td><?php echo ($v["goods_id"]); ?></td>
                        <td><a href="#"><?php echo ($v["goods_name"]); ?></a></td>
                        <td><?php echo ($v["goods_number"]); ?></td>
                        <td><?php echo ($v["goods_price"]); ?></td>
                        <td><img src="<?php echo (ltrim($v["goods_big_img"],'.')); ?>" height="60" width="40"></td>
                        <td><img src="<?php echo (ltrim($v["goods_small_img"],'.')); ?>"></td>
                        <td><?php echo ($v["category_name"]); ?></td>
                        <td><?php echo ($v["brand_name"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$v["goods_create_time"])); ?></td>

                        <td>
                            <a href="<?php echo U('Goods/update','id='.$v['goods_id']);?>" >修改 </a>|
                            <a href="/index.php/Admin/Goods/photos/id/<?php echo ($v["goods_id"]); ?>"> 相册 </a>|
                            <a href="<?php echo U('Goods/del','id='.$v['goods_id']);?>" onclick="return del()"> 删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            [1]
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        function del(){
            return confirm('确定删除吗');
        }
    </script>
</html>