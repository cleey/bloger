<?php if (!defined('POEM_PATH')) exit();?><html>
<head>
	<meta charset='utf8'/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="sharehave,分享拥有,推荐趣事">
	<meta name="keywords" content="自然,人文">
	<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/static/home/home.css?v=1.2">
	<title> <?php echo $html_title ? $html_title : 'ShareHave'; ?> | 分享拥有</title>

	<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar" role="navigation">
	<div class="nav-more">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Sh</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">ShareHave</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav">
					<li> <a href="/home/index/index?t=自然"> 自然 </a> </li>
					<li> <a href="/home/index/index?t=人文"> 生活 </a> </li>
					<li> <a href="/home/index/index?t=人文"> 景观 </a> </li>
					<li> <a href="/home/index/index?t=人文"> 居住 </a> </li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</div>
</nav>
<div class="row body">
	<div class="col-md-8">
		
<?php if( $tag = i('t')  ){ ?>
<div class='tag'>标签：<?php echo $tag;?></div>
<?php } ?>

<?php foreach( $list as $v ){ ?>
<div class="grid">
	<div class="head">
    <?php
    $id = $v['id'];
    $url = "/one/".$id.".html";
    if( isset($html_tags) ) {
        $url .= "?t=$html_tags";
    }
    ?>
		<a class="title" href="<?php echo $url;?>">
			<?php echo $v['title'];?>
		</a>
		<div class="post_term">
			<i class="fa fa-book"></i><?php echo $v['classify'];?> 
			<i class="fa fa-tags"></i><?php echo $v['tags'];?>
			<i class="fa fa-eye"></i><?php echo $v['pv'];?>
		</div>
	</div>
	<a class="gitem" href="<?php echo $url;?>">
		<img class="gitem" src="<?php echo $v['thumbnail'];?>" title="<?php echo $v['title'];?>">
	</a>
    <div class="post-deco">
        <div class="hex hex-small">
            <div class="hex-inner"><i class="fa"></i></div>
            <a href="<?php echo $url;?>"> <i class="fa fa-bicycle" aria-hidden="true"></i> </a>
            <div class="corner-1"></div>
            <div class="corner-2"></div>
        </div>
    </div>
	<div class="post-content">
		<?php echo brief_introduce($v['content']);?>
	</div>
</div>
<?php } ?>
<?php echo $html;?>

		<div class="ads"></div>
	</div>
	<div class="col-md-4">
		<div class="sidebar">
			<h2>推荐标签</h2>
			<ul>
				<li><a href="/home/index/index?t=景观" style="color:#FD6E9F;">景观</a></li>
				<li><a href="/home/index/index?t=自然">自然</a></li>
				<li><a href="/home/index/index?t=创意">创意</a></li>
				<li><a href="/home/index/index?t=生活 style="color:#FD6E9F;"">生活</a></li>
				<li><a href="/home/index/index?t=灵感">灵感</a></li>
			</ul>
			<h2>热门标签</h2>
			<ul>
				<li><a href="/home/index/index?t=乡村" style="color:#FD6E9F;">乡村</a></li>
				<li><a href="/home/index/index?t=自然">自然</a></li>
				<li><a href="/home/index/index?t=居住 style="color:#FD6E9F;"">居住</a></li>
				<li><a href="/home/index/index?t=视觉">视觉</a></li>
				<li><a href="/home/index/index?t=绘画 style="color:#FD6E9F;"">艺术</a></li>
			</ul>

			<h2>热门推荐</h2>
			<div class="sideimg">
				<?php foreach( $hotlist as $v ){ ?>
				<a href="/one/<?php echo $v['id'];?>.html"><img src="<?php echo $v['thumbnail'];?>"></a>
				<?php } ?>	
			</div>

			<h2>猜你喜欢</h2>
			<div class="sideimg">
				<?php foreach( $sideinfo as $v ){ ?>
				<a href="/one/<?php echo $v['id'];?>.html"><img src="<?php echo $v['thumbnail'];?>"></a>
				<?php } ?>	
			</div>

		</div>
	</div>
</div>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- <div class="tongji">
</div> -->

</body>
</html>
