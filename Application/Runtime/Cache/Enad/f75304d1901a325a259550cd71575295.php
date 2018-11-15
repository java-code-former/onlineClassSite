<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="/Public/Admin/css/css.css" type="text/css" rel="stylesheet" />
<link href="/Public/Admin/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="/Public/Admin/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(/Public/Admin/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(/Public/Admin/images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(/Public/Admin/images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：大分类管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <!-- <form method="post" action="">
	         <span>管理员：</span>
	         <input type="text" name="" value="" class="text-word">
	         <input name="" type="button" value="查询" class="text-but">
	         </form> -->
         </td>
  		  <td width="100%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="<?php echo U('add');?>" target="mainFrame" onFocus="this.blur()" class="add">新增大分类</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">名称</th>
        <!-- <th align="center" valign="middle" class="borderright">排序</th>
        <th align="center" valign="middle" class="borderright">是否显示</th> -->
        <th align="center" valign="middle">操作</th>
      </tr>
      <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="del<?php echo ($vo["id"]); ?>" onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
              <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["id"]); ?></td>
              <td align="center" valign="middle" class="borderright borderbottom"><?php echo ($vo["name"]); ?></td>
            <!--   <td align="center" valign="middle" class="borderright borderbottom">
                <input onblur="sort(<?php echo ($vo["id"]); ?>)" id="sort<?php echo ($vo["id"]); ?>" type="text" value="<?php echo ($vo["sort"]); ?>" name="" style="IME-MODE: disabled; WIDTH: 60px; HEIGHT: 15px" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" >
              </td> -->
<!--               <td style="background:#98FB98" id="is_show<?php echo ($vo["id"]); ?>" align="center" onclick="is_show(<?php echo ($vo["id"]); ?>)" valign="middle" class="borderright borderbottom"><?php echo $vo['is_show']==1?'是':'否';?></td> -->
              <td align="center" valign="middle" class="borderbottom">
                  <a href="<?php echo U('save',array('id'=>$vo['id']));?>" target="mainFrame" onFocus="this.blur()" class="add">【编辑】</a>
                <!--   <span class="gray">&nbsp;|&nbsp;</span>
                  <a   onclick="del(<?php echo ($vo["id"]); ?>)"  target="mainFrame" onFocus="this.blur()" class="add">【删除】</a> -->
                   <span class="gray">&nbsp;|&nbsp;</span>
                  <a href="<?php echo U('/Enad/species/index',array('id'=>$vo['id']));?>" target="mainFrame" onFocus="this.blur()" class="add">【查看成员】</a>
              </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </td>
  </tr>
</table>
</body>
</html>
<input type="hidden" name="" id="mysql" value="outstandingpro_pid">
<script src="/Public/Home/js/jquery-1.7.2.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/Public/Admin/js/enpuble.js"></script>