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
            <li><a href="#">首页</a></li>
            <li><a href="#">数据表</a></li>
            <li><a href="#">基本内容</a></li>
        </ul>
    </div>
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="/Public/Admin/img/t01.png" /></span>添加</li>
                <li><span><img src="/Public/Admin/img/t02.png" /></span>修改</li>
                <a href="javascript:;" id="dels" ><li><span><img src="/Public/Admin/img/t03.png" /></span>删除</li></a>
                <li><span><img src="/Public/Admin/img/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" onclick="selectAll()" />
                    </th>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>上次登录时间</th>
                    <th>角色</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input name="check" type="checkbox" value="<?php echo ($vol["mg_id"]); ?>" />
                    </td>
                    <td><?php echo ($vol["mg_id"]); ?></td>
                    <td><?php echo ($vol["mg_name"]); ?></td>
                    <td><?php echo (date('Y-m-d H:i:s',$vol["mg_time"])); ?></td>
                    <?php if($vol["mg_id"] == 1 ): ?><td>超级管理员</td>
                    <td>超管太牛</td>
                    <?php else: ?>
                    <td><?php echo ($vol["role_name"]); ?></td>
                    <td><a href="/index.php/Admin/Manager/setAuth/role_id/<?php echo ($vol["mg_id"]); ?>" class="tablelink">修改</a> <a href="/index.php/Admin/Manager/del/mg_id/<?php echo ($vol["mg_id"]); ?>" class="tablelink" onclick="return del()"> 删除</a></td><?php endif; ?>

                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        function selectAll(){
            if($('#checkAll').attr('checked')){
                $(':checkbox').attr('checked',true);
            }else{
                $(':checkbox').attr('checked',false);
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

            location.href = "/index.php/Admin/Manager/dels/id/"+ids;
        });

        function del(){

            return confirm('你确定删除吗？');
        }

        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</body>

</html>