<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden;_width:695px; _height:100%">
<p class="cur_title"><?=$this->Title?></p>
<div class="sect">
<p class="B2">�ʼ�Ԥ������������Ϣ���˽������һ����Ѷ��</p>
<div class="enter_address">
<p class="B2 R"><?=$this->Config['site_name']?>�����У���ӭͨ���ʼ���������������Ϣ��</p>
<div class="enter_address_c">
<form action="<?=$action?>" enctype="multipart/form-data" method="post"  onsubmit="return check()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<script language="javascript">
function checkEmail(email){
var emailRegExp = new RegExp(            "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('email��ַ��ʽ������Ŷ~~');
$('#email').val('');
}else{
return true;
}
}
function check(){
if(!checkEmail($('#email').val())){
return false;
}
return true;
}
</script>
<div class="mail">
<label>�ʼ���ַ��</label>
<input name="email" type="text" class="f_input f_mail" id="email" size="20">
<span class="tip">�ʼ���ַ���ᱻ�����������ʼ���</span> 
</div>
<div class="product">
<label>ѡ������ע�ĳ��У�</label>
<select name="city" style="text" class="f_product">
<? if(is_array($this->cityary)) { foreach($this->cityary as $i => $value) { ?>
<option value="<?=$value['cityid']?>" 
<? if($this->city==$value['cityid']) { ?>
selected
<? } ?>
><?=$value['cityname']?></option>
<? } } ?>
</select>
&nbsp;&nbsp;
<input type="submit" value="����" class="formbutton">
</div>
</form>
</div>
</div>
<p></p>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����ʴ�</h1>
<div class="t_area_in"> <a target="_blank" href="/channel/question#q_form">��Ҫ����</a> | <a target="_blank" href="/channel/question">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?>��</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>