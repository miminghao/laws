<?php
namespace app\index\controller;


use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
//        return '这是个严肃而逗比的地方';
        $this->getLawyer();
        $this->getArticle();
        $this->getLaws();
        return $this->fetch();
    }

    /**
     * 热门法律
     */
    public function getLaws()
    {
        $laws = Db::table('law')->order('see', 'desc')->limit(5)->select();
        $this->assign('laws',$laws);
    }

    /**
     * 高评律师
     */
    public function getLawyer()
    {
        $lawyer = Db::table('lawyer')->order('gross', 'desc')->limit(5)->select();
        $this->assign('lay',$lawyer);
//        halt($lawyer);
    }

    /**
     * 热门帖子
     */
    public function getArticle()
    {
        $event = Db::table('event')->order('likes', 'desc')->limit(5)->select();
        $this->assign('art',$event);
    }
}
