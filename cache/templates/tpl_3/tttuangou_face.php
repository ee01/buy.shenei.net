<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="ts_menu_2">
<ul>
<li class="ts3_mbtn2"><a href="/myself/ticket">�ҵ��Ź�ȯ</a></li>
<li class="ts3_mbtn2"><a href="/myself/order">�ҵĶ���</a></li>
<li class="ts3_mbtn2"><a href="/myself/money">�ҵ����</a></li>
<li class="ts3_mbtn2"><a href="/myself/info">�˻�����</a></li>
<? if(UCENTER) { ?>
<li class="ts3_mbtn1"><a href="/myself/face">�ҵ�ͷ��</a></li>
<? } ?>
</ul>
<div class="clear"></div>
</div>
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden;">
<div class="avatar">
<li><h1>��ǰ�ҵ�ͷ��</h1></li>
<li><img src="<?=UC_API?>/avatar.php?uid=<?=$usr['ucuid']?>&size=big" /></li>
<li><h1>�����ҵ���ͷ��</h1><h2>��ѡ��һ������Ƭ�����ϴ��༭��</h2></li>
<li>
<?=$face?>
<h2>��ʾ��ͷ�񱣴����������Ҫˢ��һ�±�ҳ��(��F5��)�����ܲ鿴���µ�ͷ��Ч����</h2></li>
</div>      
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>