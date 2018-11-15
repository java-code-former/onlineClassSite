<?php
namespace Enad\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public function _initialize()
    {
//        Session::delete('name');
        if(empty($_SESSION['name'])){
             $this->redirect('/Enad/login/login');
        }
    }
}
