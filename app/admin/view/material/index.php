<?php include '../app/admin/view/common/header.php'?>
<!--右侧主体区域部分 start-->
<div class="col-xs-12 col-sm-9 col-lg-10">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#tab1" >素材管理界面</a></li>
        <li><a href="<?php echo u('add')?>" >素材添加界面</a></li>
    </ul>
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">素材管理</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>素材编号</th>
                        <th>素材显示</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $v): ?>
                        <tr>
                            <td><?php echo $v['mid']?></td>
                            <td><img src="<?php echo $v['mpath']?>" style="width: 50px;height: 50px" alt=""></td>
                            <td><?php echo date('y-m-d',$v['mtime'])?></td>
                            <td>
                                <div class="btn-group btn-group-s">
                                    <a href="javascript:;"  onclick = "del(<?php echo $v['mid']?>)"  class="btn btn-danger">删除</a>
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
    function del(mid) {
        var url = "<?php echo u('del')?>" + '&mid=' + mid;
//        调用modal函数
        modal(url);
    }
</script>
<?php include '../app/admin/view/common/footer.php'?>
