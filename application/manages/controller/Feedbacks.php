<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/19
 * Time: 14:58
 */

namespace app\manages\controller;


use think\Db;

class Feedbacks extends Common
{
//    反馈管理
    public function feedback()
    {
        $sql = Db::table('feedback')->select();
        foreach ($sql as $key => &$value)
        {
            $value['uid'] = Db::table('users')->where('id',$value['uid'])->value('realname');
        }
        $sum = count($sql);
        $this->assign('fbs',$sql);
        $this->assign('sum',$sum);

        return $this->fetch();
    }
}