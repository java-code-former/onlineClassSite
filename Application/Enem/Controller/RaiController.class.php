<?php
namespace Enem\Controller;
use Think\Controller;
class RaiController extends BaseController{


    /*募集*/
    public   function  index()
    {
        $this -> assign('sp','课程评价');
        $sql = M('raise')->find();
        $this ->assign('list',$sql);
        $this->display();
    }








}

