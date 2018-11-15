<?php
namespace Enem\Controller;
use Think\Controller;
use Enem\Controller\BaseController;
class IndexController extends BaseController{

	public   function  index()
	{

	    /*轮播*/
	    $lb=M('img')->find();
	   
	    /*最新公告*/
	    $gg=M('lannouncement')->where('is_show=1')->order('view desc')->select();
	    // echo M('lannouncement')->_SQL();
	    /*推选优秀节目*/

	    $tx=M('outstandingpro_pid')->select();



	    /*推选优秀事迹*/
 		$sj=M('excellentdeeds')->where('is_show=1')->limit(5)->select();


		/*机构介绍*/
 		$jg=M('agencypresentation')->where('is_show=1')->limit(13)->select();


 		$txdata=M('outstandingprogram')->where('is_show=1 AND pid  =1')->order('sort asc')->limit(4)->select();


		$tion=M('activityintroduction')->where('id=1')->find();


 		/*合作单位*/
		$hz0=M('oc')->where('is_show=1 AND p=0')->select();
		$hz1=M('oc')->where('is_show=1 AND p=1')->select();
        $this->assign([
                'lb'=>$lb,
                'tion'=>$tion,
                'gg'=>$gg,
                'tx'=>$tx,
                'sj'=>$sj,
                'jg'=>$jg,
                'hz1'=>$hz1,
                'hz0'=>$hz0, 
                'txdata'=>$txdata,                   
            ]);

		$this->display();
	}










}

