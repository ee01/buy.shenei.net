<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">��ӡ�ҵ��Ź�ȯ</p>
<div class="nleftL">
<div id="printArea">
<div class="quan" style="width:450px;padding:10px; margin:10px auto; border:#999999 2px solid; font-family:Tahoma,; text-align:left; overflow:hidden; background:#FFFFFF url(templates/default/images/new/deal_bg.png) no-repeat bottom right;">
<div class="qtitle" style="width:100%; float:left; height:50px; padding:5px 0; border-bottom:#ccc 1px solid;">
<div class="qlogo" style="float:left; width:240px; height:52px;"><img src="/templates/default/images/new/p_logo.gif" /></div>
<div class="qcode" style="float:right; font-size:12px; padding-top:23px;"><?=$this->Config['site_url']?></div>
</div>
<div class="qmt" style="width:100%; float:left;font-size:24px; line-height:24px; padding-top:10px;"><?=$order['name']?>
<? if($order['name2']) { ?>
 - <font size=4><?=$order['name2']?></font>
<? } ?>
</div>
<div class="qwarp" style="width:100%; padding-top:10px; margin:0; float:left; font-size:16px; line-height:25px;">
<div class="ql" style="width:100%; float:left; _display:inline">
<dl style="width:100%; float:left; padding:4px 0;">
<dt style=" width:65px; float:left;">�Ź�ȯ��</dt>
<dd style="width:365px; float:left; white-space:normal;">
<?=$order['number']?> &nbsp; �����룺<?=$pwd?>��
</dd>
</dl>
<dl>
<dt style=" width:65px; float:left;">�ؼۣ�</dt>
<dd style="width:365px; float:left; white-space:normal;"><span style="font-size:22px; font-family:"Times New Roman"; color:#FF0000;"><?=$order['nowprice']?></span> Ԫ / �� &nbsp; ����Ч�ڣ�<?=$order['perioddate']?>��</dd>
<dd style="width:365px; float:left; white-space:normal;"><span style="font-size:22px; font-family:"Times New Roman"; color:#FF0000;"><?=$order['earnest']?></span> Ԫ���� &nbsp; ����֧����</dd>
</dl>
<dl>
<dt style=" width:65px; float:left;">��ַ��</dt>
<dd style="width:365px; float:left; white-space:normal; "><?=$order['selleraddress']?></dd>
</dl>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function printme()
{
document.body.innerHTML=document.getElementById('printArea').innerHTML;
window.print();
}
</script>
<a href="javascript:printme()" target="_self" style=" font-size:14px;">��ӡ</a> </div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����Ź�ȯ</h1>
<div class="t_area_in" style="font-size:12px;">
<p>�Ź�ȯ����������Ʒ��Ψһƾ֤</p>
<p>�뱣�ܺ��Լ����Ź�ȯ������</p>
<p>�Ź�ȯֻ��һ��ʹ�û���</p>
<p>�Ź�ȯ��ʹ�����޹�������</p>
<p>�Ź�ȯ�����˿�</p>
<p>����Ա������Ҫ���Ĺ���ȯ</p>
</div>
</div>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>