<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">�Ź�ȯ��ѯ</p>
<div class="sect">
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="nleftL">
<div class="field">
<label>�Ź�ȯ��ţ�</label>
<input type="text" name="number" value="" class="f_input"  size="30">
<span class="hint">��ѯ����Ҫ����</span>
</div>
<div class="field">
<label>�Ź�ȯ���룺</label>
<input type="password" name="password" class="f_input"  size="30">
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton" name='submit'  value="��ѯ">
<input type="submit" class="formbutton left10" name='submit'  value="���ѣ������룩">
</div>
</div>
</form>
</div>
</div>
</div>
</div> 
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>��û��<?=$this->Config['site_name']?>�ʻ�</h1>
<div class="t_area_in">
<p><a href="/myself/register">����ע��</a>������30�룡</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>