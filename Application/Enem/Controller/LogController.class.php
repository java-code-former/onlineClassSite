<?php
namespace Enem\Controller;
use Think\Controller;
class LogController extends BaseController{
   

	public  function reg()
	{
		$data=I('post.');
		unset($data['pwd']);
		$data['pw']=md5($data['pw']);
		$data['create']=time();
		//$data['img']=rand(1,4).'.jpg';
		$return=M('user')->add($data);
		if($return){
			$d=['data'=>'200'];
		}else{
			$d=['data'=>'100'];
		}
		$this->ajaxReturn($d);
	}

	/*资料修改*/
	public  function reg_p()
	{
		$data=I('post.');
		$return=M('user')->where('id='.$_SESSION['id'])->save($data);
		if($return){
			$d=['data'=>'200'];
		}else{
			$d=['data'=>'100'];
		}
		$this->ajaxReturn($d);
	}






	public  function name()
	{
		$data=I('post.name');
		$return=M('user')->where('name='.$data)->find();
		if($return){
			$d=['data'=>'200'];
		}else{
			$d=['data'=>'100'];
		}
		$this->ajaxReturn($d);
	}



	public  function loginname()
	{
		$data=I('post.');
		$where=[
			'name'=>$data['na'],
			'pw'=>md5($data['np']),
		];
		$return=M('user')->where($where)->find();
		if($return){
			session('id',$return['id']);
			$d=['data'=>'200'];
		}else{
			$d=['data'=>'100'];
		}
		$this->ajaxReturn($d);
		
	}





	public  function to()
	{

		session_destroy();
		$d=['data'=>'200'];
		$this->ajaxReturn($d);
	}


}

