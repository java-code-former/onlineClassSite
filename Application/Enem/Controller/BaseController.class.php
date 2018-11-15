<?php 
namespace Enem\Controller;
use Think\Controller;
class BaseController extends Controller {


	Public function _initialize()
	{
		
   		$list=M('Navigation')->where('is_show=1')->select();
         if(!empty($_SESSION['id']))
         {
            $user=M('user')->where('id='.$_SESSION['id'])->find();
            $this->assign('user',$user);
         }
   		$this->assign('d',$list);

	}


   public function is_login(){
      if(empty($_SESSION['id'])){
         $this->ajaxReturn(['data'=>'on'],'json');
      }
   }
}
