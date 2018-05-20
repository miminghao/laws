<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 16:30
 */

namespace app\index\controller;


use app\index\model\Comment;
use app\index\model\Event;

class Comments extends Common
{
    public function index()
    {
        return '评论';
    }

    /**
     * 评论列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function comList()
    {
        $a = new Comment();
        $list = $a->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 评论添加
     * @return mixed|string
     */
    public function addCom()
    {
        $uid = session('people')['id'];
        if (request()->isPost()){
            $now = input('post.');
            $now['uid'] = $uid;
            $comm = new Event();
            $add = $comm->allowField(true)->save($now);
            if ($add)
            {
                return '添加成功';
//                $this->success('添加成功','noteList');
            }else{
                return '添加失败';
//                $this->error('添加失败','noteList');
            }
        }
        return $this->fetch();
    }

    /**
     * 评论修改
     * @return mixed|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function modifyCom()
    {
        $uid = session('people')['id'];
        if (request()->isPost()){
            $now = input('post.');
            $now['uid'] = $uid;
            $com = new Event();
            $modify = $com->allowField(true)->save($now);
            if ($modify)
            {
                return '添加成功';
//                $this->success('添加成功','noteList');
            }else{
                return '添加失败';
//                $this->error('添加失败','noteList');
            }
        }
        $id = input('get.id');
        $info = Comment::where('id',$id)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 评论删除
     * @return string
     * @throws \think\exception\DbException
     */
    public function delCom()
    {
        $id = input('get.id');
        $com = Comment::get($id);
        $sql = $com->delete();
        if ($sql)
        {
            return '删除成功';
        }else{
            return '删除失败';
        }
    }

}