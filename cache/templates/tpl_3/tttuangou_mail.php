<script language="javascript">
function checkEmail2(email){
var emailRegExp = new RegExp(            "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('Email��ַ��ʽ����');
$('#email2').val('');
}else{
return true;
}
}
function check2(){
if(!checkEmail2($('#email2').val())){
return false;
}
return true;
}
</script>
<div class="t_area_out">
<h1>�ʼ�����</h1>
<div id="emailcontain" style="margin-top: 0pt;" class="t_area_in">
���������Ź���Ϣ
<form style="float: left; clear: both;" action="/channel/sendemail" method="post"  onsubmit="return check2()" enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<input name="email" id="email2" type="text" class="email" size="30" /> 
<input name="add" type="submit"  value="" class="btn_dy"/>  
<input name="del" type="submit"  value="" class="btn_td"/>
</form>
<br>
���¾�ϲ���ǻ����ʼ�֪ͨ����<br>
<span class="orange">*�˷��������ʱȡ��</span>
</div>
</div>