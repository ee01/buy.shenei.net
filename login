<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><!-- saved from url=(0027)http://buy.shenei.net/login --><meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link rel="shortcut icon" href="favicon.ico" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base  />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>用户登陆 - 舍内团秒(buy.shenei.net)</title>
<meta name="Keywords" content=",舍内团秒" />
<meta name="Description" content="," />
<script type="text/javascript">
var thisSiteURL = './';
</script>
<link rel="shortcut icon" href="favicon.ico" />
<link href="templates/default/styles/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="templates/default/js/jquery.js"></script>
<script language="javascript" src="templates/default/js/main.js"></script>
</head>
<body>
<div class="m_bg">
<a name="htop" id="htop"></a>
<div class="header">
<div class="h960">
<div class="at_logo"> 
<div class="vcoupon"><a href="
u0.htm" onclick="copyText(this.href);">&raquo;邀请好友购买返 3元</a><a href="channel/ckticket.htm">&raquo;团购券验证及消费登记</a></div>
<div class="logo"><a href="default.htm"><img src="templates/default/images/logo_m.gif" /></a></div>
<a class="at_city" href="javascript:void(0)">大学城</a>
<div id="change_city"> <span id="top_title">切换城市</span>
<div id="show_provinces">
<div style=" position:absolute; font-weight:normal; right:8px; top:8px;" id="close">[关闭]</div>
<div style="margin-bottom:0.75em; font-weight:bolder;"><span>请选择您所在的城市:</span></div>
<ul class="scity">
<li><span class="sub_title"><a href="city-dxc.htm">大学城</a></span></li>
<li><span class="sub_title"><a href="city-shiqu.htm">市区</a></span></li>
</ul>
</div>
</div>
<div id="Tpl_c"> <a class="ft_top" href="
modmecoderegister.htm">邮件订阅每日最新团购</a>
<span id="page_options" onclick="ShowHideDiv()">更换模版<div id="Sright"><script type="text/javascript">writeCSSLinks();</script></div></span> 
</div>
</div>
</div>
</div>
<div class="t_nav">
<div class="h960">
<div class="sign">
您好！欢迎您的到来，<a href="login">登陆</a> | <a href="myself/register">注册</a>
</div>
<ul class="menu">
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a href="sn.eexx.me" target="_blank" title="引导页"><span>主站首页</span></a>
<div class="list">
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a  href="default.htm" title="本期团秒"><span>本期团秒</span></a>
<div class="list">
<a  href="home/type-seckills.htm" title="本期秒杀"><span>本期秒杀</span></a><br />
<a  href="home/type-groupbuy.htm" title="本期团购"><span>本期团购</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a  href="channel/backlist/default.htm" title="往期团秒"><span>往期团秒</span></a>
<div class="list">
<a  href="channel/backlist/type-groupbuy.htm" title="往期团购"><span>往期团购</span></a><br />
<a  href="channel/backlist/type-seckills.htm" title="往期秒杀"><span>往期秒杀</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a  href="channel/tobuy.htm" title="团购指南"><span>团购指南</span></a>
<div class="list">
<a  href="channel/problem.htm" title="常见问题"><span>常见问题</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a  href="channel/question.htm" title="团秒问答"><span>团秒问答</span></a>
<div class="list">
</div>
</li>
</ul>
</div>
</div><div class="m960">
<form method="POST"  action="index.php?mod=login&code=dologin">
<input type="hidden" name="FORMHASH" value='4fddbdf431a76032'/>
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">登陆</p>
<div class="sect">
<div class="nleftL">
<div class="field">
<label>用户名</label>
<input name="username" type="text"  class="f_input"/>
</div>
<div class="field">
<label>密　码</label>
<input name="password" type="password" class="f_input" />
</div>
<div class="field autologin">
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="登录">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="t_r">
<div class="t_area_out">
<h1>还没有舍内团秒帐户</h1>
<div class="t_area_in">
<p><a href="myself/register">立即注册</a>，仅需30秒！</p>
</div>
</div>
</div>
</form>
</div>
<div class="footer">
<div class="ft_bg"> <span><a href="javascript:scroll(0,0)">↑返回顶部</a></span></div>
<script type="text/javascript">
$(document).ready(function() {
$("#top_title").click(function() {
$("#show_provinces").toggle();
}).mouseover(function() {
$(this).css({ "color":"#fff" });	
}).mouseout(function() {
$(this).css({ "color":"#fff" });	
}).css({ "cursor":"pointer" , "text-decoration":"underline" });	
var last_show = null;
$(".sub_title").mouseover(function() {
if(last_show != null) {
last_show.prev().css({ "color":"#fff" , "font-weight":"normal" });
last_show.hide();				
}
last_show = $(this).css({ "color":"#fff" }).next();
last_show.show();	
}).css({ "cursor":"pointer" , "text-decoration":"underline" });	
$("li a").click(function() {			
$(".show_citys").hide();
$("#show_provinces").hide();
});
$("#close").click(function() {
$(".show_citys").css({ "color":"#F00" }).hide();
$("#show_provinces").css({ "color":"#F00" }).hide();
}).mouseover(function() {
$(this).css({ "color":"#F00" });
}).mouseout(function() {
$(this).css({ "color":"#F00" });	
}).css({ "cursor":"pointer" });
});
</script>
<div id="ft">
<ul class="cf">
<li class="col">
<h3>友情链接</h3>
<ul class="sub-list">
<li><a href="u.eexx.me" title="舍内家园" target="_blank">舍内家园</a> </li>
<li><a href="sn.eexx.me" title="舍内网" target="_blank">舍内网</a> </li>
<li><a href="shop.eexx.me" title="舍内网店" target="_blank">舍内网店</a> </li>
<li><a href="xx.eexx.me" title="舍内信息" target="_blank">舍内信息</a> </li>
</ul>
</li>
<li class="col">
<h3>如何团购</h3>
<ul class="sub-list">
<li><a href="channel/tobuy.htm">团购指南</a></li>
<li><a href="channel/problem.htm">常见问题</a></li>
<li><a href="home/email.htm">邮件订阅</a></li>
<li><a href="
u0.htm" onclick="copyText(this.href);" title="邀请好友购买返 3元">邀请好友</a></li>
</ul>
</li>
<li class="col">
<h3>联系我们</h3>
<ul class="sub-list">
<li><a href="home/contat.htm">联系我们</a></li>
<li><a href="channel/question.htm">在线问答</a></li>
<li><a href="home/feedback.htm">意见反馈</a></li>
<li><a href="home/teamwork.htm">商务合作</a></li>
</ul>
</li>
<li class="col">
<h3>公司信息</h3>
<ul class="sub-list">
<li><a href="home/aboutus.htm">关于我们</a></li>
<li><a href="home/privacy.htm">隐私保护</a></li>
<li><a href="home/joinus.htm">加入我们</a></li>
<li><a href="home/terms.htm">用户协议</a></li>
</ul>
</li>
<li class="col end">
<div class="logo-footer"> <a href="default.htm"><img src="templates/default/images/f_logo.png" /></a>
<p><a href="../www.miibeian.gov.cn/default.htm" target="_blank" title="网站备案"></a><script src="../s6.cnzz.com/stat.phpid2581431web_id2581431" language="JavaScript"></script>&nbsp; &nbsp;
</p>
</div>
</li>
</ul>    
</div>
</div>
</div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="../v2.jiathis.com/code/jiathis_r.jsmove0btnr4.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
</body>
</html>
<br><center><p>Powered by <a href="sn.eexx.me" target="_blank" title="舍内网官方网站">舍内网团购秒杀网</a> V1.0.1 &copy; 2010 <a href="fs.eexx.me" target="_blank" title="【疯·神】工作室 旗下产品">【疯·神】工作室</a> Inc.</p></center><br>