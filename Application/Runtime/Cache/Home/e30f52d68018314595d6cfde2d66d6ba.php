<?php if (!defined('THINK_PATH')) exit();?><!--公共头部-->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>武汉大学精品课程</title>
    <link rel="stylesheet" href="/Public/Home/css/style.css">
    <script src="/Public/Home/js/jquery-1.7.2.min.js"></script>
    <script class="resources library" src="/Public/Home/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/Public/Home/js/jquery.jslides.js"></script>
    <script class="resources library" src="/Public/Home/js/area.js" type="text/javascript"></script>
</head>
<body>
<div class="Itop">
    <div class="width1200">
        <div class="left ITleft">武汉大学来华留学-英语授课品牌课程Java程序课程设计</div>
        <div style="float: right;">
            <div class=" posirelative select-out-div">
                <select class="m-wrap  " id="status"  style="width: 180px; padding: 2px 0;">
                    <option grade="0" value="0" >---中国站</option>
                    <option grade="1" value="1" >---American station</option>
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
        <div class="left Ilogo"><a href="<?php echo U('/');?>"><img src="/Public/Home/images/logo.png" width="248"></a></div>
        <div class="right Inav">
            <a href="<?php echo U('/');?>"">首页</a>
            <?php if(is_array($d)): $i = 0; $__LIST__ = $d;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a
                <?php if($vo['id'] == 1): ?>href="<?php echo U('/Sha/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 2): ?>
                    href="<?php echo U('/Act/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 3): ?>
                    href="<?php echo U('/Int/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 4): ?>
                    href="<?php echo U('/The/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 5): ?>
                    href="<?php echo U('/Rai/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 6): ?>
                    href="<?php echo U('/New/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 7): ?>
                    href="<?php echo U('/Iwa/index',array('id'=>$vo['id']));?>"
                    <?php elseif($vo['id'] == 8): ?>
                    href="<?php echo U('/Cont/index',array('id'=>$vo['id']));?>"<?php endif; ?>
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
                <dd><img src="/Public/Home/images/sit.png" width="19">当前位置：<a href="#">首页</a> > <a href="#"><?php echo ($sp); ?></a>
                </dd>
            </dl>
        </div>
    </div>
</div>

<div class="NYbig">
    <div class="width1200">
        <div class="LXWMbig">
            <div class="left LXWMleft">
                <ul>
                    <li><img src="/Public/Home/images/LX1.png" width="32">电话：<?php echo ($list["aa"]); ?></li>
                    <li><img src="/Public/Home/images/LX2.png" width="32">地址：<?php echo ($list["b"]); ?> </li>
                    <li><img src="/Public/Home/images/LX3.png" width="32">邮编：<?php echo ($list["c"]); ?>  </li>
                    <li><img src="/Public/Home/images/LX4.png" width="32">传真：<?php echo ($list["d"]); ?></li>
                    <li><img src="/Public/Home/images/LX5.png" width="32">邮箱：<?php echo ($list["e"]); ?></li>
                </ul>
            </div>
            <div class="right LXWMright">
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
                    <meta name="keywords" content="百度地图,百度地图API，百度地图自定义工具，百度地图所见即所得工具"/>
                    <meta name="description" content="百度地图API自定义地图，帮助用户在可视化操作下生成百度地图"/>
                    <title>百度地图API自定义地图</title>
                    <!--引用百度地图API-->
                    <style type="text/css">
                        html, body {
                            margin: 0;
                            padding: 0;
                        }

                        .iw_poi_title {
                            color: #CC5522;
                            font-size: 14px;
                            font-weight: bold;
                            overflow: hidden;
                            padding-right: 13px;
                            white-space: nowrap
                        }

                        .iw_poi_content {
                            font: 12px arial, sans-serif;
                            overflow: visible;
                            padding-top: 4px;
                            white-space: -moz-pre-wrap;
                            word-wrap: break-word
                        }
                    </style>
                    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
                </head>

                <body>
                <!--百度地图容器-->
                <div style="width:697px;height:550px;border:#ccc solid 1px;" id="dituContent"></div>
                </body>
                <script type="text/javascript">
                    //创建和初始化地图函数：
                    function initMap() {
                        createMap();//创建地图
                        setMapEvent();//设置地图事件
                        addMapControl();//向地图添加控件
                        addMarker();//向地图中添加marker
                    }

                    //创建地图函数：
                    function createMap() {
                        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                        var point = new BMap.Point(114.363173, 30.533742);//定义一个中心点坐标
                        map.centerAndZoom(point, 17);//设定地图的中心点和坐标并将地图显示在地图容器中
                        window.map = map;//将map变量存储在全局
                    }

                    //地图事件设置函数：
                    function setMapEvent() {
                        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                        map.enableKeyboard();//启用键盘上下左右键移动地图
                    }

                    //地图控件添加函数：
                    function addMapControl() {
                        //向地图中添加缩放控件
                        var ctrl_nav = new BMap.NavigationControl({
                            anchor: BMAP_ANCHOR_TOP_LEFT,
                            type: BMAP_NAVIGATION_CONTROL_LARGE
                        });
                        map.addControl(ctrl_nav);
                        //向地图中添加缩略图控件
                        var ctrl_ove = new BMap.OverviewMapControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1});
                        map.addControl(ctrl_ove);
                        //向地图中添加比例尺控件
                        var ctrl_sca = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
                        map.addControl(ctrl_sca);
                    }

                    //标注点数组
                    var markerArr = [{
                        title: "武汉大学",
                        content: "湖北省武汉市武昌区武汉大学国际软件学院",
                        point: "114.365194|30.535079",
                        isOpen: 0,
                        icon: {w: 21, h: 21, l: 0, t: 0, x: 6, lb: 5}
                    }
                    ];
                    //创建marker
                    function addMarker() {
                        for (var i = 0; i < markerArr.length; i++) {
                            var json = markerArr[i];
                            var p0 = json.point.split("|")[0];
                            var p1 = json.point.split("|")[1];
                            var point = new BMap.Point(p0, p1);
                            var iconImg = createIcon(json.icon);
                            var marker = new BMap.Marker(point, {icon: iconImg});
                            var iw = createInfoWindow(i);
                            var label = new BMap.Label(json.title, {"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20)});
                            marker.setLabel(label);
                            map.addOverlay(marker);
                            label.setStyle({
                                borderColor: "#808080",
                                color: "#333",
                                cursor: "pointer"
                            });

                            (function () {
                                var index = i;
                                var _iw = createInfoWindow(i);
                                var _marker = marker;
                                _marker.addEventListener("click", function () {
                                    this.openInfoWindow(_iw);
                                });
                                _iw.addEventListener("open", function () {
                                    _marker.getLabel().hide();
                                })
                                _iw.addEventListener("close", function () {
                                    _marker.getLabel().show();
                                })
                                label.addEventListener("click", function () {
                                    _marker.openInfoWindow(_iw);
                                })
                                if (!!json.isOpen) {
                                    label.hide();
                                    _marker.openInfoWindow(_iw);
                                }
                            })()
                        }
                    }
                    //创建InfoWindow
                    function createInfoWindow(i) {
                        var json = markerArr[i];
                        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
                        return iw;
                    }
                    //创建一个Icon
                    function createIcon(json) {
                        var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
                            imageOffset: new BMap.Size(-json.l, -json.t),
                            infoWindowOffset: new BMap.Size(json.lb + 5, 1),
                            offset: new BMap.Size(json.x, json.h)
                        })
                        return icon;
                    }

                    initMap();//创建和初始化地图
                </script>
                </html>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<!--公共底部-->
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