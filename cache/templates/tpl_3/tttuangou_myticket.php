<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn1"><a href="/myself/ticket">�ҵ��Ź�ȯ</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">�ҵĶ���</a></li>
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
</script>
<ul class="nleftL">
<div style="float: right;">
<li>���ࣺ</li>
<li class="liL_<?=$t1?>"><a href="/myself">ȫ��</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t2?>"><a href="/myself/type-1">δʹ��</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t3?>"><a href="/myself/type-0">��ʹ��</a></li>
<li class="liLine">|</li>
<li class="liL_<?=$t4?>"><a href="/myself/type-2">�ѹ���</a></li>
</div>
</ul>
<div class="nleftL">
<table id="report">
<tr>
<th>�Ź�ȯ���</th>
<th>��Ʒ����</th>
<th>ʹ��״̬</th>
<th></th>
</tr>
<? if(empty($ticket)) { ?>
<tr><td colspan="7">����ʱ��û���Ź�ȯ��ֻ���Ź��ɹ��������Ź�ȯ�Ż���ʾ������ط���</td></tr>
<? } ?>
<? if(is_array($ticket)) { foreach($ticket as $i => $value) { ?>
<tr class="Bor">
<td width="30%"><span class="R"><?=$value['number']?><br/>���룺
<? echo authcode($value['password'],DECODE,$this->Config['auth_key']); ?>
</span></td>
<td width="30%"><?=$value['name']?></td>
<td width="30%">
<? if($value['status']==1) { ?>
<img src="/images/no.gif" />δʹ��<? } elseif($value['status']==0) { ?><img src="/templates/default/images/sue.gif" /> ��ʹ��
<? } else { ?><img src="/templates/default/images/err.gif" /> ����
<? } ?>
</td>
<td width="10%"><div class="arrow"></div></td>
</tr>
<tr class="Bor">
<td colspan="4"><span>
<h4>�Ż�����</h4>
<p><b><?=$value['title']?></b> <?=$value['intro']?>��<br/>
�Ź�ȯ����ʱ�䣺<span style="color:red;"><?=$value['perioddate']?></span><br/>
<a href="/myself/printticket/id-<?=$value['ticketid']?>">��ӡ�Ź�ȯ</a></p>
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
<h1>��������</h1>
<div class="t_area_in" style="font-size:12px;">
<h3 class="first">ʲô���Ź�ȯ��</h3>
<p>�Ź�ȯ�ǵ��Ź��ɹ�������õ�����ƾ֤���루���а������룩��</p>
<h3>���ʹ���Ź�ȯ��</h3>
<p>���¼���Ź�ȯ�����룬����Ч����ȥ�̼�����ʱ��ʾ���ɡ�</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>