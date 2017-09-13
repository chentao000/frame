<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<link rel="stylesheet" href="./static/bs3/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>欢迎进入<small>学生管理系统</small></h1>
        </div>
        <div class="row">
        	<div class="panel panel-primary">
        		  <div class="panel-heading">
        				<h3 class="panel-title">Panel title</h3>
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
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($data as $v): ?>
                              <tr>
                                  <td ><?php echo $v['sid'] ?></td>
                                  <td><img src="<?php echo $v['mpath']?>" style="width: 50px;height: 50px" alt=""></td>
                                  <td><?php echo $v['sname'] ?></td>
                                  <td><?php echo $v['ssex'] ?></td>
                                  <td><?php echo $v['sage'] ?></td>
                                  <td><?php echo date('y-m-d',$v['stime']) ?></td>
                              </tr>
                          <?php endforeach;?>
                          </tbody>
                      </table>
        		  </div>
        	</div>
        </div>
    </div>
</body>
</html>