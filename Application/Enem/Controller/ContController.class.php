<?php
namespace Enem\Controller;
use Think\Controller;
class ContController extends BaseController{


    /*联系我们*/
    public   function  index()
    {
        $this -> assign('sp','联系我们');
        $sql = M('lin')->find();
        $this ->assign('list',$sql);
        $this->display();
    }







}

