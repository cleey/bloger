<?php
/**
 * 公共（全局）函数库
 */

function brief_introduce($str, $len=150) {
	echo mb_substr(strip_tags($str), 0, $len, 'utf-8');
}

function menuList(){
	$re = m('cnavi')->order('pid,sort,id')->select();
	$list = array2deep($re,0,'pid');
	return $list;
}

function array2deep($list,$fid = 0,$keyfid){
	$arr = array();
	if( !empty($list) ){
		foreach ($list as $v) {
			if ( $fid == $v[$keyfid] ) {  // 该任务有子任务
				$child = array2tree( $list,$v['id'], $keyfid ); // 查找子任务的子任务
				$arr[] = array('p'=>$v,'c'=>$child);
			}
		}
	}
	return $arr;
}

// 数组转换树形
function array2tree($list,$fid = 0,$keyfid){
	$arr = array();
	foreach ($list as $v) {
		if ( $fid == $v[$keyfid] ) {  // 该任务有子任务
			$tmp = array2tree( $list,$v['id'], $keyfid ); // 查找子任务的子任务
			$tmp === array() ? $v['type'] = 'file': $v['type']='parent' ;
			$arr[] = $v;
			$arr = array_merge( $arr, $tmp );
		}
	}
	return $arr;
}

// 七牛API 调用
// QiniuApi($_SERVER['DOCUMENT_ROOT'].config('IMG_PATH').'2011/12/02/01.jpg','test.jpg');
// $filePath 要上传文件的本地路径 $_SERVER['DOCUMENT_ROOT'].'/static/3.jpg';
// $key_fn 上传到七牛后保存的文件名 '/2015/09/36/01.jpg';
function QiniuApi($filePath, $key_fn){
	Vendor('qiniu/autoload');

	// 需要填写你的 Access Key 和 Secret Key
	$cfg = config('QiNiu');
	$auth = new \Qiniu\Auth($cfg['accessKey'], $cfg['secretKey']); // 构建鉴权对象
	$token = $auth->uploadToken($cfg['bucket']); // bucket上传的空间 生成上传 Token
	
	// 初始化 UploadManager 对象并进行文件的上传。
	$uploadMgr = new \Qiniu\Storage\UploadManager();
	return $uploadMgr->putFile($token, $key_fn, $filePath);
}

/* 存储图片
	$data['url']   = "static/image/user/";  // 存储路径
	$data['size']  = 1*1024*1024;   // 文件大小
	$data['allow'] = array("gif", "jpeg", "jpg", "png");  // 可上传的后缀名
	$data['filename'] = $id;
	$return  = R( "Clin/clin_upload_file",array($data) );
	// 更新图片
	if( $return['code'] == 1){
		$u = D('Users');
		$u->set_my_img($id,$return['filename']);
	echo "<script>parent.callback('".$return['code']."','".$return['info']."')</script>";
*/

/**
 * @cc 上传文件函数
 * @param  [type] $url         [存储地址]
 * @param  [type] $size        [限制大小]
 * @param  [type] $allowedExts [允许后缀]
 * @return [type]              [返回数组] info url ，code 1 成功 0失败，filename文件名
 */
function fileUpload($data,$cutFlag=1){
	
	foreach ($data as $k => $v) {
		if( empty($v) ){ return array('code'=> '0','info'=> '参数不能为空：'.$k); }
	}
	if( !is_dir($data['url']) ){ return array('code'=> '0','info'=> '路径错误：'.$data['url']); }

	$temp = explode(".", $_FILES["file"]["name"]);
	$ext = end($temp);
	// 文件过大
	if ( $_FILES["file"]["size"] > $data['size'] ){
		$return = array('code'=> '0','info'=> '文件过大：'.$_FILES["file"]["size"].'，请上传小于：'.$data['size']);
	}
	// 不允许后缀
	elseif( !in_array($ext, $data['allow']) ){
		$return = array('code'=> '0','info'=> '不允许后缀：'.$ext.'请上传：'.implode(',',$data['allow']) );
	}else{
		if ($_FILES["file"]["error"] > 0){
			$return =array('code'=> '0','info'=> "Return Code: " . $_FILES["file"]["error"]);
		}
		else{
			if( !$data['filename'] ){ 
				// $data['filename'] = Date('YmdHis').'_'.$_FILES["file"]["name"];
				$data['filename'] = Date('YmdHis').'_'.uniqid().'.'.$ext;
			}
			$newfile_url = $data['url'].$data['filename'];
			move_uploaded_file($_FILES["file"]["tmp_name"],$newfile_url);
			$return = array('code'=> '1','filename'=>$data['filename'],'info'=> '/'.$newfile_url);
			// 截取文件
			if( $cutFlag ){ cutPhoto($newfile_url,$newfile_url,100,100); }
		}
	}
	return $return;
}

/**
 * 	@cc 压缩图片
 *	$url 原图路径 
 *	$tourl 处理后图片路径
 *	$width    定义宽 
 *	$height   定义高 
 * 	调用方法   cutphoto("test.jpg","temp.jpg",256,146); 
 */ 
function cutPhoto($url,$tourl,$width,$height){ 
	$img_affix = explode('.',$url);
	$img_affix = end($img_affix);
	switch ($img_affix) { 
		case "jpg" : $temp_img = imagecreatefromjpeg ( $url ); break; 
		case "jpeg" : $temp_img = imagecreatefromjpeg ( $url ); break; 
		case "png" : $temp_img = imagecreatefrompng ( $url ); break; 
		case "gif" : $temp_img = imagecreatefromgif ( $url ); break;
		default: return;
	}
	// $temp_img = imagecreatefromjpeg($url); 
	$o_width   = imagesx($temp_img);                                 //取得原图宽 
	$o_height = imagesy($temp_img);                                 //取得原图高 
	//判断处理方法 
	if($width>$o_width || $height>$o_height){         //原图宽或高比规定的尺寸小,进行压缩 
		$newwidth=$o_width; 
		$newheight=$o_height; 

		if($o_width>$width){ 
			$newwidth=$width; 
			$newheight=$o_height*$width/$o_width; 
		} 

		if($newheight>$height){ 
			$newwidth=$newwidth*$height/$newheight; 
			$newheight=$height; 
		} 
		//缩略图片 
		$new_img = imagecreatetruecolor($newwidth, $newheight); 
		imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height); 
		imagejpeg($new_img , $tourl);                 
		imagedestroy($new_img); 
	}else{                                                                                 //原图宽与高都比规定尺寸大,进行压缩后裁剪 
		if($o_height*$width/$o_width>$height){         //先确定width与规定相同,如果height比规定大,则ok 
			$newwidth=$width; 
			$newheight=$o_height*$width/$o_width; 
			$x=0; 
			$y=($newheight-$height)/2; 
		}else{                                                                         //否则确定height与规定相同,width自适应 
			$newwidth=$o_width*$height/$o_height; 
			$newheight=$height; 
			$x=($newwidth-$width)/2; 
			$y=0; 
		} 
		//缩略图片 
		$new_img = imagecreatetruecolor($newwidth, $newheight);

		imagecopyresampled($new_img, $temp_img, 0, 0, 0, 0, $newwidth, $newheight, $o_width, $o_height); 
		imagejpeg($new_img , $tourl);                 
		imagedestroy($new_img); 

		$temp_img = imagecreatefromjpeg($tourl); 
		$o_width   = imagesx($temp_img);                                 //取得缩略图宽 
		$o_height = imagesy($temp_img);                                 //取得缩略图高 
		//裁剪图片 
		$new_imgx = imagecreatetruecolor($width,$height); 
		imagecopyresampled($new_imgx,$temp_img,0,0,$x,$y,$width,$height,$width,$height); 
		imagejpeg($new_imgx , $tourl); 
		imagedestroy($new_imgx); 
	} 

}

// 上传图片
function imgFileUpload(){
	$path = 'static/upload/'.date('Y_m').'/';
	if( !is_dir($path) )
	    mkdir($path);
	$data['url']   = $path;  // 存储路径
    $data['size']  = 1024*1024*2;   // 文件大小
    $data['allow'] = array("gif", "jpeg", "jpg", "png");  // 可上传的后缀名
    $return = fileUpload($data,0);
    return $return;
}
