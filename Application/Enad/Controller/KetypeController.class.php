<?php 
namespace Enad\Controller;
use Think\Controller;

class KetypeController extends CommonController {

	public function index(){
	    $data=M('ketype')->select();
	    $this ->assign('data',$data);
		$this->display();
	}



	public function save(){
		if(IS_POST){
			$where['id']=$_POST['id'];
					    $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      './Public/update/'; // 设置附件上传目录
                 // 上传文件 
            $info   =   $upload->upload();  

            if ($info['img'] != null)
            { 
                $_POST['img'] = $info['img']['savepath'].$info['img']['savename'];
            }
		    $data=M('ketype')->where($where)->save($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('修改成功', 'index');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('修改失败');
			}
		}else{
			$data=M('ketype')->where(['id'=>$_GET['id']])->find();
		    $this ->assign('data',$data);
			$this->display();
		}
	}


	public function add(){
		if(IS_POST){
			// $where['id']=$_POST['id'];
			$upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      './Public/update/'; // 设置附件上传目录
                 // 上传文件 
            $info   =   $upload->upload();  

            if ($info['img'] != null)
            { 
                $_POST['img'] = $info['img']['savepath'].$info['img']['savename'];
            }
		    $data=M('ketype')->add($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('添加成功', 'index');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('添加失败');
			}
		}else{
			// $data=M('ketype')->where(['id'=>$_GET['id']])->find();
		 //    $this ->assign('data',$data);
			$this->display();
		}
	}



}
