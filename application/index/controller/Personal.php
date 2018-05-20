<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 14:23
 */

namespace app\index\controller;


use think\Db;

class Personal extends Common
{
    public function index()
    {
        $type = session('people')['type'];
        $id = session('people')['id'];
//        获取用户信息
        if ( $type == 'user')
        {
            $own_info = Db::table('users')->where('id',$id)->find();
        }elseif ($type == 'lawyer')
        {
            $own_info = Db::table('lawyer')->where('id',$id)->find();
        }
        $this->assign('own',$own_info);
        return $this->fetch();
    }



    public function mine()
    {
        return $this->fetch();
    }

}