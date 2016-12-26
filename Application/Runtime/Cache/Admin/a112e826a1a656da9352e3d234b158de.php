<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style_ele.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页-></a></li>
            <li><a href="#">查看权限-></a></li>
            <li><a href="#">基本内容</a></li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <a href="<?php echo U('add');?>"><li><span><img src="/Public/Admin/img/t01.png" /></span>添加</li></a>
                <a href="javascript:;" id="edit"><li><span><img src="/Public/Admin/img/t02.png" /></span>修改</li></a>
                <a href="javascript:;" id="dels"><li><span><img src="/Public/Admin/img/t03.png" /></span>删除</li></a>
                <li><span><img src="/Public/Admin/img/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                       <input name="" type="checkbox" id="checkAll" value="" onclick="selectAll()" />
                    </th>
                    <th>编号</th>
                    <th>权限名称</th>
                    <th>上级id</th>
                    <th>控制器</th>
                    <th>方法</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input name="check" type="checkbox" value="<?php echo ($v["auth_id"]); ?>" />
                    </td>
                    <td><?php echo ($v["auth_id"]); ?></td>
                    <td><?php echo (str_repeat('----',$v["level"])); echo ($v["auth_name"]); ?></td>
                    <td><?php echo ($v["auth_pid"]); ?></td>
                    <td><?php echo ($v["auth_c"]); ?></td>
                    <td><?php echo ($v["auth_a"]); ?></td>
                    <td>
                        <a href="/index.php/Admin/Auth/edit/auth_id/<?php echo ($v["auth_id"]); ?>" class="tablelink">修改</a>
                        <a href="/index.php/Admin/Auth/del/auth_id/<?php echo ($v["auth_id"]); ?>" class="tablelink" onclick="return del()"> 删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="/Public/Admin/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function selectAll(){
            if($('#checkAll').attr('checked')){
                $(":checkbox").attr('checked',true);
            }else{
              $(":checkbox").attr('checked',false);
            }
        }
        $('input[name="check"]').change(function(){
            $('#checkAll').attr('checked',false)
        });
        $('#dels').click(function(){
            var check_list = $(":checkbox:checked");
            var ids = "";
            check_list.each(function(){
                ids += $(this).val()+',';
            });
            ids = ids.substr(0,ids.length-1);
            if(!ids){
                alert('请选择要删除的记录！！！');
                return;
            }else{
                var mark = confirm('亲你确定要删除这么多吗？？？');
                        if(!mark){
                            return false;
                        }
            }
            //alert(ids);

            location.href = "/index.php/Admin/Auth/dels/id/"+ids;
        });

        function del(){
            return confirm('你确定删除吗？');
        }
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</body>

</html>