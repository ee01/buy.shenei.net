<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">我的团购券</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">我的订单</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">我的余额</a></li>
<li class="ts3_mbtn1"><a href="/myself/info">账户设置</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn2"><a href="/myself/face">我的头像</a></li>
<? } ?>
</ul>
<div class="clear"></div>
</div>
<div class="t_area_out">
<div class="t_area_in">
<script language="javascript">
function checkpwd(){
if($('#truename').val()==''){
alert('用户名不可以为空哦');
return false;
}	
if($('#newpwd').val() != $('#confirmpwd').val()){
alert('两次密码输入不一致');
return false;
}
return true;
}
</script>
<div class="nleftL">
<form method="post"  action="<?=$action?>" onsubmit="return checkpwd()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<div class="field">
<label>用户名</label>
<input type="text" name="username" readonly style="background:#FFFF99;" id="username" value="<?=$order['username']?>" class="f_input"size="30">
</div>
<div class="field">
<label>新密码</label>
<input type="password" name="newpwd" id="newpwd" class="f_input"  size="30">
<span class="hint">如果不想修改密码，请保持空白</span> 
</div>
<div class="field">
<label>确认密码</label>
<input type="password" name="confirmpwd" id="confirmpwd" class="f_input"  size="30">
</div>
<div class="field">
<label>手机</label>
<input type="text" name="phone" value="<?=$order['phone']?>" class="f_input"  size="30">
</div>
<div class="field">
<label>ＱＱ</label>
<input type="text" name="qq" value="<?=$order['qq']?>" class="f_input"  size="30">
</div>
<div class="field">
<label>E-mail</label>
<input type="text" name="email" value="<?=$order['email']?>" class="f_input"  size="30">
</div>
<div> <div class="field">
<label>订阅邮件</label>
<input type="checkbox" name="showemail" value="1" 
<? if($order['showemail']==1) { ?>
checked
<? } ?>
 />
订阅<?=$this->Config['site_name']?>信息了解<select name="city" class="f_product" id="city" >
<? if(is_array($city)) { foreach($city as $i => $value) { ?>
<option  value="<?=$value['cityid']?>"><?=$value['cityname']?></option>
<? } } ?>
<option value="0">其他</option>
</select><?=$this->Config['site_name']?>动态</div>
</div>
<div class="field">
<label>详细地址</label>
<input type="text" name="address" id="address" value="<?=$order['address']?>"  class="f_input" size="30">
<span class="hint">务必填写 便于交易！ 例如：福建工程学院北区E2#416</span> </div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="修改">
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