<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 9:40
 */

namespace app\manages\controller;




use think\Db;

class Eventmanage extends Common
{
//    案例管理
    public function events()
    {
        $sql = Db::table('event')->where('is_del',0)->select();
        foreach ($sql as $key => &$value)
        {
            $value['uid'] = Db::table('users')->where('id',$value['uid'])->value('realname');
            $value['lid'] = Db::table('labels')->where('id',$value['lid'])->value('lab_name');
        }
        $sum = count($sql);
        $this->assign('events',$sql);
        $this->assign('sum',$sum);

        return $this->fetch();
    }


    //推荐
    public function push()
    {
        $ids = input('get.id');
        $sql = Db::table('event')->where('id',$ids)->update(['is_push'=>1]);
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
        $sql = Db::table('event')->where('id',$ids)->update(['is_del'=>1]);
        if ($sql)
        {
            return '删除成功！';
        }else{
            return '删除失败！';
        }
    }

}