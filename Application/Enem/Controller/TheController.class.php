<?php
namespace Enem\Controller;
use Think\Controller;
class TheController extends BaseController{


    /*活 动 简介*/
    public   function  index()
    {
        $this -> assign('sp','课程内容');
        $sql=M('ketype')->where('is_show=1')->limit(18)->select();
        $this ->assign('list',$sql);
        $this->display();
    }



    public   function  info()
    {
        $this -> assign('sp','课程内容详情');
        $sql=M('ketype')->where('is_show=1 AND  id='.$_GET['id'])->find();
        $this ->assign('list',$sql);

        $erke=M('erke')->where('is_show=1 ')->select();
        $this ->assign('erke',$erke);


        $sanke=M('sanke')->where('is_show=1 ')->order('sort asc')->select();
        $this ->assign('sanke',$sanke);

        $sike=M('sike')->where('is_show=1 ')->order('id asc') ->select();
        foreach ($sike as $k => &$v) {
           $v['ppt']=$k+1;
        }
        $this ->assign('sike',$sike);

        $this->display();
    }


    /*活 动 简介*/
    public   function  ip()
    {
        $this -> assign('sp','课程内容详情');
        $gg=M('new')->where('is_show=1 AND pid='.$_GET['kp'])->find();
         $this->assign([
                'gg'=>$gg,
            ]);
         
        $this->display();
    }

}

