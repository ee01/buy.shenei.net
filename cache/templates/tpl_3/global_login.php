<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<form method="POST"  action="<?=$action?>">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">��½</p>
<div class="sect">
<div class="nleftL">
<div class="field">
<label>�û���</label>
<input name="username" type="text"  class="f_input"/>
</div>
<div class="field">
<label>�ܡ���</label>
<input name="password" type="password" class="f_input" />
</div>
<div class="field autologin">
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="��¼">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="t_r">
<div class="t_area_out">
<h1>��û��<?=$this->Config['site_name']?>�ʻ�</h1>
<div class="t_area_in">
<p><a href="/myself/register">����ע��</a>������30�룡</p>
</div>
</div>
</div>
</form>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>