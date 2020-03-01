<?php
/**
 * 后台dashboard管理入口，统计一些文章、分类、标签信息
 */
namespace admin\controller;
class index extends base{
	public function index(){
		// 图片文章数
		$posts_num = m('posts')->count();
		assign('posts_num',$posts_num);

		$tags_num = m('terms')->field(['taxonomy'=>'tags'])->count();
		assign('tags_num',$tags_num);

		$classify_num = m('terms')->field(['taxonomy'=>'classify'])->count();
		assign('classify_num',$classify_num);

		v();
	}
}
