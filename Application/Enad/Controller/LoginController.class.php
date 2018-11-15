<?php 
namespace Enad\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {

public function login(){
    if($_POST){
        $pt=$_POST['password'];//密码
        $name=$_POST['name'];//用户名
        $code=$_POST['code'];//验证码
       
        $quename=M('admin')->where(['username'=>$name])->find();
        if(empty($pt) || empty($code) || empty($name) || $code=='验证码:' ){
            echo '<script>alert("信息不能为空！！！");parent.location.href="login"</script>';
            exit;
        }        
 
        if(empty($quename)){
            echo '<script>alert("用户不存在！！！");parent.location.href="login"</script>';
            exit;
        }
        if(md5($pt) != $quename['password']){
            echo '<script>alert("密码错误！！！");parent.location.href="login"</script>';
            exit;
        }
        if(!$this->check($code)){
            echo '<script>alert("图像验证码错误！！！");parent.location.href="login"</script>';
            exit;
        }
          session('name',$name);
            echo '<script>alert("登录成功！！！");parent.location.href="/Enad/index/index"</script>';
    }
    	   $this->display();
}
//修改密码
    public function edit(){
      if($_POST){
       $sql_pwd = $_SESSION['admin']['password'];
       $pwd = MD5($_POST['password']);
       $pwd1 = MD5($_POST['password1']);
       $pwd2 = MD5($_POST['password2']);
      
       if($sql_pwd == $pwd){
          if($pwd1 == $pwd2){
             if($pwd1 != $pwd){
              $a = M('admin') -> where('id='.$_SESSION['admin']['id']) -> setField('password',$pwd1);
              if($a){ 
                  echo '密码修改成功,请重新登陆';
                  die;
                //$this -> success('密码修改成功,请重新登陆',U('Login/index'));
              }else{
                  echo '修改密码失败,请重新修改';
                  die;
                //$this -> error('修改密码失败,请重新修改',U('Login/reg'));
              }
             }else{ 
                  echo '新密码不能与旧密码相同，请重新设置';
                  die;
                //$this -> error('新密码不能与旧密码相同，请重新设置',U('Login/reg'));
             }
          }else{  
                  echo '您输入的两次新密码不相同，请重新输入';
                  die;
                //$this -> error('您输入的两次新密码不相同，请重新输入',U('Login/reg'));
          }

       }else{
                   echo '修改失败,您输入的旧密码不正确,请重新输入';
                   die;
                //$this -> error('修改失败,您输入的旧密码不正确,请重新输入',U('Login/reg'));
       }
          
        // var_dump($sql_pwd);
        }
          $this -> display();
    }
public function logout(){
        session('[destroy]');  
        $this -> success('退出成功！',U('/Enad/login/login'));
    }





//修改排序
  public  function sort()
  {
  
    $where['id']=$_POST['id'];
    $save['sort']=$_POST['sort'];
    $mysql=$_POST['mysql'];
    $return=M("$mysql")->where($where)->save($save);
    
    if($return){
      $d=['data'=>'200'];
    }else{
      $d=['data'=>'100'];
    }
    $this->ajaxReturn($d);
  }



//修改是否显示
  public  function is_show()
  {
  
    $where['id']=$_POST['id'];
    $save['is_show']=$_POST['sort'];
    $mysql=$_POST['mysql'];
    $return=M("$mysql")->where($where)->save($save);
    // echo  M('type')->_SQL();exit;
    if($return){
      $d=['data'=>'200'];
    }else{
      $d=['data'=>'100'];
    }
    $this->ajaxReturn($d);
  }


//修改是否显示
  public  function is_kai()
  {
  
    $where['id']=$_POST['id'];
    $save['is_kai']=$_POST['sort'];
    $mysql=$_POST['mysql'];
    $return=M("$mysql")->where($where)->save($save);
    // echo  M('type')->_SQL();exit;
    if($return){
      $d=['data'=>'200'];
    }else{
      $d=['data'=>'100'];
    }
    $this->ajaxReturn($d);
  }

  public  function zd()
  {
  
    $where['id']=$_POST['id'];
    $save['is_top']=$_POST['sort'];
    $mysql=$_POST['mysql'];
    $return=M("$mysql")->where($where)->save($save);
    // echo  M('type')->_SQL();exit;
    if($return){
      $d=['data'=>'200'];
    }else{
      $d=['data'=>'100'];
    }
    $this->ajaxReturn($d);
  }


//删除
  public  function del()
  {
  
    $where['id']=$_POST['id'];
    $mysql=$_POST['mysql'];
    $return=M("$mysql")->where($where)->delete();
    // echo  M('type')->_SQL();exit;
    if($return){
      $d=['data'=>'200'];
    }else{
      $d=['data'=>'100'];
    }
    $this->ajaxReturn($d);
  }



   public function verify()
     {
         $config = [
             'fontSize' => 19, // 验证码字体大小
             'length' => 4, // 验证码位数
             'imageH' => 34
         ];
         $Verify = new Verify($config);
         $Verify->entry();
     }


 public function check($code, $id = '')
     {
         $verify = new \Think\Verify();
         $res = $verify->check($code, $id);
         if ($res) {
            return true;
        } else {
            return false;
        }
     }

}