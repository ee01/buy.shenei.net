<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">�ҵ��Ź�ȯ</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">�ҵĶ���</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">�ҵ����</a></li>
<li class="ts3_mbtn1"><a href="/myself/info">�˻�����</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn2"><a href="/myself/face">�ҵ�ͷ��</a></li>
<? } ?>
</ul>
<div class="clear"></div>
</div>
<div class="t_area_out">
<div class="t_area_in">
<script language="javascript">
function checkpwd(){
if($('#truename').val()==''){
alert('�û���������Ϊ��Ŷ');
return false;
}	
if($('#newpwd').val() != $('#confirmpwd').val()){
alert('�����������벻һ��');
return false;
}
return true;
}
</script>
<div class="nleftL">
<form method="post"  action="<?=$action?>" onsubmit="return checkpwd()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="field">
<label>�û���</label>
<input type="text" name="username" readonly style="background:#FFFF99;" id="username" value="<?=$order['username']?>" class="f_input"size="30">
</div>
<div class="field">
<label>������</label>
<input type="password" name="newpwd" id="newpwd" class="f_input"  size="30">
<span class="hint">��������޸����룬�뱣�ֿհ�</span> 
</div>
<div class="field">
<label>ȷ������</label>
<input type="password" name="confirmpwd" id="confirmpwd" class="f_input"  size="30">
</div>
<div class="field">
<label>�ֻ�</label>
<input type="text" name="phone" value="<?=$order['phone']?>" class="f_input"  size="30">
</div>
<div class="field">
<label>�ѣ�</label>
<input type="text" name="qq" value="<?=$order['qq']?>" class="f_input"  size="30">
</div>
<div class="field">
<label>E-mail</label>
<input type="text" name="email" value="<?=$order['email']?>" class="f_input"  size="30">
</div>
<div> <div class="field">
<label>�����ʼ�</label>
<input type="checkbox" name="showemail" value="1" 
<? if($order['showemail']==1) { ?>
checked
<? } ?>
 />
����<?=$this->Config['site_name']?>��Ϣ�˽�<select name="city" class="f_product" id="city" >
<? if(is_array($city)) { foreach($city as $i => $value) { ?>
<option  value="<?=$value['cityid']?>"><?=$value['cityname']?></option>
<? } } ?>
<option value="0">����</option>
</select><?=$this->Config['site_name']?>��̬</div>
</div>
<div class="field">
<label>��ϸ��ַ</label>
<input type="text" name="address" id="address" value="<?=$order['address']?>"  class="f_input" size="30">
<span class="hint">�����д ���ڽ��ף� ���磺��������ѧԺ����E2#416</span> </div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="�޸�">
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