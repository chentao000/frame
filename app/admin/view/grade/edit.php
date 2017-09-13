<?php include '../app/admin/view/common/header.php'?>
<!--右侧主体区域部分 start-->
<div class="col-xs-12 col-sm-9 col-lg-10">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="" >班级修改界面</a></li>
        <li><a href="<?php echo u('add')?>" >班级添加界面</a></li>
    </ul>
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">班级修改</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">班级名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="gname" id="" value="<?php echo $oldData['gname']?>">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">修改</button>
    </form>
</div>
<?php include '../app/admin/view/common/footer.php'?>
