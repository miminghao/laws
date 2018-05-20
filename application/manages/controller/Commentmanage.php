<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 9:41
 */

namespace app\manages\controller;



use think\Db;

class Commentmanage extends Common
{
//    评论管理
//    案例评论管理
    public function comments()
    {
        $sql = Db::table('comment')->where('is_del',0)->select();
        foreach ($sql as $key => &$value)
        {
            $value['uid'] = Db::table('users')->where('id',$value['uid'])->value('realname');
            $value['eid'] = Db::table('event')->where('id',$value['eid'])->value('title');
        }
        $sum = count($sql);
        $this->assign('comms',$sql);
        $this->assign('sum',$sum);
        return $this->fetch();
    }
    //推荐
    public function push()
    {
        $ids = input('get.id');
        $sql = Db::table('comment')->where('id',$ids)->update(['is_push'=>1]);
        if ($sql)
        {
            return '推荐成功！';
        }else{
            return '推荐失败！';
        }
    }
    //删除
    public function dels()
    {
        $ids = input('get.id');
        $sql = Db::table('comment')->where('id',$ids)->update(['is_del'=>1]);
        if ($sql)
        {
            return '删除成功！';
        }else{
            return '删除失败！';
        }
    }

//    律师案例管理
    public function lwycoms()
    {
        $sql = Db::table('case')->select();
        foreach ($sql as $key => &$value)
        {
            $value['uid'] = Db::table('users')->where('id',$value['uid'])->value('realname');
            $value['lawyer'] = Db::table('lawyer')->where('id',$value['lawyer'])->value('realname');

            $value['category'] = Db::table('category')->where('id',$value['category'])->value('cate_name');
        }
        $sum = count($sql);
        $this->assign('case',$sql);
        $this->assign('sum',$sum);
        return $this->fetch();
    }

    //删除
    public function delcase()
    {
        $ids = input('get.id');
        $sql = Db::table('case')->where('id',$ids)->delete();
        if ($sql)
        {
            return '删除成功！';
        }else{
            return '删除失败！';
        }
    }


}