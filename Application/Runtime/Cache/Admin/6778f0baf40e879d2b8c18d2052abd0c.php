<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="/Public/Admin/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/Public/Admin/js/sdmenu.js"></script>

<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(/Public/Admin/images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="/Public/Admin/images/main/member.gif" width="44" height="44" /></div>
    <span>用户：<?php echo $_SESSION['admin']['username']?><br>角色：超级管理员</span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
       <div class="collapsed">        
            <span>后台用户管理</span>
            <a href="<?php echo U('/Admin/Admin/index');?>" target="mainFrame" onFocus="this.blur()">后台用户管理          </a>
       </div>
        <div class="collapsed">
            <span>轮播图</span>
            <a href="<?php echo U('/Admin/img/img');?>" target="mainFrame" onFocus="this.blur()">轮播图</a>
        </div>
        <div class="collapsed">
            <span>课程类别</span>
            <a href="<?php echo U('/Admin/ketype/index');?>" target="mainFrame" onFocus="this.blur()">课程类别</a>
        </div>
       <div class="collapsed">
            <span>学校成员信息类别</span>
            <a href="<?php echo U('/Admin/Type/index');?>" target="mainFrame" onFocus="this.blur()">成员信息</a>
        </div>
        <div class="collapsed">
            <span>新闻</span>
            <a href="<?php echo U('/Admin/Protype/index');?>" target="mainFrame" onFocus="this.blur()">新闻列表</a>
        </div>
        <div class="collapsed">
            <span>联系我们</span>
            <a href="<?php echo U('/Admin/Category/save');?>" target="mainFrame" onFocus="this.blur()">联系我们</a>
        </div>
        <div class="collapsed">
            <span>教学大纲</span>
            <a href="<?php echo U('/Admin/Comm/save');?>" target="mainFrame" onFocus="this.blur()">教学大纲</a>
        </div>
        <div class="collapsed">
            <span>课程简介</span>
            <a href="<?php echo U('/Admin/Oc/save');?>" target="mainFrame" onFocus="this.blur()">课程简介</a>
        </div>
</body>
</html>