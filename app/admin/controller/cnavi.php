<?php
/**
 * 管理侧边栏条目，可自由增删改查侧边栏
 */
namespace admin\controller;
class cnavi extends base{

    public function index(){
        $list = m('cnavi')->order('pid,sort,id')->select();
        $list = array2tree($list, 0, 'pid');
        assign('navi_list',  $list);
        v();
    }

    // 添加memu
    public function memuadd(){
        $data = gp('id,url,img,title,pid',1);
        if( empty($data['pid']) )
            unset($data['pid']);

        if( empty($data['id']) ){
            unset($data['id']);
            $re = m('cnavi')->insert($data);
        }else
            $re = m('cnavi')->update($data);

        ok_jump('操作成功');
    }
    // 添加memu
    public function memudel(){
        $data['id'] = gp('id');
        if( empty($data['id']) ){ err_jump('删除失败') ;}
        $re = m('cnavi')->where($data)->delete();

        ok_jump('删除成功',POEM_CTRL_URL.'/index');
    }
    // memu排序
    public function memuSort(){
        $data = gp('str,pidstr',1);

        $tb_menu = m('cnavi');
        if( $data['str'] ){
            $str = explode(';', $data['str']);
            foreach ( $str as $v) {
                $v = explode('|', $v);
                $map = array();
                $map['id']   = $v[0];
                $map['sort'] = $v[1];
                $tb_menu->update($map);
            }
        }
        // 修改了的pid item
        if( $data['pidstr'] ){
            $str = explode(';', $data['pidstr']);
            foreach ( $str as $v) {
                $v = explode('|', $v);
                $map = array();
                $map['id']   = $v[0];
                $map['pid'] = $v[1];
                $tb_menu->update($map);
            }
        }

        ajax('reload');
    }
}
