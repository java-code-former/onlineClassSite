<?php
namespace Enem\Controller;
use Think\Controller;
class UseController extends BaseController{


    /*活 动 简介*/
    public   function  index()
    {
        $this -> assign('sp','光荣榜');
        $sql=M('excellentdeeds')->where('is_show=1')->limit(18)->select();
        $this ->assign('list',$sql);
        $this->display();
    }



/*头像*/
    public   function  img()
    {
        $this->display();
    }


/*密码*/
 	public   function  mima()
    {
        $this->display();
    }


/*作品*/
 	public   function  zp()
    {
        $this->display();
    }



/*点赞*/
 	public   function  link()
    {

        import ('ORG.Util.Page');
        $count = M('x_user_link')
            ->table(['x_outstandingprogram' => 't', 'x_user_link' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id']) -> count();
        $Page = new \Think\Page($count,8);
        $page = $Page -> show();
        $list = M('x_outstandingprogram')
            ->table(['x_outstandingprogram' => 't', 'x_user_link' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id'])
            ->order('v.add_time desc')
            ->field('t.id,t.img,t.title')
             -> limit($Page->firstRow.','.$Page->listRows)
             ->select();
        $this -> assign('count',$count);
        $this -> assign('pager',$page);
        $this -> assign('voice',$list);
        $this->display();
    }


 
/*评论*/
 	public   function  pl()
    {
        import ('ORG.Util.Page');
        $count = M('x_user_reviews')
            ->table(['x_outstandingprogram' => 't', 'x_user_reviews' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id']) -> count();
        $Page = new \Think\Page($count,8);
        $page = $Page -> show();
        $list = M('x_outstandingprogram')
            ->table(['x_outstandingprogram' => 't', 'x_user_reviews' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id'])
            ->order('v.add_time desc')
            ->field('t.id,t.title,v.content,v.add_time')
             -> limit($Page->firstRow.','.$Page->listRows)
             ->select();
        $this -> assign('count',$count);
        $this -> assign('pager',$page);
        $this -> assign('voice',$list);
        $this->display();
    }    


    /*投票*/
 	public   function  tp()
    {
        import ('ORG.Util.Page');
        $count = M('x_user_vote')
            ->table(['x_outstandingprogram' => 't', 'x_user_vote' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id'])
            ->distinct('v.uid')
            -> count();
        $Page = new \Think\Page($count,8);
        $page = $Page -> show();
        $list = M('x_outstandingprogram')
            ->table(['x_outstandingprogram' => 't', 'x_user_vote' => 'v','x_user'=>'u'])
            ->where('t.id=v.p_id AND v.is_show=1 AND t.is_show=1 AND  v.u_id=u.id AND u.id=' . $_SESSION['id'])
            ->distinct('v.uid')
            ->order('v.add_time desc')
            ->field('t.id,t.img,t.title')
             -> limit($Page->firstRow.','.$Page->listRows)
             ->select();

        $this -> assign('count',$count);
        $this -> assign('pager',$page);
        $this -> assign('voice',$list);
        $this->display();
    }    






    public function Commissionedshop()
    {
        if (IS_AJAX) {
            $data = $_POST;
            $pa['img'] = base64_upload($data['previewImg']);
            $if = M('user')->where(['id' => $_SESSION['id']])->save($pa);
            if ($if) {
                $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            } else {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }

            $this->ajaxReturn($data);
        }
    }



    /*修改密码*/
    public function mi()
    {
        if (IS_AJAX) {
            $data = $_POST;
            $if = M('user')->where(['id' => $_SESSION['id']])->find();
            if ($if['pw']==md5($data['name'])) {
                $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            } else {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }

            $this->ajaxReturn($data);
        }
    }



    /*修改密码*/
    public function newpw()
    {
        if (IS_AJAX) {
             $m=md5($_POST['pw']);
            $data =[
                'pw'=>$m
            ] ;
            $if = M('user')->where(['id' => $_SESSION['id']])->save($data);
            if ($if) {
                session_destroy();
                $data = [
                    'data' => '200',
                    'msg' => '提交成功，请耐心等待！'
                ];
            } else {
                $data = [
                    'data' => '400',
                    'msg' => '提交失败，请重试！'
                ];
            }

            $this->ajaxReturn($data);
        }
    }


}

