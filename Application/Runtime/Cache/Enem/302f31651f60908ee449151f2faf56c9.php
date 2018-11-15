<?php if (!defined('THINK_PATH')) exit();?><!--公共头部-->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>Wuhan University excellent course</title>
    <link rel="stylesheet" href="/Public/Home/css/style.css">
    <script src="/Public/Home/js/jquery-1.7.2.min.js"></script>
    <script class="resources library" src="/Public/Home/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.jslides.js"></script>
    <script class="resources library" src="/Public/Home/js/area.js" type="text/javascript"></script>
</head>
<body>
<div class="Itop">
    <div class="width1200" >
        <div class="left ITleft">Wuhan University to study in China -- curriculum design of Java course for English teaching brand courses</div>
        <div style="float: right;">
            <div class=" posirelative select-out-div">
                <select class="m-wrap  " id="status"  style="width: 150px; float:right;">
                    <option grade="1" value="1" >---American station</option>
                    <option grade="0" value="0" >---中国站</option>
                </select>
                <span class="select-hide-span"><b class="select-show-b"></b></span>
            </div>
        </div>
    </div>
</div>
<script type="text/JavaScript">
 $("select#status").change(function(){
     var zhi=$(this).val();
     if(zhi==0){
        window.location.href='/';
     }else{
        window.location.href="<?php echo U('/Enem/index/index');?>";
     }
 });
</script>
<style>
    .posirelative {
        position: relative;
    }

    .select-out-div {
        width: 160px;
        overflow: hidden;
        margin-top: 11px;
    }

    select.m-wrap {

        background-color: #ffffff;
        background-image: none !important;
        filter: none !important;
        border: 1px solid #e5e5e5;
        outline: none;
        height: 28px !important;
        line-height: 25px;
    }

    .select-hide-span {
        height: 25px;
        position: absolute;
        top: 0;
        border-right: 1px solid #e5e5e5;
        right: 0;
        width: 20px !important;
        z-index: 999;
    }

    .select-show-b {
        border-color: #888 transparent transparent transparent;
        border-style: solid;
        border-width: 5px 4px 0 4px;
        margin-left: -4px;
        margin-top: 10px;
        position: absolute;
    }
</style>
<div class="Iheader">
    <div class="width1200">
        <div class="left Ilogo"><a href="<?php echo U('/enem/index/index');?>"><img src="/Public/Home/images/logo.png" width="248"></a></div>
        <div class="right Inav">
            <a href="<?php echo U('/enem/index/index');?>"">Home</a>
            <?php if(is_array($d)): $i = 0; $__LIST__ = $d;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a
                <?php if($vo['id'] == 1): ?>href="<?php echo U('/Enem/Sha/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 2): ?>
                    href="<?php echo U('/Enem/Act/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 3): ?>
                    href="<?php echo U('/Enem/Int/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 4): ?>
                    href="<?php echo U('/Enem/The/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 5): ?>
                    href="<?php echo U('/Enem/Rai/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 6): ?>
                    href="<?php echo U('/Enem/New/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 7): ?>
                    href="<?php echo U('/Enem/Iwa/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 8): ?>
                    href="<?php echo U('/Enem/Cont/index',array('id'=>$vo['id']));?>"<?php endif; ?>
                ><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>


<!-- <a href="<?php echo U('/Activevideo');?>">活动视频</a>  机构介绍
<a href="<?php echo U('/Introduction');?>">活动简介</a>
<a href="<?php echo U('/Thehonorroll');?>">光荣榜</a>
<a href="<?php echo U('/Raise');?>">募集</a>
<a href="<?php echo U('/Newsinformation');?>">新闻资讯</a>
<a href="<?php echo U('/Iwanttosignup');?>">我要报名</a>
<a href="<?php echo U('/Contactus');?>">联系我们</a> -->
<div class="Nbanner">
    <div class="width1200">
        <div class="NBsit">
            <dl>
                <dt><?php echo ($sp); ?></dt>
                <dd><img src="/Public/Home/images/sit.png" width="19">当前位置：<a href="/enem/index/index">Home</a> > <a href="javascript:;"><?php echo ($sp); ?></a>
                </dd>
            </dl>
        </div>
    </div>
</div>
<style>
    .m {
        width: 740px;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 100px;
    }
</style>
<div class="NYbig">
    <div class="width1200">

        <div class="XGone">
            <?php echo (htmlspecialchars_decode($gg["content"])); ?>
        </div>


    </div>
</div>
<div class="Ifooter">
    <div class="width1200">
        <div class="left IFOleft">
            <div class="IFLnav">
                <a href="<?php echo U('/act/index/id/2.M');?>" style="padding-left:0;">教学队伍</a>|
                <a href="<?php echo U('/act/index/id/6.M');?>">技术前沿</a>|
                <a href="<?php echo U('/act/index/id/8.M');?>">联系我们</a>
                <div class="clear"></div>
            </div>
            <div class="IFLtext">
                武汉大学版权所有<br>
                投稿邮箱：bdcclab@sina.com<br>
                Copyright©2015, 武汉大学大数据与云计算实验室. All rights reserved.
            </div>
        </div>
        <div class="right IFOright">
            <dl>
                <dt><img src="/Public/Home/images/er.png" width="117"></dt>
                <dd>官方二维码</dd>
            </dl>
            <dl>
                <dt><img src="/Public/Home/images/er1.png" width="117"></dt>
                <dd>微信公众号</dd>
            </dl>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

</body>
</html>

<!-- 验证是否登录 -->
<script type="text/javascript">
    function verificationUserData() {
        $.ajax({
            url: "<?php echo U('/Home/log/is_login');?>",
            type: "POST",
            success: function (data) {
                if (data.data == 'on') {
                    $('.cd-popup').addClass('is-visible');
                }
            }
        });
    }
</script>>