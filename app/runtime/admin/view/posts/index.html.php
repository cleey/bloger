<?php if (!defined('POEM_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="//cdn.bootcss.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/static/admin/admin.css"/>
		<link rel="stylesheet" type="text/css" href="/static/cnavi/cnavi.css"/>

		<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
		<link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<title> 后台模板-后台管理 </title>
	</head>
	<body>
		<?php if (!defined('POEM_PATH')) exit();?><nav class="navbar navbar-default">
	<div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">后台模板-后台管理</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"> <i class="fa fa-server mr10"></i> 后台模板</a>
		</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class=""><a href="/admin/index/index">后台首页 <span class="sr-only">(current)</span></a></li>
				<li class=""><a href="/admin/cnavi">菜单管理</a></li>
				<li class=""><a href="/">ShareHave首页</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="#">Link</a></li> -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle navr-a" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<img src="http://www.cleey.com/image/user/3.jpg" class="img-thumbnail img-circle navr-img">
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#">Action</a></li> -->
						<!-- <li><a href="#">Another action</a></li> -->
						<!-- <li><a href="#">Something else here</a></li> -->
						<!-- <li role="separator" class="divider"></li> -->
						<li><a href="#">退出</a></li>
					</ul>
				</li>
			</ul>

		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>


		<div class="cbody">
			<div class="cside col-md-2"> <?php if (!defined('POEM_PATH')) exit();?><?php 
$module = strtolower('/'.POEM_MODULE.'/'.POEM_CTRL);
$tmpurl = $module.strtolower('/'.POEM_FUNC);
$cmeuList = menuList();
?>

<div class="wd-menu-head">
	<img src="http://www.cleey.com/image/user/3.jpg" class="img-thumbnail img-circle">
	<div>
		欢迎您！<br>
		管理员
	</div>
</div>
<ul class="wd-menu">
<?php foreach ($cmeuList as $vof) {
	$ic='angle-down';
	$active='';
	if($vof['p']['url'] == $module ){
		$active='class="active"';
		$ic='angle-up';
	}
	?>
<li <?php echo $active;?> >
	<a href="javascript:void(0);">
		<i class="fa fa-<?php echo $vof['p']['img'] ?>"></i>  <?php echo $vof['p']['title'] ?>
		<i class="ri fa fa-<?php echo $ic ?>"></i>
	</a>
	<div class='child'>
	<?php foreach ($vof['c'] as $vo) { ?>
		<a href="<?php echo $vo['url']; ?>" class="<?php if($vo['url'] == $tmpurl) echo 'active'; ?>">
			<?php echo $vo['title']; ?>
		</a>
	<?php } ?>
	</div>
</li>
<?php } ?>
</ul>


 </div>
			<div class="cmain col-md-10"> <div class="panel panel-default">
	<div class="panel-heading">图文列表</div>
	<div class="panel-body">

		<table class="table table-hover table-striped table-bordered fixed-tb mb0">
			<thead>
				<tr>
					<th>序号</th>
					<th>标题</th>
					<th>标签</th>
					<th>分类</th>
					<th>创建时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $list as $vo ){ ?>
				<tr>
					<td><?php echo $vo['id'];?></td>
					<td><?php echo $vo['title'];?></td>
					<td><?php echo $vo['tags'];?></td>
					<td><?php echo $vo['classifys'];?></td>
					<td><?php echo $vo['ctime'];?></td>
					<td>
						<a class="btn btn-xs btn-default" href="/admin/posts/add?id=<?php echo $vo['id'];?>">编辑</a>
						<a class="btn btn-xs btn-default " href="/one/<?php echo $vo['id'];?>">查看</a>
						<a class="btn btn-xs btn-danger auto_del" url="/admin/posts/del?id=<?php echo $vo['id'];?>">删除</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div><?php echo $html;?></div>

	</div>
</div>

 </div>
		</div>
		<!-- alert -->
        <div class="info-frontend"> </div>
		
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/static/cnavi/cnavi.js?v=1.0"></script>
		<script type="text/javascript" src="/static/admin/admin.js?v=1.0"></script>
	</body>
</html>
