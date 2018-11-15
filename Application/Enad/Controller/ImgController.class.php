<?php 
namespace Enad\Controller;
use Think\Controller;

class ImgController extends CommonController {
 //首页轮播
    public function img(){
        $img = M('img') -> find();
        $this -> assign('img',$img);
        $this -> display();
    }
  //修改首页轮播
    public function imgedit(){
        if($_POST){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =      './Public/update/'; // 设置附件上传目录
                 // 上传文件 
            $info   =   $upload->upload();  

            if ($info['img'] != null)
            { 
                $img = '/Public/update/'.$info['img']['savepath'].$info['img']['savename'];
            }

            foreach($info as $key =>$value){
                $img_url=M('img')->getField($key);

                unlink($_SERVER['DOCUMENT_ROOT'].$img_url);
                $img_data[$key]='/Public/update/'.$value['savepath'].$value['savename'];
            }
            // dd($img_data);exit;
            if(M('img') ->where('id=1')-> data($img_data) -> save() != null){
                  $this -> success('修改成功',U('enad/img/img'));
            }else{  
                  $this -> error ('修改失败');
            }
        }else{
             $this -> display('img');
        }
    }
}