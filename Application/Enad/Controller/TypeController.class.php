<?php 
namespace Enad\Controller;
use Think\Controller;

class TypeController extends CommonController {

	public function index(){
	    $data=M('outstandingpro_pid')->select();
	    $this ->assign('data',$data);
		$this->display();
	}



	public function save(){
		if(IS_POST){
			$where['id']=$_POST['id'];
		    $data=M('outstandingpro_pid')->where($where)->save($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('修改成功', 'index');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('修改失败');
			}
		}else{
			$data=M('outstandingpro_pid')->where(['id'=>$_GET['id']])->find();
		    $this ->assign('data',$data);
			$this->display();
		}
	}

	public function add(){
		if(IS_POST){
			// $where['id']=$_POST['id'];
		    $data=M('outstandingpro_pid')->add($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('添加成功', 'index');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('添加失败');
			}
		}else{
			// $data=M('outstandingpro_pid')->where(['id'=>$_GET['id']])->find();
		 //    $this ->assign('data',$data);
			$this->display();
		}
	}



}
