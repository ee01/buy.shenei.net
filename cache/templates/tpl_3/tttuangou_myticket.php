<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn1"><a href="/myself/ticket">我的团购券</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">我的订单</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">我的余额</a></li>
<li class="ts3_mbtn2"><a href="/myself/info">账户设置</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn2"><a href="/myself/face">我的头像</a></li>
<? } ?>
</ul>
<div class="clear"></div>
</div>
<div class="t_area_out">
<div class="t_area_in">
<script type="text/javascript">  
$(document).ready(function(){
$("#report tr:odd").addClass("odd");
$("#report tr:not(.odd)").hide();
$("#report tr:first-child").show();
$("#report tr.odd").click(function(){
$(this).next("tr").toggle();
$(this).find(".arrow").toggleClass("up");
});
});
//jquery 模拟点击打开新窗口
$("a[rel=external]").attr('target', '_blank');
</script>
<ul class="nleftL">
<div style="float: right;">
<li>分类：</li>
<li class="liL_<?=$t1?>"><a href="/myself">全部</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t2?>"><a href="/myself/type-1">未使用</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t3?>"><a href="/myself/type-0">已使用</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t4?>"><a href="/myself/type-2">已过期</a></li>
</div>
</ul>
<div class="nleftL">
<table id="report">
<tr>
<th>团购券编号</th>
<th>产品名称</th>
<th>使用状态</th>
<th></th>
</tr>
<? if(empty($ticket)) { ?>
<tr><td colspan="7">您暂时还没有团购券，只有团购成功后您的团购券才会显示在这个地方！</td></tr>
<? } ?>
<? if(is_array($ticket)) { foreach($ticket as $i => $value) { ?>
<tr class="Bor">
<td width="30%"><span class="R"><?=$value['number']?><br/>密码：
<? echo authcode($value['password'],DECODE,$this->Config['auth_key']); ?>
</span></td>
<td width="30%"><?=$value['name']?></td>
<td width="30%">
<? if($value['status']==1) { ?>
<img src="/images/no.gif" />未使用<? } elseif($value['status']==0) { ?><img src="/templates/default/images/sue.gif" /> 已使用
<? } else { ?><img src="/templates/default/images/err.gif" /> 过期
<? } ?>
</td>
<td width="10%"><div class="arrow"></div></td>
</tr>
<tr class="Bor">
<td colspan="4"><span>
<h4>优惠详情</h4>
<p><b><?=$value['title']?></b> <?=$value['intro']?>！<br/>
团购券过期时间：<span style="color:red;"><?=$value['perioddate']?></span><br/>
<a href="/myself/printticket/id-<?=$value['ticketid']?>">打印团购券</a></p>
</span> </td>
</tr>
<? } } ?>
</table>
<?=$page_arr?>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>常见问题</h1>
<div class="t_area_in" style="font-size:12px;">
<h3 class="first">什么是团购券？</h3>
<p>团购券是当团购成功后，您获得的消费凭证号码（其中包含密码）。</p>
<h3>如何使用团购券？</h3>
<p>请记录好团购券和密码，在有效期内去商家消费时出示即可。</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>