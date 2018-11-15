<?php
namespace Enem\Controller;
use Think\Controller;
class IwaController extends BaseController{
   

	public   function  index()
	{
		$this -> assign('sp','我要报名');
		$this->display();
	}


	public  function iwa()
	{
		$data=$_POST;
		dd($data);
		$data['o']=time();
		$return=M('bm')->add($data);
		if($return){
			$d=['data'=>'200'];
		}else{
			$d=['data'=>'100'];
		}
		$this->ajaxReturn($d);
	}





}

