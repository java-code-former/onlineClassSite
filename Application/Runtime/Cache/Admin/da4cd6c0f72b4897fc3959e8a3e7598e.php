<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link rel="shortcut icon" href="/Public/Admin/images/favicon.ico" />
<link href="/Public/Admin/css/css.css" type="text/css" rel="stylesheet" />
</head>
<!--框架样式-->
<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0">
<!--top样式-->
	<frame src="<?php echo U('/Admin/index/top');?>" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />
<!--contact样式-->
	<frameset id="attachucp" framespacing="0" border="0" frameborder="no" cols="194,12,*" rows="*">
		<frame scrolling="auto" noresize="" frameborder="no" name="leftFrame" src="<?php echo U('/Admin/index/left');?>"></frame>
		<frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="<?php echo U('/Admin/index/swich');?>"></frame>
		<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="<?php echo U('/Admin/index/main');?>"></frame>
	</frameset>
<!--bottom样式-->
	<frame src="<?php echo U('/Admin/index/bottom');?>" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset><noframes></noframes>
<!--不可以删除-->
</html>