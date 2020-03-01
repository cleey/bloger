<?php
namespace home\controller;
use poem\more\page;

class index {

    function index() {
        // now
        $tb = m('posts')->order('id desc');
        if ($t = i('t')) {
            $tb->where(array('tags' => array('like', "%$t%")));
            assign('html_title', $t);
            assign('html_tags', $t);
        }
        $info = page::run($tb, '/home/index/index', 8, 10);
        $list = $info['list'];

        $this->sideinfo();
        assign('tp', $info['tp']);
        assign('list', $list);
        assign('html', $info['html']);
        v();
    }

    // 单片文章
    function one() {
        $id = i('id');
        if ($id == '') {
            $id = 1;
        }

        // now
        $data['id'] = $id;
        $now        = M('posts')->where($data)->find();

        // pv
        m('posts')->where($data)->set_increase('pv', 1);

        // pre
        $data['id'] = array('<', $id);
        if ($t = i('t')) {
            $data['tags'] = array('like', "%$t%");
            assign('html_title', $t);
            assign('html_tags', $t);
        }

        $next       = m('posts')->where($data)->order('id desc')->find();
        // next
        $data['id'] = array('>', $id);
        $pre        = m('posts')->where($data)->order('id asc')->find();

        $this->sideinfo();
        assign('html_title', $now['title']);
        assign('now', $now);
        assign('pre', $pre);
        assign('next', $next);
        v();
    }



    protected function sideinfo() {
        $list = m('posts')->field('id,thumbnail')->order('rand()')->limit(6)->select();
        assign('sideinfo', $list);

        $list = m('posts')->field('id,thumbnail')->order('pv desc')->limit(6)->select();
        assign('hotlist', $list);
    }
}
