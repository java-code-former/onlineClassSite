<?php
namespace Home\Controller;
use Think\Controller;
class NewController extends BaseController{
   

	public   function  index()
	{
		   $voice = M('lannouncement')->select(); 
           import ('ORG.Util.Page');
           $count = M('lannouncement') -> count();
           $Page = new \Think\Page($count,5);
           $page = $Page -> show();
           $list = M('lannouncement') -> order('id desc') -> limit($Page->firstRow.','.$Page->listRows)->select();
           $this -> assign('count',$count);
           $this -> assign('pager',$page);
           $this -> assign('voice',$list);
           $this -> assign('sp','技术前沿');
      	   $this -> display();
	}


	/*新闻info*/
	public   function  i()
	{
		$gg=M('lannouncement')->where('is_show=1 AND id='.$_GET['id'])->find();
		 $this->assign([
                'gg'=>$gg,
            ]);
		/*浏览量+1*/
		addviews($mysql='lannouncement',$star_id='id', $id=$_GET['id'], $field='view'); 
		$this->display();
	}







	/*滑动取数据  首页*/
	public   function  forder()
	{
			$list= M('outstandingprogram')
						   ->where('is_show=1 AND  pid='.$_POST['data'])
						   ->order('SORT desc')
						   ->limit(4)
						   ->select(); 
			$this->ajaxReturn($list,'json');
	}



}

