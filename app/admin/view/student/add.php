<?php include '../app/admin/view/common/header.php' ?>
<!--右侧主体区域部分 start-->
<div class="col-xs-12 col-sm-9 col-lg-10">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="<?php echo u('index') ?>">学生管理界面</a></li>
        <li class="active"><a href="">学生添加界面</a></li>
    </ul>
    <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">学生添加</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">学生姓名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sname" id="" placeholder="">
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">学生年龄</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="sage" id="" placeholder="">
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">学生性别</label>
                    <div class="col-sm-10" style="line-height: 35px">
                        <input type="radio" name="ssex" checked value="男">男
                        <input type="radio" name="ssex"  value="女">女
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">学生照片</label>
                    <div class="col-sm-10">
                        <?php foreach ($materialData as $v) { ?>
                            <input type="radio" name="mid" value="<?php echo $v['mid'] ?>">
                            <img style="width: 50px;height: 50px;margin-right: 20px;border: 1px solid red"
                                 src="<?php echo $v['mpath'] ?>" alt="">
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">学生班级</label>
                    <div class="col-sm-10">
                        <select name="gid" id="inputID" class="form-control">

                            <option value="0"> -- Select One -- </option>
                            <?php foreach($gradeData as $v):?>
                                <option value="<?php echo $v['gid']?>"> -- <?php echo $v['gname']?> -- </option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" class="form-control" name="stime" value="<?php echo time()?>">
        </div>
        <button class="btn btn-primary">添加</button>
    </form>
</div>
<?php include '../app/admin/view/common/footer.php' ?>
