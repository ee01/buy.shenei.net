<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">�ҵ��Ź�ȯ</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">�ҵĶ���</a></li>
<li class="ts3_mbtn1"><a href="/myself/money">�ҵ����</a></li>
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
<div class="nleftL"><span class="B">����ǰ���ʻ������ <em class="R"> <?=$money['money']?></em> Ԫ</span> <a href="/myself/addmoney">&lt;����Ϊ�˻���ֵ&gt;</a> </div>
<div class="nleftL">
<table id="report">
<tr>
<th>ժҪ</th>
<th>����</th>
<th>��Ԫ��</th>
<th></th>
</tr>
<? if(empty($usermoney)) { ?>
<tr><td colspan="7">����ʱ��û���˻���Ϣ������ֵ�����Ʒ����Ϣ������������ʾŶ��</td></tr>
<? } ?>
<? if(is_array($usermoney)) { foreach($usermoney as $i => $value) { ?>
<tr class="Bor">
<td width="50%"><span class="R"><?=$value['name']?></span></td>
<td width="25%">
<? echo date('Y-m-d H:i:s',$value['time']) ?>
</td>
<td width="15%">
<? if($value['type']==0) { ?>
-
<? } else { ?>+
<? } ?>
 <?=$value['money']?></td>
<td width="10%"><div class="arrow"></div></td>
</tr>
<tr class="Bor">
<td colspan="4"><span>
<h4>ժҪ����</h4>
<p><b><?=$value['intro']?></b></p>
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
<h3 class="first">ʲô���ʻ���</h3>
<p>�ʻ����������<?=$this->Config['site_name']?>���Ź�ʱ������֧���Ľ�</p>
<h3>������������</h3>
<p><a href="/channel/finder">�������</a>���<?=$this->config['default_payfinder']?> Ԫ��������ֵ���ʻ�����С�</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>