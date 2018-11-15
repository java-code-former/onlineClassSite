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
<div class="Ibanner">
    <div id="full-screen-slider">
        <ul id="slides">
            <li style="background:url('<?php echo ($lb["img1"]); ?>') no-repeat center top; background-size:cover; "></li>
            <li style="background:url('<?php echo ($lb["img2"]); ?>') no-repeat center top; background-size:cover; "></li>
            <li style="background:url('<?php echo ($lb["img3"]); ?>') no-repeat center top; background-size:cover; "></li>
        </ul>
    </div>
    <div class="clear"></div>
</div>

<div class="Ione">
    <div class="width1200">
        <div class="IObie">
            <div class="IOBtitle">
                <dl>
                    <dt><span>TECHNICAL FRONTIERS</span></dt>
                    <dd>技术前沿</dd>
                </dl>
            </div>
            <div class="IOBtwo">
                <?php if(is_array($gg)): $i = 0; $__LIST__ = array_slice($gg,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="IOBWleft left">
                        <div class="IOBWimg"><a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"><img
                                src="/Public/update/<?php echo ($vo["img"]); ?>" width="475"></a></div>
                        <div class="IOBWnei">
                            <dl>
                                <dt><a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"></a></dt>
                                <dd><a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["content"])),0,230,'utf-8')); ?>......</a>
                                </dd>
                            </dl>
                            <div class="IOBWbottom">
                                <a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"><img src="/Public/Home/images/m1.png"
                                                                                     width="18"></a>
                                <span>发布：<?php echo (date( "m月.d日",$vo["create"])); ?></span>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="IOBWright right">
                    <div class="IOBWlist">
                        <ul>
                            <?php if(is_array($gg)): $i = 0; $__LIST__ = array_slice($gg,1,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="margin:0;">
                                    <div class="left IBWLIdate">
                                        <dl>
                                            <dt><?php echo (date( "d",$vo["create"])); ?></dt>
                                            <dd><?php echo (date( "m",$vo["create"])); ?>月</dd>
                                        </dl>
                                    </div>
                                    <div class="right IBWLItext">
                                        <dl>
                                            <dt>
                                                <a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["title"])),0,30,'utf-8')); ?>......</a>
                                            </dt>
                                            <dd><a href="<?php echo U('/enem/New/i',array('id'=>$vo['id']));?>"><?php echo (mb_substr(strip_tags(htmlspecialchars_decode($vo["content"])),0,30,'utf-8')); ?>......</a>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="clear"></div>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <div class="IOBWmore"><a href="<?php echo U('/enem/New/index');?>">查看更多</a></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="Itwo">
    <div class="width1200">
        <div class="IWBtitle">
            <dl>
                <dt><span>TEACHING TEAM</span></dt>
                <dd>教学队伍</dd>
            </dl>
        </div>
        <div class="IWcnet">
            <div class="IWtable">
                <ul>
                    <?php if(is_array($tx)): $i = 0; $__LIST__ = $tx;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="data<?php echo ($vo["id"]); ?>" id="s_y_dang_<?php echo ($vo["id"]); ?>" onMouseOver="ai(<?php echo ($vo["id"]); ?>)"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="IWrong">
                <?php if(is_array($txdata)): $i = 0; $__LIST__ = $txdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="IWNlist" id="k1" style="float:left">
                        <ul>
                            <li style="margin-left:0;">
                                <div class="IWimg">
                                    <a href="<?php echo U('/Act/i',array('id'=>$vo['id']));?>">
                                        <img style="width:278px;height: 278px;" src="/Public/update/<?php echo ($vo["img"]); ?>"
                                             width="279">
                                    </a>
                                </div>
                                <div class="IWten" style="text-align: center">
                                    <dl>
                                        <dt><a href="<?php echo U('/Act/i',array('id'=>$vo['id']));?>"><?php echo ($vo["name"]); ?></a></dt>
                                    </dl>
                                </div>
                                <div class="IWten" style="text-align: center">
                                    <dl>
                                        <dd><a href="<?php echo U('/Act/i',array('id'=>$vo['id']));?>"><?php echo ($vo["ynum"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($vo["snum"]); ?></a>
                                        </dd>
                                    </dl>
                                </div>
                            </li>
                            <div class="clear">
                            </div>
                        </ul>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="Ithree">
    <div class="width1200">
        <div class="IOBtitle">
            <dl>
                <dt><span style="background:#f7f7f7;">LEARNING ROUTE</span></dt>
                <dd>学习路线</dd>
            </dl>
        </div>
        <div class="IHtitle">精通JavaEE平台开发的java软件工程师，能够胜任各种行业的企业级软件开发工作；</div>
        <div class="IHcent">
            <div><?php echo ($tion["bb"]); ?></div>
            <div class="clear"></div>
        </div>
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

<script>
    function ai(data) {
        var p = data;
        $.ajax({
            url: '<?php echo U("/new/forder");?>',
            type: 'post',
            data: {data: data},
            datatype: 'json',
            success: function (data) {
                var str = '';
                for (var key in data) {
                    str += '<div class="IWNlist" id="k1" style="float:left"><ul><li style="margin-left:0;"><div class="IWimg" ><a href="<?php echo U('/enem/Act/i',array('id'=>$vo['id']));?>"><img style="width:278px;height: 278px;" src="/Public/update/' + data[key]['img'] + '"" width="279"></a></div><div class="IWten" style="text-align: center" ><dl><dt><a href="<?php echo U('/enem/Act/i',array('id'=>$vo['id']));?>">' + data[key]['name'] + '</a></dt></dl></div><div class="IWten" style="text-align: center"><dl><dd><a href="<?php echo U('/enem/Act/i',array('id'=>$vo['id']));?>">' + data[key]['ynum'] + '&nbsp;&nbsp;&nbsp;&nbsp;' + data[key]['snum'] + '</a></dd></dl></div>li><div class="clear"></div></ul></div>';
                }
                $(".IWrong").html(str);
            }
        });
    }
</script>
</body>
</html>