<?php 
namespace Enad\Controller;
use Think\Controller;

class CommController extends CommonController {




	public function save(){
		if(IS_POST){
			$where['id']=$_POST['id'];
		    $data=M('activityintroduction')->where($where)->save($_POST);
			if($data){
			    //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
			    $this->success('修改成功', 'save');
			} else {
			    //错误页面的默认跳转页面是返回前一页，通常不需要设置
			    $this->error('修改失败');
			}
		}else{
			$data=M('activityintroduction')->where(['id'=>1])->find();
		    $this ->assign('data',$data);
			$this->display();
		}
	}
}
