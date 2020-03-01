$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    setHeight();
})

// 菜单展现
$(document).on('click','.wd-menu > li > a',toggleCmenu );

function toggleCmenu(){
    var aim = $(this).children('i.ri');
    if( aim.hasClass('fa-angle-up') ){
        aim.removeClass('fa-angle-up');
        aim.addClass('fa-angle-down');
        $(this).next().slideUp();
        $(this).parent().removeClass('active');
    }else{
        $('.wd-menu > li.active > a').each(function(){
            tmp = $(this).children('i.ri');
            tmp.removeClass('fa-angle-up');
            tmp.addClass('fa-angle-down');
            $(this).next().slideUp();
            $(this).parent().removeClass('active');
        });
        aim.removeClass('fa-angle-down');
        aim.addClass('fa-angle-up');
        $(this).next().slideDown();
        $(this).parent().addClass('active');
    }
}

// 设置侧边栏和主体一样的高度
function setHeight(){
    var cside = $('.cbody .cside').css('height');
    var cmain = $('.cbody .cmain').css('height');
    cside = Number(cside.substring(0,cside.length - 2));
    cmain = Number(cmain.substring(0,cmain.length - 2));
    var tmp = cside > cmain ? cside : cmain;
    $('.cbody .cside').css('min-height',tmp);
    $('.cbody .cmain').css('min-height',tmp);
}

// 公用删除条目
function delInfo(o){
	var url = o.o.attr('url');
	if( confirm('确认删除该条目') ){
		location.href = url;
	}
}


//下面用于多图片上传预览功能
function setImagePreviews(avalue) {
    var docObj = document.getElementById("doc");
    var dd = document.getElementById("dd");
    dd.innerHTML = "";
    var fileList = docObj.files;
    for (var i = 0; i < fileList.length; i++) {            

        dd.innerHTML += "<div style='float:left' > <img id='img" + i + "'  /> </div>";
        var imgObjPreview = document.getElementById("img"+i); 
        if (docObj.files && docObj.files[i]) {
            //火狐下，直接设img属性
            imgObjPreview.style.display = 'block';
            // imgObjPreview.style.width = '150px';
            // imgObjPreview.style.height = '180px';
            //imgObjPreview.src = docObj.files[0].getAsDataURL();
            //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
            imgObjPreview.src = window.URL.createObjectURL(docObj.files[i]);
        }
        else {
            //IE下，使用滤镜
            docObj.select();
            var imgSrc = document.selection.createRange().text;
            alert(imgSrc)
            var localImagId = document.getElementById("img" + i);
            //必须设置初始大小
            // localImagId.style.width = "150px";
            // localImagId.style.height = "180px";
            //图片异常的捕捉，防止用户修改后缀来伪造图片
            try {
                localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
            }
            catch (e) {
                alert("您上传的图片格式不正确，请重新选择!");
                return false;
            }
            imgObjPreview.style.display = 'none';
            document.selection.empty();
        }
    }  

    return true;
}


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
		url  : '/story/admin/index/memuSort',
		param: {str:str,pidstr:pidstr}
	}
	ccAjax(obj);
}