<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 16:36
 */

namespace app\index\controller;


use app\index\model\Comment;
use app\index\model\Event;
use think\Db;

class Article extends Common
{
    /**
     * 案例列表
     */
    public function articleLists()
    {
        $list = Db::table('event')->where('is_del',0)->select();
        foreach ($list as $key => &$value)
        {
            $uid = $value['uid'];
//            halt($uid);
            $value['uid']=Db::table('users')->where('id',$uid)->value('nickname');
        }
        $this->assign('notelist',$list);
        return $this->fetch();
    }

//    案例查看
    public function article()
    {
//        $id = input('get.id');
        $id = 1;
        $info = Event::where('id',$id)->find();
        $uid = $info['uid'];
        $info['user'] = Db::table('users')->where('id',$uid)->value('nickname');
        unset($info['uid']);
//        $comm = Comment::where('eid', $id)->select();
        $comm = Db::table('comment')->where('eid', $id)->select();
        foreach ($comm as $k => &$v)
        {
            $v['uid'] = Db::table('users')->where('id', $v['uid'])->value('nickname');
        }
//        halt($comm);
        $this->assign(['info'=>$info,'comm'=>$comm]);
        return $this->fetch();
    }


//    案例编辑/修改
    public function modifyNote()
    {
        $uid = session('people')['id'];
        if (request()->isPost()){
            $today = input('post.');
            $id = $today['id'];
            $today['uid'] = $uid;
            $note = new Event();
            $modify = $note->allowField(true)->save($today,['id'=>$id]);
            if ($modify)
            {
                return '修改成功';
//                $this->success('修改成功','noteList');
            }else{
                return '修改失败';
//                $this->error('修改失败','noteList');
            }
        }
        $label = Labels::where('uid',$uid)->select();
        $id = input('get.id');
        $info = Event::where('id',$id)->find();
        $this->assign(['label'=>$label,'info'=>$info]);
        return $this->fetch();
    }
//    案例删除
    public function delNote()
    {
        $id = input('get.id');
        $note = Event::get($id);
        $sql = $note->delete();
        if ($sql)
        {
            return '删除成功';
        }else{
            return '删除失败';
        }
    }
}