<?php
namespace Home\Controller;
use Think\Controller;
class IntController extends BaseController{
   
    /*活 动 简介*/
	public   function  index()
	{
        $this -> assign('sp','教学大纲');
        $sql = M('activityintroduction')->find();
        $this ->assign('list',$sql);
		$this->display();
	}








}

