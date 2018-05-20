<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2018/3/14
 * Time: 17:28
 */

namespace app\index\controller;


use app\index\model\Labels;
use think\Db;

class Files extends Common
{
    public function upload()
    {
        $this->addArticle();
        $this->getCates();
        return $this->fetch();
    }

    //法律标签获取
    public function getCates()
    {
        $sql = Db::table('category')->select();
//        halt($sql);
        $this->assign('cats',$sql);
    }

    //    案例添加
    public function addArticle()
    {
//        $uid = session('people')['id'];
        $uid = 1;
        if (request()->isPost()){
            $today = input('post.');
            $today['uid'] = $uid;
            $note = new Event();
            $add = $note->allowField(true)->save($today);
            if ($add)
            {
                return '添加成功';
//                $this->success('添加成功','Files/upload');
            }else{
                return '添加失败';
//                $this->error('添加失败','Files/upload');
            }
        }
        $label0 = Labels::where('cats',0)->select();
        $label1 = Labels::where('cats',1)->select();
        $this->assign(['label'=>$label0,'labels'=>$label1]);
    }

    public function uploadLaw()
    {
        $info = input('post.');
        $fid = $this->uploads();
        $sqls = Db::table('law')->insert([
           'uploader' => 1,
            'law_title' => $info['law_title'],
            'content' => $info['content'],
            'category' => 1,                  //这里应该是自己选择的
            'is_file' => $fid
        ]);

        if ($sqls)
        {
            $this->success('上传成功！','Files/upload');
        }
        else{
            $this->error('上传失败！','Files/upload');
        }
    }

    public function uploads()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('files');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'laws');
            if($info){
                // 成功上传后 获取上传信息
                // 文件类型
                $type = $info->getExtension();
                // 文件路径
                $routs = $info->getSaveName();
                // 现在存储的文件名（长的）
                $news = $info->getFilename();

                $infos = $info->getInfo();
                // 源文件名
                $name = $infos['name'];
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }

            $sql = Db::table('lawfiles')->insertGetId([
                'uid' => 1,
                'filename' => $name,
                'rous' => $routs,
                'type' => $type,
                'nowname' => $news
            ]);
            if (!$sql)
            {
                $this->error('上传失败！','Files/upload');
            }else{
                return $sql;
            }
        }
    }
}