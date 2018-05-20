<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 9:38
 */

namespace app\manages\controller;



use think\Db;

class Filemanage extends Common
{
//    法律上传管理
    public function files()
    {
        $sql = Db::table('law')->where('is_del',0)->select();
        foreach ($sql as $key => &$value)
        {
            $value['uploader'] = Db::table('users')->where('id',$value['uploader'])->value('realname');
            $value['cateid'] = Db::table('category')->where('id',$value['cateid'])->value('cate_name');

        }
        $sum = count($sql);
        $this->assign('laws',$sql);
        $this->assign('sum',$sum);

        return $this->fetch();
    }

    //删除
    public function dels()
    {
        $ids = input('get.id');
        $sql = Db::table('law')->where('id',$ids)->update(['is_del'=>1]);
        $fils = Db::table('law')->where('id',$ids)->find();
        if ($fils['is_file'] <> null)
        {
            Db::table('lawfiles')->where('id',$fils['is_file'])->update(['is_del'=>1]);
        }
        if ($sql && $fils)
        {
            return '删除成功！';
        }else{
            return '删除失败！';
        }
    }

}