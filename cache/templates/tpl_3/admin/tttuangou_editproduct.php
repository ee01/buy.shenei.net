<? include $this->TemplateHandler->template('admin/header'); ?>
 <script src="templates/default/js/calenderJS.js"></script> <script type="text/javascript" charset="utf-8" src="templates/default/js/kind/kindeditor.js"></script> <script type="text/javascript">
KE.show({
id : 'content'
});
KE.show({
id : 'cue'
});
KE.show({
id : 'theysay'
});
KE.show({
id : 'wesay'
});
</script>
<script language="javascript">
// Example: obj = findObj("image1");
var pricenum = <?=$pricenum?>;
function findObj(theObj, theDoc){
	var p, i, foundObj;
	if(!theDoc) theDoc = document;
	if ( (p = theObj.indexOf("?")) > 0 && parent.frames.length) {
		theDoc = parent.frames[theObj.substring(p+1)].document;
		theObj = theObj.substring(0,p);
	}
	if(!(foundObj = theDoc[theObj]) && theDoc.all)
		foundObj = theDoc.all[theObj];
	for (i=0; !foundObj && i < theDoc.forms.length; i++)
		foundObj = theDoc.forms[i][theObj];
	for(i=0; !foundObj && theDoc.layers && i < theDoc.layers.length; i++)
		foundObj = findObj(theObj,theDoc.layers[i].document);
	if(!foundObj && document.getElementById)
		foundObj = document.getElementById(theObj);
	return foundObj;
}
//添加一个参与人填写行
function AddSignRow(rowID0){
	//读取最后一行的行号，存放在txtTRLastIndex文本框中 
	var txtTRLastIndex = findObj("txtTRLastIndex",document);
	var rowID = parseInt(txtTRLastIndex.value);
	var rowID2 = rowID + rowID0;

	var signFrame = findObj("pricetable",document);
	//添加行
	var newTR = signFrame.insertRow(signFrame.rows.length);
	newTR.id = "SignItem" + rowID;
	//添加列:子产品名
	var newNameTD=newTR.insertCell(0);
	//添加列内容
	newNameTD.innerHTML = "<input name='name" + rowID2 + "' id='name" + rowID2 + "' type='text' size='80' value='<?=$value['name']?>' />";

	//添加列:原价
	var newEmailTD=newTR.insertCell(1);
	//添加列内容
	newEmailTD.innerHTML = "<input name='price" + rowID2 + "' id='price" + rowID2 + "' type='text' size='6' value='<?=$value['price']?>' />元";

	//添加列:现价
	var newTelTD=newTR.insertCell(2);
	//添加列内容
	newTelTD.innerHTML = "<input name='nowprice" + rowID2 + "' id='nowprice" + rowID2 + "' type='text' size='6' value='<?=$value['nowprice']?>' />元";

	//添加列:定金
	var newMobileTD=newTR.insertCell(3);
	//添加列内容
	newMobileTD.innerHTML = "<input name='earnest" + rowID2 + "' id='earnest" + rowID2 + "' type='text' size='6' value='<?=$value['earnest']?>' />元";

	//添加列:删除按钮
	var newDeleteTD=newTR.insertCell(4);
	//添加列内容
	newDeleteTD.innerHTML = "<div align='center' style='width:40px'><a href='javascript:;' onclick=\"DeleteSignRow('SignItem" + rowID + "')\">删除</a></div>";

	//将行号推进下一行
	txtTRLastIndex.value = (rowID + 1).toString() ;
}
//删除指定行
function DeleteSignRow(rowid){
	var signFrame = findObj("pricetable",document);
	var signItem = findObj(rowid,document);

	//获取将要删除的行的Index
	var rowIndex = signItem.rowIndex;

	//删除指定Index的行
	signFrame.deleteRow(rowIndex);
/*
	//重新排列序号，如果没有序号，这一步省略
	for(i=rowIndex;i<signFrame.rows.length;i++){
		signFrame.rows[i].cells[0].innerHTML = i.toString();
	}
*/
}//清空列表
function ClearAllSign(){
	if (confirm('确定要清空所有参与人吗？')) {
		var signFrame = findObj("pricetable",document);
		var rowscount = signFrame.rows.length;

		//循环删除行,从最后一行往前删除
		for(i=rowscount - 1;i > 0; i--){
			signFrame.deleteRow(i);
		}

		//重置最后行号为1
		var txtTRLastIndex = findObj("txtTRLastIndex",document);
		txtTRLastIndex.value = "1";
		
		//清楚原先行计数
		pricenum = 0;
		document.getElementById('txtTROriginalNum').value = 0;

		//预添加一行
		AddSignRow(0);
	}
}
</script>
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="2">修改产品</td> </tr>
<tr> <td width="23%" bgcolor="#F8F8F8">产品名称：</td> <td width="77%" align="right" bgcolor="#FFFFFF"> <input name="name" type="text" id="name" size="80" value="<?=$product['name']?>"></td> </tr>
<tr> <td bgcolor="#F8F8F8">团购秒杀：</td> <td align="right" bgcolor="#FFFFFF"><label> <select name="is_seckill" id="is_seckill">
<option value=0 
<? if($product['is_seckill']==0) { ?>
selected
<? } ?>
>团购</option>
<option value=1 
<? if($product['is_seckill']) { ?>
selected
<? } ?>
>秒杀</option>
</select> </label></td> </tr>
<tr> <td bgcolor="#F8F8F8">团秒城市：</td> <td align="right" bgcolor="#FFFFFF"><label> <select name="city" id="city">
<? if(is_array($city)) { foreach($city as $i => $value) { ?>
<option value="<?=$value['cityid']?>" 
<? if($product['city']==$value['cityid']) { ?>
selected
<? } ?>
><?=$value['cityname']?></option>
<? } } ?>
</select> </label></td> </tr>
<tr> <td bgcolor="#F8F8F8">合作商家：</td> <td align="right" bgcolor="#FFFFFF"> <select name="sellerid" id="sellerid">
<? if(is_array($seller)) { foreach($seller as $i => $value) { ?>
<option value="<?=$value['id']?>" 
<? if($product['sellerid']==$value['id']) { ?>
selected
<? } ?>
><?=$value['sellername']?></option>
<? } } ?>
</select> </td></tr>
<tr> <td bgcolor="#F8F8F8">原价：</td> <td align="right" bgcolor="#FFFFFF"><input name="price" type="text" id="price" size="6" value="<?=$product['price']?>"/>元</td> </tr>
<tr> <td bgcolor="#F8F8F8">现价：</td> <td align="right" bgcolor="#FFFFFF"><input name="nowprice" type="text" id="nowprice" size="6" value="<?=$product['nowprice']?>" />元</td> </tr>
<tr> <td bgcolor="#F8F8F8">定金：</td> <td align="right" bgcolor="#FFFFFF"><input name="earnest" type="text" id="earnest" size="6" value="<?=$product['earnest']?>" />元</td> </tr>
<tr> <td bgcolor="#F8F8F8"><input name="useotherprice" type="checkbox" id="useotherprice" value="1" 
<? if($product['otherprice']) { ?>
 checked 
<? } ?>
 />是否启用规格：[<a onclick="AddSignRow(pricenum)"><font color=red>添加</font></a>&nbsp;<a onclick="ClearAllSign()"><font color=silver>清空</font></a>]</td> <td align="right" bgcolor="#FFFFFF">
<table id="pricetable" cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
  <tr>
    <td width="40%">子产品名</td>
    <td width="20%">原价</td>
    <td width="20%">现价</td>
    <td width="20%">定金</td>
	<td>&nbsp;</td>
  </tr>
<? if(is_array($product['otherprice'])) { foreach($product['otherprice'] as $i => $value) { ?>
  <tr>
    <td><input name="name<?=$i?>" type="text" id="name<?=$i?>" size="80" value="<?=$value['name']?>"></td>
    <td><input name="price<?=$i?>" type="text" id="price<?=$i?>" size="6" value="<?=$value['price']?>"/>元</td>
    <td><input name="nowprice<?=$i?>" type="text" id="nowprice<?=$i?>" size="6" value="<?=$value['nowprice']?>" />元</td>
    <td><input name="earnest<?=$i?>" type="text" id="earnest<?=$i?>" size="6" value="<?=$value['earnest']?>" />元</td>
	<td>&nbsp;</td>
  </tr>
<? } } ?>
</table>
<input name='txtTROriginalNum' type='hidden' id='txtTROriginalNum' value="<?=$pricenum?>" />
<input name='txtTRLastIndex' type='hidden' id='txtTRLastIndex' value="1" />
</td> </tr>
<tr> <td bgcolor="#F8F8F8">产品图片：</td> <td align="right" bgcolor="#FFFFFF"><input name="img" type="file" id="img" /></td> </tr>
<tr> <td bgcolor="#F8F8F8">简介：</td> <td align="right" bgcolor="#FFFFFF"><textarea name="intro" cols="40" rows="5" id="intro"><?=$product['intro']?></textarea></td> </tr>
<tr> <td bgcolor="#F8F8F8">产品数量上限：</td> <td align="right" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$product['maxnum']?>" /><span style="color:red;">*0表示不限制</span></td> </tr>
<tr> <td bgcolor="#F8F8F8">团秒开始时间：</td> <td align="right" bgcolor="#FFFFFF"><input name="begintime" type="text" id="begintime" onfocus="HS_setDate(this)" size="21" value="<?=$product['begintime']?>" />（从设定日期0点开始）</td> </tr>
<tr> <td bgcolor="#F8F8F8">团秒结束时间：</td> <td align="right" bgcolor="#FFFFFF"><input name="overtime" type="text" id="overtime" onfocus="HS_setDate(this)" size="21" value="<?=$product['overtime']?>" />（到设定日期0点结束）</td> </tr>
<tr> <td bgcolor="#F8F8F8">消费券有效期的截止日期：</td> <td align="right" bgcolor="#FFFFFF"><input name="perioddate" type="text" id="perioddate" onfocus="HS_setDate(this)" size="21" value="<?=$product['perioddate']?>" /></td> </tr>
<tr> <td bgcolor="#F8F8F8">最少需要多少人购买才算团购成功：</td> <td align="right" bgcolor="#FFFFFF"><input name="successnum" type="text" id="successnum" value="<?=$product['successnum']?>" />（若是秒杀则强制为0）</td> </tr>
<tr> <td bgcolor="#F8F8F8">一次最多买多少产品：</td> <td align="right" bgcolor="#FFFFFF"><input name="oncemax" type="text" id="oncemax" value="<?=$product['oncemax']?>" /><span style="color:red;">*0表示不限制</span></td> </tr>
<tr> <td bgcolor="#F8F8F8">是否显示：</td> <td align="right" bgcolor="#FFFFFF"><input name="display" type="checkbox" id="display" value="1" 
<? if($product['display']==1) { ?>
 checked 
<? } ?>
 /></td> </tr>
<tr> <td bgcolor="#F8F8F8">详细信息：</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="content" style="width:540px; height:200px;" id="content"><?=$product['content']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">特别提示：</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="cue" style="width:540px; height:200px;" id="content"><?=$product['cue']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">他们说：</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="theysay" style="width:540px; height:200px;" id="content"><?=$product['theysay']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">舍内团秒说：</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="wesay" style="width:540px; height:200px;" id="content"><?=$product['wesay']?></textarea> </div> </td> </tr>
</table> <br> <center><input type="hidden" name="id" value="<?=$product['id']?>"><input type="submit" class="button" name="addsubmit" value="提 交"></center> </form>
<? include $this->TemplateHandler->template('admin/footer'); ?>