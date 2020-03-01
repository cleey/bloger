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
			<div class="cmain col-md-10"> <style>
.my-classify{
  font-size: 13px;
  position: relative;
}
.my-classify ul{ padding: 0!important;margin:0;}
.my-classify li,.my-classify li.sortable-placeholder{
  list-style-type: none;
  border: 1px solid transparent;
  width: 400px;
}
.my-classify li div{
  cursor: all-scroll;
  padding-left: 10px;
  line-height: 30px;
  min-height: 32px;
  width: 400px;
  text-shadow: 0 1px 0 #fff;
  background: #f1f1f1;
  margin: 2px 0;
}
.my-classify li div a{margin: 8px 5px 0 0;}
.my-classify li.sortable-placeholder{
  background: #fff;
  border: 1px dashed #A59F9F;
}
</style>
<div class="panel panel-default">
    <div class="panel-heading">后台菜单管理</div>
    <div class="panel-body">
        <div class="col-md-9">
            <ul class="my-classify">
                <?php foreach( $navi_list as $vo ){ ?>
                <li class="tree-child" dt-id="<?php echo $vo['id'];?>" dt-pid="<?php echo $vo['pid'];?>" class="checkbox">
                    <div>
                        <i class="fa fa-<?php echo $vo['img'];?>"></i> <?php echo $vo['title'];?> - <small><?php echo $vo['url'];?></small>
                        <a class="fr btn btn-default btn-xs auto_del" url="/admin/cnavi/memudel/id/<?php echo $vo['id'];?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                        <?php if( $vo['pid'] == 0 ){ ?>
                            <a href="javascript:void(0)" class="fr btn btn-default btn-xs ccc" f="menu_add_modal" pid="<?php echo $vo['id'];?>"> <i class="fa fa-plus"></i> </a>
                        <?php } ?>

                        <a href="javascript:void(0)" class="fr btn btn-default btn-xs ccc" f="menu_upd_modal" title="<?php echo $vo['title'];?>" img="<?php echo $vo['img'];?>" url="<?php echo $vo['url'];?>" id="<?php echo $vo['id'];?>"> <i class="fa fa-edit"></i> </a>
                    </div>
                    <ul></ul>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-default ccc" f="menu_add_modal" pid="0"> 添加菜单 </button>
            <button type="button" class="btn btn-default ccc" f="saveMenuSort"> 保存排序 </button>
            <hr>
            <div class="alert alert-success">只会展示两级排序内的元素</div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="memuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">添加菜单</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="/admin/cnavi/memuadd" method="POST">
                    <!-- 有id 代表编辑 -->
                    <input type="hidden" name="id" value=""> 
                    <!-- 有pid 代表添加 -->
                    <input type="hidden" name="pid" value="0">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">图片</label>
                        <div class="col-sm-10">
                            <input type="text" name="img" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">菜单名称</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">url</label>
                        <div class="col-sm-10">
                            <input type="text" name="url" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">保存</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="http://www.cleey.com/Public/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
$(function(){
    // select2tree( $('#categoryModal .parent') );

    var tmp_off_set = 40;
    aim2tree( $('.my-classify'),tmp_off_set ); // 生成树

    // jquery
    $('.my-classify').sortable( { 
        // revert : 100, //表示你移到了一个大致的地方，会在0.3秒内缓慢移动到精确的位置；
        placeholder: "sortable-placeholder", // 移动时临时位置的class
        start:  function(event, ui){
            var lvl = Number(ui.item.attr('lvl'));
            // 把和本元素相同的lvl的元素两者之间的元素加入本元素ul
            var flag = 0;
            ui.item.nextAll().each(function(){
                if( flag == 1 || $(this).hasClass('sortable-placeholder') ){ return; }
                var tmplvl = Number( $(this).attr('lvl') );
                if( tmplvl <= lvl ){ flag = 1; return;}
                ui.item.children('ul').append( $(this).andSelf() ); // 添加子元素
                $(this).css('margin-left',(tmplvl-lvl)*tmp_off_set );  // 相对拖动元素距离
            })

            // 拖拽框高度
            var l = ui.item.find('ul li').length + 1; // 子元素个数+1
            var h = ui.item.height();
            $('.sortable-placeholder').css('height',h*l);
        },
        // 拖动的过程会一直触发这个操作
        sort: function(event, ui){
            var lvl = tmpGetPostion(ui); // 获取动态位置
            $('.sortable-placeholder').css('margin-left',lvl * tmp_off_set); // 设置临时位置
        },
        beforeStop: function( event, ui ) {
            var px = $('.sortable-placeholder').css('margin-left');
            ui.item.css( 'margin-left' , px ); // 更新位置
            px = px.split('px');
            var lvl = parseInt(Number(px[0])/tmp_off_set);
            ui.item.attr('plus_lvl', lvl - Number(ui.item.attr('lvl')) ); // 更新位置
            ui.item.attr( 'lvl' ,  lvl); // 更新位置
        },
        stop: function(event, ui) {
            // 设置父ID
            var pid = 0;
            var lvl = Number( ui.item.attr('lvl') );
            // 找pid -- 前面有同胞 
            if( ui.item.prev().length > 0 ){
                var tmpflag = 0;
                ui.item.prevAll().each(function(){
                    if( tmpflag == 1 ){ return;}
                    // 等级相同
                    var tmplvl = Number( $(this).attr('lvl') );
                    if( tmplvl == (lvl - 1) ){ pid = $(this).attr('dt-id'); tmpflag = 1;return; }
                    if( tmplvl == lvl ){ pid = $(this).attr('dt-pid'); tmpflag = 1;return; }
                })
            }
            ui.item.attr('dt-pid',pid);

            // 将下级放好
            var plus_lvl = Number( ui.item.attr('plus_lvl') );
            ui.item.find('ul li').each(function(){
                var mylvl = Number( $(this).attr('lvl') );
                var tmplvl= mylvl+ plus_lvl;
                $(this).attr('lvl',tmplvl);
                $(this).css('margin-left' , tmplvl*tmp_off_set);
                // CO( plus_lvl+'-'+mylvl+'-'+tmplvl+'-'+$(this).attr('dt-id') );
            })
            ui.item.after( ui.item.find('ul li') );
        }
    } );

    // 获取动态位置
    function tmpGetPostion(ui){
        var left = ui.position.left;
        var a_id = ui.item.attr('dt-id');

        var offset = tmp_off_set;
        var max_lvl = 0;
        var min_lvl = 0;

        // 获取前一个元素 最大值
        var aim = $('.sortable-placeholder').prev();
        if( aim.attr('dt-id') == a_id ){ aim = aim.prev(); } // 获取
        if( aim.hasClass('tree-child') ){
            max_lvl = Number( aim.attr('lvl') ) + 1;
        }else{ return 0; }

        // 获取后一个元素 最小值
        var aim = $('.sortable-placeholder').next();
        if( aim.attr('dt-id') == a_id ){ aim = aim.next(); } // 获取
        if( aim.hasClass('tree-child') ){
            min_lvl = Number( aim.attr('lvl') );
        }

        // 计算应该返回区间之类的数
        left = parseInt( left / offset ) +  Number( ui.item.attr('lvl') ) ;  // 当前偏移量
        // CO(left + ' - '+ min_lvl + ' - ' + max_lvl );
        if( left <= min_lvl ){ return min_lvl; }
        if( left >= max_lvl){ return max_lvl; }
        return left;
    }

})


// 编辑菜单
function menu_upd_modal(o){
    var obj = {
        id: o.o.attr('id'),
        pid: '',
        url: o.o.attr('url'),
        img: o.o.attr('img'),
        title: o.o.attr('title'),
    }
    initMenuModal(obj);
    $('#memuModal .modal-title').html('编辑菜单');
    $('#memuModal').modal({backdrop: 'static', keyboard: false});
    $('#memuModal .modal-body input[name=title]').focus();
}
// 添加菜单
function menu_add_modal(o){
    var obj = { id: '', pid: o.o.attr('pid'), url: '', img: '', title: '', }
    initMenuModal(obj);

    $('#memuModal .modal-title').html('添加菜单');
    $('#memuModal').modal({backdrop: 'static', keyboard: false});
    $('#memuModal .modal-body input[name=title]').focus();
}

function initMenuModal(obj){
    $('#memuModal .modal-body input[name=id]').val(obj.id);
    $('#memuModal .modal-body input[name=pid]').val(obj.pid);
    $('#memuModal .modal-body input[name=url]').val(obj.url);
    $('#memuModal .modal-body input[name=img]').val(obj.img);
    $('#memuModal .modal-body input[name=title]').val(obj.title);
}

function saveMenuSort(){
    var sort = 1;
    var str  = ''; // id 排序
    var pidstr=''; // id 修改 pid
    $('.my-classify li').each(function(){
        str+= $(this).attr('dt-id') + '|' + sort++ +';';
        if( $(this).attr('plus_lvl') != undefined ){
            pidstr += $(this).attr('dt-id') + '|' + $(this).attr('dt-pid') +';';
        }
    })
    var obj ={
        url  : '/home/cnavi/memuSort',
        param: {str:str,pidstr:pidstr}
    }
    ccAjax(obj);
}
</script> </div>
		</div>
		<!-- alert -->
        <div class="info-frontend"> </div>
		
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/static/cnavi/cnavi.js?v=1.0"></script>
		<script type="text/javascript" src="/static/admin/admin.js?v=1.0"></script>
	</body>
</html>
