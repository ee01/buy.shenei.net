<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<script language="javascript">
function checkEmail(email){
if(email=='')return false;
var emailRegExp = new RegExp(            "[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('email��ַ��ʽ������Ŷ~~');
$('#email').val('');
return false;
}else{
//���ӷ�������֤�Ƿ��Ѿ�����
$.get("/ajax.php", { mod: "check", code: "email" ,email:$("#email").val() },
function(data){
if(data==1){
alert('email��ַ�Ѿ���ע����~~');
$('#email').val('');
return false;
}
}
); 
return true;
}
}
function checkuname(){
if($("#truename").val()=='')return false;
$.get("/ajax.php", { mod: "check", code: "truename" ,username:$("#truename").val() },
function(data){
if(data==1){
alert('�û����Ѿ���ע����~~');
$('#truename').val('');
return false;
}
}
);
}
function check(){
if($('#email').val()==''){
alert('���������ĳ���Email��ַ');
return false;
}
if($('#pwd').val()==''){
alert('��������������');
return false;
}
if($('#truename').val().replace(/[^\x00-\xff]/g,"**").length<4 || $('#truename').val().length>16){
alert('�û���������4λ��16λ');
return false;
}
if($('#pwd').val().length<4){
alert('�������4λ��');
return false;
}
if($('#pwd').val()!=$('#ckpwd').val()){
alert('�����������벻һ��');
return false;
}
if($('#truename').val()==''){
alert('�û���������Ϊ��Ŷ');
return false;
}
return true;
}
</script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">ע��</p>
<div class="sect">
<p>����<a href="http://www.shenei.net" target="_blank">������</a>���˺ţ�����ע���ֱ��<a href="/login">��¼</a>�ޣ�</p>
<form action="<?=$action?>" method="post"  onsubmit="return check();" enctype="multipart/form-data" >
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="nleftL">
<div class="field">
<label>E-mail</label>
<input type="text" name="email" id="email"  class="f_input" value="<?=$email?>" onblur="checkEmail(this.value);"  size="30"><span class="require">*</span>
<span class="hint">��¼���һ�������</span> </div>
<div class="field">
<label>�û���</label>
<input type="text" name="truename" id="truename" onblur="checkuname();" class="f_input"size="30"><span class="require">*</span>
<span class="hint">4-16 ���ַ���һ������Ϊ�����ַ�</span> </div>
<div class="field">
<label>����</label>
<input name="pwd" type="password" class="f_input" id="pwd"  size="30"><span class="require">*</span>
<span class="hint">���� 4 ���ַ�</span> </div>
<div class="field">
<label>ȷ������</label>
<input name="ckpwd" type="password" class="f_input" id="ckpwd"  size="30"><span class="require">*</span>
</div>
<div class="field">
<label>�ֻ�</label>
<input type="text" name="phone" id="phone" class="f_input"size="30"><span class="require">*</span>
<span class="hint">�������д��ȷ������ɹ�ʱ�����ϵ</span> </div>
<div class="field">
<label>�ѣ�</label>
<input type="text" name="qq" id="qq" class="f_input"size="30">
<span class="hint">����д����QQ���룬����ͷ�������ϵ</span> </div>
<div class="field">
<label>���ڳ���</label>
<select name="city" class="f_product" id="city" >
<? if(is_array($city)) { foreach($city as $i => $value) { ?>
<option  value="<?=$value['cityid']?>"><?=$value['cityname']?></option>
<? } } ?>
<option value="0">����</option>
</select>
<select name="school" class="f_product" id="school">
<option value="">����ѧУ</option>
<option  value="���ݴ�ѧ">���ݴ�ѧ</option>
<option  value="��������ѧԺ">����ѧԺ</option>
<option  value="����ʦ����ѧ">ʦ����ѧ</option>
<option  value="ҽ�ƴ�ѧ">ҽ�ƴ�ѧ</option>
<option  value="��ҽѧԺ">��ҽѧԺ</option>
<option  value="����ѧԺ">����ѧԺ</option>
<option  value="����Ů��ѧԺ">����Ů��</option>
<option  value="����ѧԺ">����ѧԺ</option>
<option  value="ũ�ִ�ѧ">ũ�ִ�ѧ</option>
</select>
</div>
<div class="field">
<label>��ϸ��ַ</label>
<input type="text" name="address" id="address"  class="f_input" size="30">
<span class="hint">�����д ���ڽ��ף� ���磺��������ѧԺ����E2#416</span> </div>
<div class="field autologin">
<input name="showemail" type="checkbox" class="f_check" id="showemail" value="1" checked="checked" >
����ÿ�������Ź���Ϣ 
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="ע��">
</div>
</div>
</form>
</div>
</div>
</div>  </div>
<div class="t_r">
<div class="t_area_out">
<h1>����<?=$this->Config['site_name']?>�ʻ���</h1>
<div class="t_area_in">
<p>��ֱ��<a href="/login">��¼</a>��</p>
</div>
</div>
<div class="t_area_out">
<h1>�����������˺ţ�</h1>
<div class="t_area_in">
<p>Ҳ��ֱ��<a href="/login">��¼</a>��</p>
<p>�ر����ѣ�<br>����������ͨ��֤���ơ����а������ڼ�԰���������ꡢ������Ϣ���˺Ŷ�����ͨ�ã�</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>