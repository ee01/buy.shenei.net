<div class="footer">
<div class="ft_bg"> <span><a href="javascript:scroll(0,0)">�����ض���</a></span></div>
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
<h3>��������</h3>
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
<h3>����Ź�</h3>
<ul class="sub-list">
<li><a href="/channel/tobuy">�Ź�ָ��</a></li>
<li><a href="/channel/problem">��������</a></li>
<li><a href="/home/email">�ʼ�����</a></li>
<li><a href="
<? echo $this->Config['site_url'];  ?>
/?u=<?=MEMBER_ID?>" onclick="copyText(this.href);" title="������ѹ��� <?=$this->config['default_payfinder']?>Ԫ">�������</a></li>
</ul>
</li>
<li class="col">
<h3>��ϵ����</h3>
<ul class="sub-list">
<li><a href="/home/contat">��ϵ����</a></li>
<li><a href="/channel/question">�����ʴ�</a></li>
<li><a href="/home/feedback">�������</a></li>
<li><a href="/home/teamwork">�������</a></li>
</ul>
</li>
<li class="col">
<h3>��˾��Ϣ</h3>
<ul class="sub-list">
<li><a href="/home/aboutus">��������</a></li>
<li><a href="/home/privacy">��˽����</a></li>
<li><a href="/home/joinus">��������</a></li>
<li><a href="/home/terms">�û�Э��</a></li>
</ul>
</li>
<li class="col end">
<div class="logo-footer"> <a href="/"><img src="/templates/default/images/f_logo.png" /></a>
<p><a href="http://www.miibeian.gov.cn/" target="_blank" title="��վ����"><?=$this->Config['icp']?></a><?=$this->Config['tongji']?>&nbsp; <?=$this->Config['copyright']?>&nbsp;
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