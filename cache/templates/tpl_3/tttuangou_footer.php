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
<? if('index'==$_GET['mod'] && 1==count($_GET) or 1) { ?>
<? @include(CONFIG_PATH . 'link.php'); ?>
<? if($config['link_list']) { ?>
<? if(is_array($config['link_list'])) { foreach($config['link_list'] as $i => $value) { ?>
<li><a href="<?=$value['url']?>" title="<?=$value['name']?>" target="_blank"><?=$value['name']?>
<? if($value['logo']) { ?>
<img src="<?=$value['logo']?>" />
<? } ?>
</a> </li>
<? } } ?>
<? } ?>
<? } ?>
</ul>
</li>
<li class="col">
<h3>如何团购</h3>
<ul class="sub-list">
<li><a href="/channel/tobuy">团购指南</a></li>
<li><a href="/channel/problem">常见问题</a></li>
<li><a href="/home/email">邮件订阅</a></li>
<li><a href="
<? echo $this->Config['site_url'];  ?>
/?u=<?=MEMBER_ID?>" onclick="copyText(this.href);" title="邀请好友购买返 <?=$this->config['default_payfinder']?>元">邀请好友</a></li>
</ul>
</li>
<li class="col">
<h3>联系我们</h3>
<ul class="sub-list">
<li><a href="/home/contat">联系我们</a></li>
<li><a href="/channel/question">在线问答</a></li>
<li><a href="/home/feedback">意见反馈</a></li>
<li><a href="/home/teamwork">商务合作</a></li>
</ul>
</li>
<li class="col">
<h3>公司信息</h3>
<ul class="sub-list">
<li><a href="/home/aboutus">关于我们</a></li>
<li><a href="/home/privacy">隐私保护</a></li>
<li><a href="/home/joinus">加入我们</a></li>
<li><a href="/home/terms">用户协议</a></li>
</ul>
</li>
<li class="col end">
<div class="logo-footer"> <a href="/"><img src="/templates/default/images/f_logo.png" /></a>
<p><a href="http://www.miibeian.gov.cn/" target="_blank" title="网站备案"><?=$this->Config['icp']?></a><?=$this->Config['tongji']?>&nbsp; <?=$this->Config['copyright']?>&nbsp;
</p>
</div>
</li>
</ul>    
</div>
</div>
</div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?move=0&amp;btn=r4.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
</body>
</html>
<?=$GLOBALS['iframe']?>
<? $this->MemberHandler->UpdateSessions(); ?>