<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">团购券查询</p>
<div class="sect">
<form action="<?=$action?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="nleftL">
<div class="field">
<label>团购券编号：</label>
<input type="text" name="number" value="" class="f_input"  size="30">
<span class="hint">查询不需要密码</span>
</div>
<div class="field">
<label>团购券密码：</label>
<input type="password" name="password" class="f_input"  size="30">
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton" name='submit'  value="查询">
<input type="submit" class="formbutton left10" name='submit'  value="消费（需密码）">
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
<h1>还没有<?=$this->Config['site_name']?>帐户</h1>
<div class="t_area_in">
<p><a href="/myself/register">立即注册</a>，仅需30秒！</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>