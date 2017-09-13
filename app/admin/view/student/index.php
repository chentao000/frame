<?php include '../app/admin/view/common/header.php'?>
<!--右侧主体区域部分 start-->
<div class="col-xs-12 col-sm-9 col-lg-10">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#tab1" >学生管理界面</a></li>
        <li><a href="<?php echo u('add')?>" >学生添加界面</a></li>
    </ul>
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">学生管理</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>学生编号</th>
                        <th>学生头像</th>
                        <th>学生姓名</th>
                        <th>学生性别</th>
                        <th>学生年龄</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $v): ?>
                        <tr>
                            <td><?php echo $v['sid'] ?></td>
                            <td><img src="<?php echo $v['mpath']?>" style="width: 50px;height: 50px" alt=""></td>
                            <td><?php echo $v['sname'] ?></td>
                            <td><?php echo $v['ssex'] ?></td>
                            <td><?php echo $v['sage'] ?></td>
                            <td><?php echo date('y-m-d',$v['stime']) ?></td>
                            <td>
                                <div class="btn-group btn-group-s">
                                    <a href="<?php echo u('edit',['sid'=>$v['sid']]) ?>" class="btn btn-primary">编辑</a>
                                    <a href="javascript:;"  onclick = "del(<?php echo $v['sid']?>)"  class="btn btn-danger">删除</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<script>
    function del(sid) {
        var url = "<?php echo u('del')?>" + '&sid=' + sid;
//        调用modal函数
        modal(url);
    }
</script>
<?php include '../app/admin/view/common/footer.php'?>
