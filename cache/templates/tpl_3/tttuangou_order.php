<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">�ύ����</p>
<div class="sect">
<table id="report">
<tr>
<th>�Ź���Ŀ</th>
<th>����</th>
<th>&nbsp;</th>
<th>�۸�</th>
<th>&nbsp;</th>
<th>�ܼ�</th>
</tr>
<tr class="Bor">
<td width="35%"><?=$productname?></td>
<td width="10%"><?=$num?></td>
<td width="4%">x</td>
<td width="12%">&yen; <?=$productearnest?></td>
<td width="4%">=</td>
<td width="15%"><span class="B">&yen; <?=$totalprice?></span></td>
</tr>
</table>
<div class="nleftL">
<span>���������֧�����޶���ȷֶ��<a href="/myself/addmoney" target=_blank>���˻���ֵ</a>��Ȼ��ˢ�±�ҳʹ�����֧���� ��ǰ�˻���� <span style="color:#FF0000;"><?=$self['money']?>Ԫ</span>��ʹ�������</span><span class="SR B R">��Ӧ֧����&yen; <?=$totalprice2?>Ԫ </span>
</div>
<div class="nleftL">
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="order_check_form ">
<p class="choose_pay_type">��ѡ��֧����ʽ��</p>
<table width="100%" border="0" class="orderT">
<? if(is_array($pay)) { foreach($pay as $i => $value) { ?>
<!--һ��֧ͨ��-->
<? if($value['pay_id'] == 6 and 1) { ?>
<tr>
<td width="4%"><input name="paytype" type="radio" value="6" 
<? if($order['paytype']==6 ||  $order['paytype']=='') { ?>
checked="checked"
<? } ?>
></td>
<td width="20%"><img src="/templates/default/images/card.gif" /></td>
<td width="66%">ʹ�� У԰һ��ͨ����֧������</td>
</tr>
<? } ?>
<!--һ��֧ͨ��-->
<? if($value['pay_id'] == 1) { ?>
<tr>
<td width="4%"><input name="paytype" type="radio" value="1" 
<? if($order['paytype']==1) { ?>
checked="checked"
<? } ?>
></td>
<td width="20%"><img src="/templates/default/images/alipay.gif" /></td>
<td width="66%">�Ƽ�֧�������������û�ʹ��</td>
</tr>
<? } ?>
<? if($value['pay_id'] == 2) { ?>
<tr>
<td><input name="paytype" type="radio" value="2" 
<? if($order['paytype']==2) { ?>
checked="checked"
<? } ?>
 ></td>
<td><img src="/templates/default/images/tenpay.gif" /></td>
<td>�Ƽ��Ƹ�ͨ����ѶQQ�û�ʹ��</td>
</tr>
<? } ?>
<? if($value['pay_id'] == 3) { ?>
<tr>
<td><input name="paytype" type="radio" value="3" 
<? if($order['paytype']==3) { ?>
checked="checked"
<? } ?>
></td>
<td><img src="/templates/default/images/chinabank.gif" /></td>
<td>֧���������е�ת�˻��������֧��ҳ��</td>
</tr>
<? } ?>
<? if($value['pay_id'] == 4) { ?>
<tr>
<td><input name="paytype" type="radio" value="4" 
<? if($order['paytype']==4) { ?>
checked="checked"
<? } ?>
></td>
<td><img src="/templates/default/images/kuaiqian.bmp" /></td>
<td>�Ƽ���Ǯ���������û�ʹ��</td>
</tr>
<? } ?>
<? if($value['pay_id'] == 5) { ?>
<tr>
<td><input name="paytype" type="radio" value="5" 
<? if($order['paytype']==5) { ?>
checked="checked"
<? } ?>
></td>
<td><img src="/templates/default/images/offline.gif" /></td>
<td>���µ��渶�ֽ�</td>
</tr>
<? } ?>
<? } } ?>
</table>
<div class="clear"></div>
<p class="check_act">
<input name="priceradio" type="hidden" value="<?=$priceradio?>">
<input name="num" type="hidden" value="<?=$num?>">
<input name="id" type="hidden" value="<?=$id?>">
<input type="submit" class="formbutton" value="
<? if($totalprice2==0) { ?>
�˻������㣬ֱ�Ӹ��ͨ
<? } else { ?>ȷ�����ɶ��������븶��ҳ
<? } ?>
">
<a style="margin-left: 1em;" href="/home/buy/editnum-<?=$num?>/id-<?=$id?>">�����޸Ķ���</a> 
</p>
</div>
</form>
</div>
</div>
</div>
</div></div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>