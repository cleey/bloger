<?php
/**
 * 发布的文章管理
 */
namespace admin\controller;
class posts extends base {
	public function index() {
		$qiniu = config('QINIU_CDN');
		$source = config('IMG_PATH');

		$tb = m('posts')->order('id desc');
		if ($t = i('t')) {
			$tb->where(array('tags' => array('like', "%$t%")));
		}

		$page = new \poem\more\page();
		$info = $page->run($tb, '/admin/posts/index', 15);
		$list = $info['list'];
		foreach ($list as $k => $v) {
			$list[$k]['thumbnail'] = $qiniu . $v['thumbnail'];
			$list[$k]['content'] = str_replace($source, $qiniu . $source, $v['content']);
		}

		assign('tp', $info['tp']);
		assign('list', $list);
		assign('html', $info['html']);
		v();
	}
	public function add() {
		if($id = i('id')) {
			$post = m('posts')->id($id);
			assign('post',$post);
		}
		v();
	}
	public function save() {
		$id = i('id');
		$info = gp('content,title,classifys,tags');
		if( $id ){
			m('posts')->where(['id' => $id])->update($info);
		}else{
			m('posts')->insert($info);
		}
		ok_jump('操作成功');
	}

	public function del() {
		$id = gp('id');
		m('posts')->where(['id' => $id])->delete();
		ok_jump('操作成功');
	}
}
