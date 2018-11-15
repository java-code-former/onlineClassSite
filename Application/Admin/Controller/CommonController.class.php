<?php 
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	Public function _initialize()
	{
		if(empty(session('username'))){
			$this->redirect('/Admin/Login/login');
		}
	}
}
