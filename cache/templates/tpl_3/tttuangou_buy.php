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
		alert('错误，购买数量必须大于等于1');
		$('#num'+numi).val(1);
	}
	if(isNaN($('#num'+numi).val())){
		alert('错误，数量必须是一个数字'+numi);
		$('#num'+numi).val(1);
	}
	if(oncemax != 0 && oncemax < $('#num'+numi).val()){
		alert('对不起,您最多购买'+oncemax+'个商品');
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
<p class="cur_title">提交订单</p>
<div class="sect">
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<? if($product['otherprice']) { ?>
<table id="report">
<tr>
<th>&nbsp;</th>
<th>团购项目</th>
<th>价格</th>
<th>数量</th>
<th>&nbsp;</th>
<th>定金</th>
<th>&nbsp;</th>
<th>总价</th>
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
<div class="nleftL"><span class="SR B R">应付总额：&yen; <span id='price'><?=$product['otherprice']['1']['earnest']?></span></span></div>
<? } else { ?><table id="report">
<tr>
<th>团购项目</th>
<th>价格</th>
<th>数量</th>
<th>&nbsp;</th>
<th>
<? if($product['earnest']==$product['nowprice']) { ?>
单价
<? } else { ?>定金
<? } ?>
</th>
<th>&nbsp;</th>
<th>总价</th>
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
<div class="nleftL"><span class="SR B R">应付总额：&yen; <span id='price'><?=$product['earnest']?></span></span></div>
<? } ?>
<div class="nleftL">
<input type="hidden" value="<?=$id?>" name="id" />
<input type="submit" value="确认无误，购买" name="buy" class="formbutton">  	
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