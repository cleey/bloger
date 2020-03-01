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
			<div class="cmain col-md-10"> <!-- simditor -->
<link href="/static/simditor/styles/font-awesome.css"  rel="stylesheet"/>
<link href="/static/simditor/styles/simditor.css"  rel="stylesheet"/>

<script src="/static/simditor/scripts/jquery.min.js" ></script>
<script src="/static/simditor/scripts/module.min.js" ></script>
<script src="/static/simditor/scripts/uploader.min.js" ></script>
<script src="/static/simditor/scripts/simditor.min.js" ></script>

<!-- datetimepicker -->
<link href="/static/datetimepicker/bootstrap-datetimepicker.min.css"  rel="stylesheet"/>
<script src="/static/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="/static/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>

<div class="panel panel-default">
	<div class="panel-heading">编辑博文  <?php if( $post ){ ?> - 正在编辑id <?php echo $post['id'];?><?php } ?></div>
	<div class="panel-body">
		<form action="/admin/posts/save">

			<div class="write-body left">
				<input type="text" class="form-control auto-param mb20" name="title" placeholder="标题" value="<?php echo $post['title'];?>">

				<div class="write-content">
					<textarea class="post_content auto-param" name="content" p="文章内容"><?php echo htmlspecialchars($post['content']);?></textarea>
				</div>

			</div>

			<div class="write-sidebar left">
				
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">分类</h3>
					</div>
					<div class="panel-body">
						<input type="text" name="tags" class="form-control" placeholder="英文逗号 ,  隔开多个分类">
					</div>
				</div>

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">标签</h3>
					</div>
					<div class="panel-body">
						<input type="text" name="classifys" class="form-control" placeholder="英文逗号 ,  隔开多个标签">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">发布时间</div>
						<input class="form-control auto-param" name="date" p="发布时间">
					</div>
				</div>
				
				<div class="write-submit">
					<button type="submit" class="btn btn-success">发布博文</button>
				</div>
			</div>

		</form>
	</div>
</div>



<script type="text/javascript">
var editor = new Simditor({
  	textarea: $('.post_content'),
	upload:{
	    url: '/blog/ajax_upload_blog_img',
	    placeholder: '在这里输入文字 ~ ~',
	    pasteImage: true,
	    defaultImage: 'image/cleey_blog.png',
	    fileKey: 'file',
	    params: null,
	    connectionCount: 3,
	    leaveConfirm: '正在上传文件，如果离开上传会自动取消'
	}
});
$(function(){
	aim2tree( $('.blog-write-classify') );
	$('input[name=date]').datetimepicker({
		language: 'zh-CN',
		format: 'yyyy-mm-dd hh:ii'
	});
})
</script>

 </div>
		</div>
		<!-- alert -->
        <div class="info-frontend"> </div>
		
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/static/cnavi/cnavi.js?v=1.0"></script>
		<script type="text/javascript" src="/static/admin/admin.js?v=1.0"></script>
	</body>
</html>
