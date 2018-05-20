<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 9:39
 */

namespace app\manages\controller;



use think\Db;

class Usermanage extends Common
{

//    用户管理
    public function users()
    {
//        halt(session('name'));
        $sql = Db::table('users')->where('is_del',0)->select();
        $sum = count($sql);
        $this->assign('users',$sql);
        $this->assign('sum',$sum);
        return $this->fetch();
    }
    //禁言/解禁
    public function prohibit()
    {
        $input = input('post.id');
        $sql = Db::table('users')->where('id',$input)->value('is_prohibit');
        if ($sql == 0)
        {
            $sqls = Db::table('users')->where('id',$input)->update(['is_prohibit'=>1]);
        }elseif($sql == 1){
            $sqls = Db::table('users')->where('id',$input)->update(['is_prohibit'=>0]);

        }
        if ($sqls)
        {
            return '成功！';
        }else{
            return '失败！';
        }
    }
    //删除
    public function delusers()
    {
        $ids = input('get.id');
        $sql = Db::table('users')->where('id',$ids)->update(['is_del'=>1]);
        if ($sql)
        {
            return '删除成功！';
        }else{
            return '删除失败！';
        }
    }

//    律师管理
    public function lawyers()
    {
        $sql = Db::table('lawyer')->where('is_del',0)->select();
        $sum = count($sql);
        $this->assign('sum',$sum);
        $this->assign('lawyer',$sql);
        return $this->fetch();
    }

    //点通过
    public function states_adopt ()
    {
        $ids = input('get.id');
        $sql = Db::table('lawyer')->where('id',$ids)->update(['state'=>1]);
    }
    //点驳回
    public function states_reject ()
    {
        $ids = input('get.id');
        $sql = Db::table('lawyer')->where('id',$ids)->update(['state'=>2]);
    }
    //点禁言
    public function states_gag ()
    {
        $ids = input('get.id');
        $sql = Db::table('lawyer')->where('id',$ids)->update(['state'=>3]);
    }
    //点解禁
    public function states_relieve ()
    {
        $ids = input('get.id');
        $sql = Db::table('lawyer')->where('id',$ids)->update(['state'=>1]);
    }
    //点删除
    public function dellawyers ()
    {
        $ids = input('get.id');
        $sql = Db::table('lawyer')->where('id',$ids)->update(['is_del'=>1]);
    }


}