<?php

namespace Common\Model;

use Think\Model;

class BladeModel extends Model
{

    protected $tableName = 'outstandingpro_pid';
    protected $tablePrefix = 'x_';



//    //推选优秀节目
//    public function pro($id)
//    {
//        $region = M('outstandingpro_pid')->table(['outstandingpro_pid' => 'c', 'x_outstandingprogram' => 'v'])
//            ->where('c.id=v.id AND c.id= '.$id)
//            ->select();
//        $nump = M('outstandingpro_pid')->table(['outstandingpro_pid' => 'c', 'x_outstandingprogram' => 'v'])
//            ->where('c.id=v.id AND c.id= '.$id)
//            ->count();
//
//        $num = $nump;
//        $count = $num / $page;
//        $page = new \Think\Page($num, $page);
//        $show = $page->show();
//        $data = [
//            'data' => $set,
//            'count' => $count,
//            'show' => $show,
//        ];
//            return $data;
//        $this -> assign('count',$count);
//        $this -> assign('pager',$page);
//        $this -> assign('voice',$list);
//    }




}








?>