<?php include '../app/admin/view/common/header.php'?>
		<!--右侧主体区域部分 start-->
		<div class="col-xs-12 col-sm-9 col-lg-10">
			<!-- TAB NAVIGATION -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab1" >密码修改界面</a></li>
			</ul>
			<form action="" method="POST" class="form-horizontal" role="form">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">密码修改</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">用户名</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" disabled name="admin_username" placeholder="" value="<?php echo $username ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">原密码</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="admin_password" placeholder="" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">新密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="newpassword1" placeholder="" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">确认新密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="newpassword2" placeholder="" value="">
							</div>
						</div>
					</div>
				</div>
				<button class="btn btn-primary">修改密码</button>
			</form>
		</div>
<?php include '../app/admin/view/common/footer.php'?>
