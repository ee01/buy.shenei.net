<script language="javascript">
function checkEmail2(email){
var emailRegExp = new RegExp(            "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('Email地址格式错误！');
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
<h1>邮件订阅</h1>
<div id="emailcontain" style="margin-top: 0pt;" class="t_area_in">
订阅下期团购信息
<form style="float: left; clear: both;" action="/channel/sendemail" method="post"  onsubmit="return check2()" enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<input name="email" id="email2" type="text" class="email" size="30" /> 
<input name="add" type="submit"  value="" class="btn_dy"/>  
<input name="del" type="submit"  value="" class="btn_td"/>
</form>
<br>
有新惊喜我们会用邮件通知您。<br>
<span class="orange">*此服务可以随时取消</span>
</div>
</div>