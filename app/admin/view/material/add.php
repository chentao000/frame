<?php include '../app/admin/view/common/header.php'?>
<!--右侧主体区域部分 start-->
<div class="col-xs-12 col-sm-9 col-lg-10">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li ><a href="<?php echo u('index')?>" >素材管理界面</a></li>
        <li class="active"><a href="" >素材添加界面</a></li>
    </ul>
    <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">素材添加</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">素材名称</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="mpath" id="" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">添加</button>
    </form>
</div>
<?php include '../app/admin/view/common/footer.php'?>
