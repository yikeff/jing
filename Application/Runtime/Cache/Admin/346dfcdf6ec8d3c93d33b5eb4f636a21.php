<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/ueditor.all.min.js"> </script>
        <script type="text/javascript" charset="utf-8" src="/Public/Admin/ue/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript">
        //当页面加载完成后实例化ajax对象
            window.onload = function(){
                //判断浏览器
                var xhr ;
                if(window.XMLHttpRequest){
                    xhr = new XMLHttpRequest();
                }else if(window.ActiveXObject){
                    xhr = new ActiveXObject('Microsoft.XMLHTTP');
                }
                //监听事件判断为4的时候
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4){
                        //alert(xhr.responseText);
                        eval("var arr = " + xhr.responseText);
                        //构建字符串输出替换
                        var str = '<option value="0">请选择种类</option>';
                        for(var i=0;i<arr.length;i++){
                            str += '<option value="'+arr[i].category_id+'">'+arr[i].category_name+'</option>';
                        }
                        document.getElementById('cate').innerHTML = str;
                    }
                }
                //传递参数请求后台
                xhr.open('get',"<?php echo U('Goods/add','type=c');?>");
                xhr.send(null);

                //当分类切换时 下面的品牌随之改变绑定一个改变事件
                var cate = document.getElementById('cate');
                    cate.onchange = function(){
                        var category_id = this.value;
                        //alert(category_id);
                        xhr.onreadystatechange = function(){
                            if(xhr.readyState == 4){
                                eval("var arr = " + xhr.responseText);
                                var str = '<option value="0">请选择品牌</option>';
                                for(var i=0;i<arr.length;i++){
                                    str += '<option value="'+arr[i].brand_id+'">'+arr[i].brand_name+'</option>';
                                }
                                document.getElementById('brand').innerHTML = str;
                            }
                        }
                        xhr.open('get','add?type=b&category='+category_id);
                        xhr.send(null);
                    }
            }
        </script>
        <style type="text/css">
            .table_b{
                border-collapse:collapse;
                border: 1px solid #E3E6EB
            }
        </style>
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：产品中心-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('show');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="" method="post" enctype="multipart/form-data">
            <table border="1" width="100%" class="table_b">
                <tr>
                    <td>商品名称</td>
                    <td><input type="text" name="goods_name" /></td>
                </tr>
                <tr>
                    <td>商品分类</td>
                    <td>
                        <select name="goods_category_id" id="cate">
                            <option value="0">请选择</option>
                            <?php if(is_array($cate_list)): $i = 0; $__LIST__ = $cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["category_id"]); ?>"><?php echo ($v["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品品牌</td>
                    <td>
                        <select name="goods_brand_id" id="brand">
                            <option value="0">请选择</option>
                            <?php if(is_array($brand_list)): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["brand_id"]); ?>"><?php echo ($vo["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品重量</td>
                    <td><input type="text" name="goods_weight" /></td>
                </tr>
                <tr>
                    <td>商品价格</td>
                    <td><input type="text" name="goods_price" /></td>
                </tr>
                <tr>
                    <td>商品数量</td>
                    <td><input type="text" name="goods_number" /></td>
                </tr>
                <tr>
                    <td>是否显示</td>
                    <td><input type="text" name="goods_mark" /></td>
                </tr>
                <tr>
                    <td>商品图片</td>
                    <td><input type="file" name="file" /></td>
                </tr>
                <tr>
                    <td>商品详细描述</td>
                    <td>
                        <textarea id="ue" style="width:500px;height:300px;" name="goods_introduce"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit" value="添  加">
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </body>
    <script type="text/javascript">
        //实例化编辑器
        var ue = UE.getEditor('ue',{toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap'
        ]]});
    </script>
</html>