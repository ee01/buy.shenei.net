<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<script language="javascript">
var price;
var oncemax;
var surplusnum;
price=<?=$product['earnest']?>;
oncemax=<?=$product['oncemax']?>;
surplusnum=<?=$surplusnum?>;
$(document).ready(function(){
	$("#num").keyup( function () {numkeyup('','',price);});
});
function numkeyup(numi,numsum,price) {
	if(surplusnum<oncemax){
		oncemax=surplusnum;
	}
	if($('#num'+numi).val()<=0){
		alert('���󣬹�������������ڵ���1');
		$('#num'+numi).val(1);
	}
	if(isNaN($('#num'+numi).val())){
		alert('��������������һ������'+numi);
		$('#num'+numi).val(1);
	}
	if(oncemax != 0 && oncemax < $('#num'+numi).val()){
		alert('�Բ���,����๺��'+oncemax+'����Ʒ');
		$('#num'+numi).val(oncemax);
	}
	$("#price").html($('#num'+numi).val()*price);
	$("#price2"+numi).html($('#num'+numi).val()*price);
}
function choosenum(numi,price) {
	document.getElementsByName("priceradio")[numi-1].checked=true;
	$("#price").html($('#num'+numi).val()*price);
	$("#price2"+numi).html($('#num'+numi).val()*price);
}
</script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">�ύ����</p>
<div class="sect">
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<? if($product['otherprice']) { ?>
<table id="report">
<tr>
<th>&nbsp;</th>
<th>�Ź���Ŀ</th>
<th>�۸�</th>
<th>����</th>
<th>&nbsp;</th>
<th>����</th>
<th>&nbsp;</th>
<th>�ܼ�</th>
</tr>
<? if(is_array($product['otherprice'])) { foreach($product['otherprice'] as $i => $value) { ?>
<script language="javascript">
$(document).ready(function(){
	$("#num"+<?=$i?>).keyup( function () {numkeyup(<?=$i?>,<?=$pricenum?>,<?=$product['otherprice'][$i]['earnest']?>);});
});
</script>
<tr class="Bor">
<td width="5%"><input type="radio" name="priceradio" value=<?=$i?> onClick="choosenum(<?=$i?>,<?=$product['otherprice'][$i]['earnest']?>)" 
<? if($i==1) { ?>
checked
<? } ?>
/></td>
<td width="25%"><?=$value['name']?></td>
<td width="12%"><STRIKE>&yen; <?=$value['price']?></STRIKE><br>&yen; <?=$value['nowprice']?></td>
<td width="10%"><input type="text" name="num<?=$i?>" id="num<?=$i?>" value="<?=$editnum?>" maxlength="4" class="input_text f_input2" onfocus="choosenum(<?=$i?>,<?=$product['otherprice'][$i]['earnest']?>)"></td>
<td width="4%">x</td>
<td width="10%">&yen; <?=$value['earnest']?></td>
<td width="4%">=</td>
<td width="10%"><span class="B">&yen; <span id='price2<?=$i?>'><?=$value['earnest']?></span></span></td>
</tr>
<? } } ?>
</table>
<div class="nleftL"><span class="SR B R">Ӧ���ܶ&yen; <span id='price'><?=$product['otherprice']['1']['earnest']?></span></span></div>
<? } else { ?><table id="report">
<tr>
<th>�Ź���Ŀ</th>
<th>�۸�</th>
<th>����</th>
<th>&nbsp;</th>
<th>
<? if($product['earnest']==$product['nowprice']) { ?>
����
<? } else { ?>����
<? } ?>
</th>
<th>&nbsp;</th>
<th>�ܼ�</th>
</tr>
<tr class="Bor">
<td width="35%"><?=$product['name']?></td>
<td width="12%"><STRIKE>&yen; <?=$product['price']?></STRIKE><br>&yen; <?=$product['nowprice']?></td>
<td width="10%"><input type="text" name="num" id="num" value="<?=$editnum?>" maxlength="4" class="input_text f_input2"></td>
<td width="4%">x</td>
<td width="12%">&yen; <?=$product['earnest']?></td>
<td width="4%">=</td>
<td width="15%"><span class="B">&yen; <span id='price2'><?=$product['earnest']?></span></span></td>
</tr>
</table>
<div class="nleftL"><span class="SR B R">Ӧ���ܶ&yen; <span id='price'><?=$product['earnest']?></span></span></div>
<? } ?>
<div class="nleftL">
<input type="hidden" value="<?=$id?>" name="id" />
<input type="submit" value="ȷ�����󣬹���" name="buy" class="formbutton">  	
</div>
</form>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>