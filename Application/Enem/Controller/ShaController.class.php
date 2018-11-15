<?php
namespace Enem\Controller;
use Think\Controller;
class ShaController extends BaseController{
   

	public   function  index()
	{
		 		/*合作单位*/
		$hz0=M('oc')->where('id=1')->find();
        $this->assign([
                'hz1'=>$hz0	,
            ]);
		$this -> assign('sp','课程简介');
		$this->display();
	}








}

