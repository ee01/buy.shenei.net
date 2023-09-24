<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">我的团购券</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">我的订单</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">我的余额</a></li>
<li class="ts3_mbtn2"><a href="/myself/info">账户设置</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn1"><a href="/myself/face">我的头像</a></li>
<? } ?>
</ul>
<div class="clear"></div>
</div>
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden;">
<div class="avatar">
<li><h1>当前我的头像</h1></li>
<li><img src="<?=UC_API?>/avatar.php?uid=<?=$usr['ucuid']?>&size=big" /></li>
<li><h1>设置我的新头像</h1><h2>请选择一个新照片进行上传编辑。</h2></li>
<li>
<?=$face?>
<h2>提示：头像保存后，您可能需要刷新一下本页面(按F5键)，才能查看最新的头像效果。</h2></li>
</div>      
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>