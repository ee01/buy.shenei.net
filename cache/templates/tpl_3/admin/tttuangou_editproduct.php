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
//����һ����������д��
function AddSignRow(rowID0){
	//��ȡ���һ�е��кţ������txtTRLastIndex�ı����� 
	var txtTRLastIndex = findObj("txtTRLastIndex",document);
	var rowID = parseInt(txtTRLastIndex.value);
	var rowID2 = rowID + rowID0;

	var signFrame = findObj("pricetable",document);
	//������
	var newTR = signFrame.insertRow(signFrame.rows.length);
	newTR.id = "SignItem" + rowID;
	//������:�Ӳ�Ʒ��
	var newNameTD=newTR.insertCell(0);
	//����������
	newNameTD.innerHTML = "<input name='name" + rowID2 + "' id='name" + rowID2 + "' type='text' size='80' value='<?=$value['name']?>' />";

	//������:ԭ��
	var newEmailTD=newTR.insertCell(1);
	//����������
	newEmailTD.innerHTML = "<input name='price" + rowID2 + "' id='price" + rowID2 + "' type='text' size='6' value='<?=$value['price']?>' />Ԫ";

	//������:�ּ�
	var newTelTD=newTR.insertCell(2);
	//����������
	newTelTD.innerHTML = "<input name='nowprice" + rowID2 + "' id='nowprice" + rowID2 + "' type='text' size='6' value='<?=$value['nowprice']?>' />Ԫ";

	//������:����
	var newMobileTD=newTR.insertCell(3);
	//����������
	newMobileTD.innerHTML = "<input name='earnest" + rowID2 + "' id='earnest" + rowID2 + "' type='text' size='6' value='<?=$value['earnest']?>' />Ԫ";

	//������:ɾ����ť
	var newDeleteTD=newTR.insertCell(4);
	//����������
	newDeleteTD.innerHTML = "<div align='center' style='width:40px'><a href='javascript:;' onclick=\"DeleteSignRow('SignItem" + rowID + "')\">ɾ��</a></div>";

	//���к��ƽ���һ��
	txtTRLastIndex.value = (rowID + 1).toString() ;
}
//ɾ��ָ����
function DeleteSignRow(rowid){
	var signFrame = findObj("pricetable",document);
	var signItem = findObj(rowid,document);

	//��ȡ��Ҫɾ�����е�Index
	var rowIndex = signItem.rowIndex;

	//ɾ��ָ��Index����
	signFrame.deleteRow(rowIndex);
/*
	//����������ţ����û����ţ���һ��ʡ��
	for(i=rowIndex;i<signFrame.rows.length;i++){
		signFrame.rows[i].cells[0].innerHTML = i.toString();
	}
*/
}//����б�
function ClearAllSign(){
	if (confirm('ȷ��Ҫ������в�������')) {
		var signFrame = findObj("pricetable",document);
		var rowscount = signFrame.rows.length;

		//ѭ��ɾ����,�����һ����ǰɾ��
		for(i=rowscount - 1;i > 0; i--){
			signFrame.deleteRow(i);
		}

		//��������к�Ϊ1
		var txtTRLastIndex = findObj("txtTRLastIndex",document);
		txtTRLastIndex.value = "1";
		
		//���ԭ���м���
		pricenum = 0;
		document.getElementById('txtTROriginalNum').value = 0;

		//Ԥ����һ��
		AddSignRow(0);
	}
}
</script>
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="2">�޸Ĳ�Ʒ</td> </tr>
<tr> <td width="23%" bgcolor="#F8F8F8">��Ʒ���ƣ�</td> <td width="77%" align="right" bgcolor="#FFFFFF"> <input name="name" type="text" id="name" size="80" value="<?=$product['name']?>"></td> </tr>
<tr> <td bgcolor="#F8F8F8">�Ź���ɱ��</td> <td align="right" bgcolor="#FFFFFF"><label> <select name="is_seckill" id="is_seckill">
<option value=0 
<? if($product['is_seckill']==0) { ?>
selected
<? } ?>
>�Ź�</option>
<option value=1 
<? if($product['is_seckill']) { ?>
selected
<? } ?>
>��ɱ</option>
</select> </label></td> </tr>
<tr> <td bgcolor="#F8F8F8">������У�</td> <td align="right" bgcolor="#FFFFFF"><label> <select name="city" id="city">
<? if(is_array($city)) { foreach($city as $i => $value) { ?>
<option value="<?=$value['cityid']?>" 
<? if($product['city']==$value['cityid']) { ?>
selected
<? } ?>
><?=$value['cityname']?></option>
<? } } ?>
</select> </label></td> </tr>
<tr> <td bgcolor="#F8F8F8">�����̼ң�</td> <td align="right" bgcolor="#FFFFFF"> <select name="sellerid" id="sellerid">
<? if(is_array($seller)) { foreach($seller as $i => $value) { ?>
<option value="<?=$value['id']?>" 
<? if($product['sellerid']==$value['id']) { ?>
selected
<? } ?>
><?=$value['sellername']?></option>
<? } } ?>
</select> </td></tr>
<tr> <td bgcolor="#F8F8F8">ԭ�ۣ�</td> <td align="right" bgcolor="#FFFFFF"><input name="price" type="text" id="price" size="6" value="<?=$product['price']?>"/>Ԫ</td> </tr>
<tr> <td bgcolor="#F8F8F8">�ּۣ�</td> <td align="right" bgcolor="#FFFFFF"><input name="nowprice" type="text" id="nowprice" size="6" value="<?=$product['nowprice']?>" />Ԫ</td> </tr>
<tr> <td bgcolor="#F8F8F8">����</td> <td align="right" bgcolor="#FFFFFF"><input name="earnest" type="text" id="earnest" size="6" value="<?=$product['earnest']?>" />Ԫ</td> </tr>
<tr> <td bgcolor="#F8F8F8"><input name="useotherprice" type="checkbox" id="useotherprice" value="1" 
<? if($product['otherprice']) { ?>
 checked 
<? } ?>
 />�Ƿ����ù��[<a onclick="AddSignRow(pricenum)"><font color=red>����</font></a>&nbsp;<a onclick="ClearAllSign()"><font color=silver>���</font></a>]</td> <td align="right" bgcolor="#FFFFFF">
<table id="pricetable" cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder">
  <tr>
    <td width="40%">�Ӳ�Ʒ��</td>
    <td width="20%">ԭ��</td>
    <td width="20%">�ּ�</td>
    <td width="20%">����</td>
	<td>&nbsp;</td>
  </tr>
<? if(is_array($product['otherprice'])) { foreach($product['otherprice'] as $i => $value) { ?>
  <tr>
    <td><input name="name<?=$i?>" type="text" id="name<?=$i?>" size="80" value="<?=$value['name']?>"></td>
    <td><input name="price<?=$i?>" type="text" id="price<?=$i?>" size="6" value="<?=$value['price']?>"/>Ԫ</td>
    <td><input name="nowprice<?=$i?>" type="text" id="nowprice<?=$i?>" size="6" value="<?=$value['nowprice']?>" />Ԫ</td>
    <td><input name="earnest<?=$i?>" type="text" id="earnest<?=$i?>" size="6" value="<?=$value['earnest']?>" />Ԫ</td>
	<td>&nbsp;</td>
  </tr>
<? } } ?>
</table>
<input name='txtTROriginalNum' type='hidden' id='txtTROriginalNum' value="<?=$pricenum?>" />
<input name='txtTRLastIndex' type='hidden' id='txtTRLastIndex' value="1" />
</td> </tr>
<tr> <td bgcolor="#F8F8F8">��ƷͼƬ��</td> <td align="right" bgcolor="#FFFFFF"><input name="img" type="file" id="img" /></td> </tr>
<tr> <td bgcolor="#F8F8F8">��飺</td> <td align="right" bgcolor="#FFFFFF"><textarea name="intro" cols="40" rows="5" id="intro"><?=$product['intro']?></textarea></td> </tr>
<tr> <td bgcolor="#F8F8F8">��Ʒ�������ޣ�</td> <td align="right" bgcolor="#FFFFFF"><input name="maxnum" type="text" id="maxnum" value="<?=$product['maxnum']?>" /><span style="color:red;">*0��ʾ������</span></td> </tr>
<tr> <td bgcolor="#F8F8F8">���뿪ʼʱ�䣺</td> <td align="right" bgcolor="#FFFFFF"><input name="begintime" type="text" id="begintime" onfocus="HS_setDate(this)" size="21" value="<?=$product['begintime']?>" />�����趨����0�㿪ʼ��</td> </tr>
<tr> <td bgcolor="#F8F8F8">�������ʱ�䣺</td> <td align="right" bgcolor="#FFFFFF"><input name="overtime" type="text" id="overtime" onfocus="HS_setDate(this)" size="21" value="<?=$product['overtime']?>" />�����趨����0�������</td> </tr>
<tr> <td bgcolor="#F8F8F8">����ȯ��Ч�ڵĽ�ֹ���ڣ�</td> <td align="right" bgcolor="#FFFFFF"><input name="perioddate" type="text" id="perioddate" onfocus="HS_setDate(this)" size="21" value="<?=$product['perioddate']?>" /></td> </tr>
<tr> <td bgcolor="#F8F8F8">������Ҫ�����˹�������Ź��ɹ���</td> <td align="right" bgcolor="#FFFFFF"><input name="successnum" type="text" id="successnum" value="<?=$product['successnum']?>" />��������ɱ��ǿ��Ϊ0��</td> </tr>
<tr> <td bgcolor="#F8F8F8">һ���������ٲ�Ʒ��</td> <td align="right" bgcolor="#FFFFFF"><input name="oncemax" type="text" id="oncemax" value="<?=$product['oncemax']?>" /><span style="color:red;">*0��ʾ������</span></td> </tr>
<tr> <td bgcolor="#F8F8F8">�Ƿ���ʾ��</td> <td align="right" bgcolor="#FFFFFF"><input name="display" type="checkbox" id="display" value="1" 
<? if($product['display']==1) { ?>
 checked 
<? } ?>
 /></td> </tr>
<tr> <td bgcolor="#F8F8F8">��ϸ��Ϣ��</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="content" style="width:540px; height:200px;" id="content"><?=$product['content']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">�ر���ʾ��</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="cue" style="width:540px; height:200px;" id="content"><?=$product['cue']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">����˵��</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="theysay" style="width:540px; height:200px;" id="content"><?=$product['theysay']?></textarea> </div> </td> </tr>
<tr> <td bgcolor="#F8F8F8">��������˵��</td> <td align="right" bgcolor="#FFFFFF"> <div style="clear:both;"> <textarea name="wesay" style="width:540px; height:200px;" id="content"><?=$product['wesay']?></textarea> </div> </td> </tr>
</table> <br> <center><input type="hidden" name="id" value="<?=$product['id']?>"><input type="submit" class="button" name="addsubmit" value="�� ��"></center> </form>
<? include $this->TemplateHandler->template('admin/footer'); ?>