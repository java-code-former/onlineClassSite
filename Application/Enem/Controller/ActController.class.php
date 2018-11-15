<?php
namespace Enem\Controller;
use Think\Controller;
class ActController extends BaseController{
   

	public   function  index()
	{
    import ('ORG.Util.Page');
    $p=$_GET['ppt']?$_GET['ppt']:1;
    $count = M('outstandingprogram')->where('pid='.$p) -> count();
    $Page = new \Think\Page($count,12);
    $page = $Page -> show();
    $list = M('outstandingprogram')->where('pid='.$p) -> order('sort desc') -> limit($Page->firstRow.','.$Page->listRows)->select();
    $this -> assign('count',$count);
    $this -> assign('pager',$page);
    $this -> assign('voice',$list);
    $this -> assign('sp','教学队伍');
    $voicep = M('outstandingprogram')->order('sort desc')->limit(4)->select(); 
    $this -> assign('voicep',$voicep);
    $this -> display();
	}




	/*新闻info*/
	public   function  i()
	{
         $this -> assign('sp','教学队伍');
		$gg=M('outstandingprogram')->where('is_show=1 AND id='.$_GET['id'])->find();

        $count = M('x_outstandingprogram')
            ->table(['x_outstandingprogram' => 't', 'x_user_reviews' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND t.id=' . $_GET['id']) -> count();
        $Page = new \Think\Page($count,8);
        $page = $Page -> show();
        $list = M('x_outstandingprogram')
            ->table(['x_outstandingprogram' => 't', 'x_user_reviews' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND t.id=' . $_GET['id'])
            ->order('v.add_time desc')
            ->field('u.img,u.name,v.content,v.add_time')
             -> limit($Page->firstRow.','.$Page->listRows)
             ->select();
        $this -> assign('count',$count);
        $this -> assign('pager',$page);
        $this -> assign('voice',$list);





		 $this->assign([
                'gg'=>$gg,
            ]);
		$this->display();
	}



    /*点赞*/
    public function zan()
    {
        if (IS_AJAX) {
            $data = $_POST;
            $gg=M('user_link')->where('u_id='.$_SESSION['id'].' AND p_id='.$data['data'])->find();
            if($gg)
            {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }else{
                $pa['u_id']=$_SESSION['id'];
                $pa['p_id']=$data['data'];
                $pa['add_time']=time();
                $if = M('user_link')->add($pa);
                addviews($mysql='outstandingprogram',$star_id='id', $id=$data['data'], $field='like_num'); 
                 $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            }
           
            $this->ajaxReturn($data);
        }
    }


    /*投票*/
    public function tp()
    {
        if (IS_AJAX) {
            $t = time();
            $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
            $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
            $data = $_POST;

            $map['add_time'] =  array(array('gt',$start),array('lt',$end));
            $map['u_id']  =  $_SESSION['id'];
            $map['p_id']  =  $data['data'];

            $gg=M('user_vote')->where($map)->count();
            if($gg>=5)
            {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }else{
                $pa['u_id']=$_SESSION['id'];
                $pa['p_id']=$data['data'];
                $pa['add_time']=time();
                $if = M('user_vote')->add($pa);
                addviews($mysql='outstandingprogram',$star_id='id', $id=$data['data'], $field='vote_num'); 
                 $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            }
           
            $this->ajaxReturn($data);
        }
    }



    /*评论*/
    public function pl()
    {
        if (IS_AJAX) {
            $data = $_POST;
            $pa['u_id']=$_SESSION['id'];
            $pa['p_id']=$data['id'];
            $pa['add_time']=time();
            $pa['content']=$data['content'];
            $gg=M('user_reviews')->add($pa);
            if(!$gg)
            {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }else{
                 $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            }
            $this->ajaxReturn($data);
        }
    }





}

