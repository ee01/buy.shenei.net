<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<script language="javascript">
function check(){
if($('#name').val()=='' || $('#phone').val()=='' || $('#content').val()==''){
alert('�뽫������Ϣ��д������лл��');
return false;
}
return true;
}
</script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">�������</p>
<div class="sect">
<div class="nleftL">
�ر�ӭ�����̼ҡ��Ա��������ṩ�Ź���Ϣ��
<div class="field">
<form action="/home/doteamwork" method="post"  onsubmit="return check()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<label>���ĳƺ�</label>
<input type="text" name="name" id="name"  class="f_input" value=""  size="30">
</div>
<div class="field">
<label>���ĵ绰</label>
<input type="text" name="phone" id="phone" onblur="checkuname();" class="f_input"size="30">
</div>
<div class="field">
<label>������ϵ��ʽ</label>
<input name="elsecontat" type="text" class="f_input" id="elsecontat"  size="30">
<span class="hint">�����������ֻ���QQ�Ż����䣬������ϵ</span> 
</div>
<div class="field">
<label>�Ź�����</label>
<textarea name="content" id="content" rows="5" cols="80" class="f-textarea"></textarea>
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="�ύ">
</div>
</div>
</form>
</div>
</div>
</div>  </div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����ʴ�</h1>
<div class="t_area_in"> <a target="_blank" href="/">��Ҫ����</a> | <a target="_blank" href="/">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/"><?=$value['content']?>��</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>