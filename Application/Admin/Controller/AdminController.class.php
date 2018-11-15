<?php 
namespace Admin\Controller;
use Think\Controller;

class AdminController extends CommonController {

	public function index(){
	    $data=M('admin')->select();
	    foreach ($data as $key => &$value) {
	    	$value['tn']=M('type')->where(['id'=>$value['type']])->getField('name');
	    } 
	    $this ->assign('data',$data);
		$this->display();
	}



	public function save(){
		if(IS_POST){
            if($_POST['t']==1){
                $where['id']=$_POST['id'];
                $data=$_POST;
                $data=M('admin')->where($where)->save($data);
                if($data){
                    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                    $this->success('用户名修改成功', 'index');
                } else {
                    //错误页面的默认跳转页面是返回前一页，通常不需要设置
                    $this->error('修改失败');
                }
            }else{
                $where['id']=$_POST['id'];
                $where['password']=md5($_POST['jp']);

                if(M('admin')->where($where)->select()){
                     if($_POST['xp']!==$_POST['qp']){
                         $this->error('修改失败,新密码和确认密码不一致');
                     }else{
                         $data=M('admin')->where('id='.$_POST['id'])->save(['password'=>MD5($_POST['qp'])]);
                         if($data){
                             //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                             $this->redirect('密码修改成功', '/Admin/Login/login');
                         } else {
                             //错误页面的默认跳转页面是返回前一页，通常不需要设置
                             $this->error('修改失败');
                         }
                     }
                }else{
                    $this->error('修改失败,原密码错误');
                }

            }
		}else{
			$data=M('admin')->where(['id'=>$_GET['id']])->find();
			$data['tn']=M('type')->where(['id'=>$data['type']])->getField('name');
		    $this ->assign('data',$data);
		    $this ->assign('t',$_GET['t']);
			$this->display();
		}
	}

	public function add(){
		if(IS_POST){
		    $data=M('admin')->add($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('添加成功', 'index');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('添加失败');
			}
		}else{
			$this->display();
		}
	}



}
