<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<form method="POST"  action="<?=$action?>">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">登陆</p>
<div class="sect">
<div class="nleftL">
<div class="field">
<label>用户名</label>
<input name="username" type="text"  class="f_input"/>
</div>
<div class="field">
<label>密　码</label>
<input name="password" type="password" class="f_input" />
</div>
<div class="field autologin">
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="登录">
</div>
</div>
</div>
</div>
</div>
</div>
<div class="t_r">
<div class="t_area_out">
<h1>还没有<?=$this->Config['site_name']?>帐户</h1>
<div class="t_area_in">
<p><a href="/myself/register">立即注册</a>，仅需30秒！</p>
</div>
</div>
</div>
</form>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>