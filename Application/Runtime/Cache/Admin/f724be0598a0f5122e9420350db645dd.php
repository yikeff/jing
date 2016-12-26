<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style_ele.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页-></a></li>
            <li><a href="#">表单</a></li>
        </ul>
    </div>
    <div class="formbody">
        <div class="formtitle"><span>基本信息</span></div>
        <form action="" method="post">
            <ul class="forminfo">
                <li>
                    <label>权限名称</label>
                    <input name="auth_name" placeholder="请输入权限名称" type="text" class="dfinput" /></li>
                <li>
                    <label>父级权限</label>
                    <select name="auth_pid" class="dfinput">
                    <option value="0">作为顶级</option>
                    <?php if(is_array($auth)): $i = 0; $__LIST__ = $auth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["auth_id"]); ?>"><?php echo ($v["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <i></i></li>
                <li>
                    <label>控制器名</label>
                    <input name="auth_c" placeholder="请输入控制器名称" type="text" class="dfinput" />
                </li>
                <li>
                    <label>方法名称</label>
                    <input name="auth_a" placeholder="请输入方法名称" type="text" class="dfinput" />
                </li>
                <li>
                    <label>&nbsp;</label>
                    <input name="" id="btnSubmit" type="button" class="btn" value="确认保存" />
                </li>
            </ul>
        </form>
    </div>
</body>
<script type="text/javascript">
//jQuery代码
$(function(){
    //给btnsubmit绑定点击事件
    $('#btnSubmit').on('click',function(){
        //表单提交
        $('form').submit();
    });
    //当页面加载完成 默认为顶级 所以下面的不显示
    $("input[name=auth_c]").parent().hide();
    $("input[name=auth_a]").parent().hide();
    //给下拉列表绑定一个变化事件
    $('select[name=auth_pid]').change(function(){
        //获取下面的值
        var val = $(this).val();
        if(val > 0){
            $("input[name=auth_c]").parent().show();
            $("input[name=auth_a]").parent().show();
        }else{
            $("input[name=auth_c]").parent().hide();
            $("input[name=auth_a]").parent().hide();
        }
    });

});
</script>
</html>