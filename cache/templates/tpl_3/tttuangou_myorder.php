<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">�ҵ��Ź�ȯ</a></li>
<li class="ts3_mbtn1"><a href="/myself/order">�ҵĶ���</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">�ҵ����</a></li>
<li class="ts3_mbtn2"><a href="/myself/info">�˻�����</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn2"><a href="/myself/face">�ҵ�ͷ��</a></li>
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
//jquery ģ�������´���
$("a[rel=external]").attr('target', '_blank');
//jQuery�ȱ�������ͼƬ��С
function DrawImg(boxWidth,boxHeight)
{
var imgWidth=$("#img1").width();
var imgHeight=$("#img1").height();
//�Ƚ�imgBox�ĳ�������img�ĳ����ȴ�С
if((boxWidth/boxHeight)>=(imgWidth/imgHeight))
{
//��������img��width��height
$("#img1").width((boxHeight*imgWidth)/imgHeight);
$("#img1").height(boxHeight);
//��ͼƬ������ʾ
var margin=(boxWidth-$("#img1").width())/2;
$("#img1").css("margin-left",margin);
}
else
{
//��������img��width��height
$("#img1").width(boxWidth);
$("#img1").height((boxWidth*imgHeight)/imgWidth);
//��ͼƬ������ʾ
var margin=(boxHeight-$("#img1").height())/2;
$("#img1").css("margin-top",margin);
}
}
</script>
<ul class="nleftL">
<div style="float: right;">
<li>����:</li>
<li class="liL_<?=$t1?>"><a href="/myself/order">ȫ��</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t2?>"><a href="/myself/order/type-payed">�Ѹ���</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t3?>"><a href="/myself/order/type-nopay">δ����</a></li>
</div>
</ul>
<? if($order=='') { ?>
<div class="nleftL"><span class="B2">����û�ж���</span></div>
<? } ?>
<div class="nleftL">
<table id="report">
<tr>
<th>�Ź���Ŀ</th>
<th>����</th>
<th>�ܼ�</th>
<th>����״̬</th>
<th>����</th>
<th></th>
</tr>
<? if(empty($order)) { ?>
<tr><td colspan="7">����ʱ��û�ж�����������ȥ�Ź���ϲ������Ʒ�������ͻ��ж�����ʾ������</td></tr>
<? } ?>
<? if(is_array($order)) { foreach($order as $i => $value) { ?>
<tr class="Bor">
<td width="30%"><span class="R"><?=$value['name2']?></span></td>
<td width="10%"><?=$value['productnum']?></td>
<td width="15%">&yen; <?=$value['price']?>Ԫ</td>
<td width="20%">
<? if($value['pay']==1 && $value['status']==1) { ?>
<img src="/templates/default/images/sue.gif" />�Ѹ���
<? } else { ?><img src="/templates/default/images/no2.gif" />
<? if($value['status']==0) { ?>
��ȡ��<? } elseif($value['status']==2) { ?>�ѹ���<? } elseif($value['status']==3) { ?>ʧ��
<? } else { ?>δ����
<? } ?>
<? } ?>
</td>
<td width="15%">
<? if($value['pay']==1) { ?>
-----<? } elseif($value['status']==0 || $value['status']==2) { ?>-----
<? } else { ?><a href="/home/pay/orderid-<?=$value['orderid']?>" rel="external">����</a> <a href="/myself/cancel/orderid-<?=$value['orderid']?>">ȡ��</a>
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
<h4>��������</h4>
<p><b><?=$value['name']?></b>���������ڣ�<?=$value['time']?>��<?=$value['intro']?><br/>
������ţ�<?=$value['orderid']?>
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
<h1>��������</h1>
<div class="t_area_in" style="font-size:12px;">
<h3 class="first">����֧���ɹ���Ϊʲôû��<?=$this->Config['site_name']?>ȯ��</h3>
<p>��Ϊ��û�е�������Ź�������һ���չ����������ͻῴ��<?=$this->Config['site_name']?>ȯ�ˡ�</p>
<h3>ʲô���ѹ��ڶ�����</h3>
<p>���ĳ������δ��ʱ�����ô���Ź�����ʱ���޷��ٸ����ˣ����ֶ������ǹ��ڶ�����</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>