<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">我的团购券</a></li>
<li class="ts3_mbtn1"><a href="/myself/order">我的订单</a></li>
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
//jQuery等比例缩放图片大小
function DrawImg(boxWidth,boxHeight)
{
var imgWidth=$("#img1").width();
var imgHeight=$("#img1").height();
//比较imgBox的长宽比与img的长宽比大小
if((boxWidth/boxHeight)>=(imgWidth/imgHeight))
{
//重新设置img的width和height
$("#img1").width((boxHeight*imgWidth)/imgHeight);
$("#img1").height(boxHeight);
//让图片居中显示
var margin=(boxWidth-$("#img1").width())/2;
$("#img1").css("margin-left",margin);
}
else
{
//重新设置img的width和height
$("#img1").width(boxWidth);
$("#img1").height((boxWidth*imgHeight)/imgWidth);
//让图片居中显示
var margin=(boxHeight-$("#img1").height())/2;
$("#img1").css("margin-top",margin);
}
}
</script>
<ul class="nleftL">
<div style="float: right;">
<li>分类:</li>
<li class="liL_<?=$t1?>"><a href="/myself/order">全部</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t2?>"><a href="/myself/order/type-payed">已付款</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t3?>"><a href="/myself/order/type-nopay">未付款</a></li>
</div>
</ul>
<? if($order=='') { ?>
<div class="nleftL"><span class="B2">您还没有订单</span></div>
<? } ?>
<div class="nleftL">
<table id="report">
<tr>
<th>团购项目</th>
<th>数量</th>
<th>总价</th>
<th>订单状态</th>
<th>操作</th>
<th></th>
</tr>
<? if(empty($order)) { ?>
<tr><td colspan="7">您暂时还没有订单，您可以去团购您喜欢的商品，这样就会有订单显示出来！</td></tr>
<? } ?>
<? if(is_array($order)) { foreach($order as $i => $value) { ?>
<tr class="Bor">
<td width="30%"><span class="R"><?=$value['name2']?></span></td>
<td width="10%"><?=$value['productnum']?></td>
<td width="15%">&yen; <?=$value['price']?>元</td>
<td width="20%">
<? if($value['pay']==1 && $value['status']==1) { ?>
<img src="/templates/default/images/sue.gif" />已付款
<? } else { ?><img src="/templates/default/images/no2.gif" />
<? if($value['status']==0) { ?>
已取消<? } elseif($value['status']==2) { ?>已过期<? } elseif($value['status']==3) { ?>失败
<? } else { ?>未付款
<? } ?>
<? } ?>
</td>
<td width="15%">
<? if($value['pay']==1) { ?>
-----<? } elseif($value['status']==0 || $value['status']==2) { ?>-----
<? } else { ?><a href="/home/pay/orderid-<?=$value['orderid']?>" rel="external">付款</a> <a href="/myself/cancel/orderid-<?=$value['orderid']?>">取消</a>
<? } ?>
</td>
<td width="10%"><div class="arrow"></div></td>
</tr>
<tr class="Bor">
<td colspan="6">
<div class="imgC" >
<div id="imgBox" style="width:125px; height:75px; background:#fff; overflow:hidden">
<img id="img1" src="images/product/s-<?=$value['img']?>" onload="DrawImg(125,75);" />
</div>
</div>
<div class="order_info">
<h4>订单详情</h4>
<p><b><?=$value['name']?></b>（订单日期：<?=$value['time']?>）<?=$value['intro']?><br/>
订单编号：<?=$value['orderid']?>
</p>
</div> </td>
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
<h3 class="first">我已支付成功，为什么没有<?=$this->Config['site_name']?>券？</h3>
<p>因为还没有到达最低团购人数，一旦凑够人数，您就会看到<?=$this->Config['site_name']?>券了。</p>
<h3>什么是已过期订单？</h3>
<p>如果某个订单未及时付款，那么等团购结束时就无法再付款了，这种订单就是过期订单。</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>