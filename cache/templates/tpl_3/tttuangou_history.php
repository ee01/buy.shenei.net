<? include $this->TemplateHandler->template("tttuangou_header"); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style=" _width:695px; _height:100%">
<table class="at_jrat">
<tbody>
<tr>
<td width="150px" style="color:#000000">����<?=$TITLE?>��</td>
<td><?=$product['name']?></td>
</tr>
</tbody>
</table>
<div style="position: relative;" class="t_deal">
<div style="height: 160px; padding-top: 30px;" class="t_deal_l">
<div class="at_zk"><?=$product['agio']?></div>
ԭ��<strong style="text-decoration: line-through;">&yen;<?=$product['price']?></strong><br>
��ʡ&yen;<?=$product['price']-$product['nowprice']?>
<div class="at_buy">
<div class="deal_m">&yen; <?=$product['nowprice']?> </div>
<div class="deal_y"><img src="/templates/default/images/logo_m.gif"></div> </div>
</div>
<div id="tuanState" style="float: left;" class="t_deal_l">
<div style="text-align: center;">�����ڣ�<?=$product['overtime']?><br>
<span class="txt12"><b class="R">
<?=$product['num']?></b> �˹���<?=$TITLE?>�ѽ�����<br />
<?=$TITLE?>
<? if($product['success']<=0) { ?>
�ɹ�
<? } else { ?>ʧ��
<? } ?>
</span><br>
</div>
</div>
</div>
<script type="text/javascript">
function changeImg(mypic){
var xw=440;
var xl=268;
var width = mypic.width;
var height = mypic.height;
if (width > xw ) mypic.width = xw;
if (height > xl ) mypic.height = xl;
}
</script>
<div class="t_deal_r">           <div class="t_deal_r_img">
<img src="images/product/<?=$product['img']?>" onload="changeImg(this)" />
</div>
<div style="height: 150px; margin: 10px 0pt; clear: both;">
<p><?=$product['intro']?></p>
</div>
</div>
<div style="clear: both; height: 0px;">&nbsp;</div>
</div>
</div>
<div class="t_area_out">
<div style="position: relative;" class="t_area_in t_padding">
<div class="t_detail_l">
<h4>��������</h4>
<div class="t_detail_txt"><?=$product['content']?></div>
<h4>�ر���ʾ</h4>
<div class="t_detail_txt"><?=$product['cue']?></div>
<h4>����˵</h4>
<div class="t_detail_txt"><?=$product['theysay']?></div>
<div class="at_xts">
<div class="at_xts_t"><div class="sName"><?=$this->Config['site_name']?>˵</div></div>
<div class="at_xts_m">
<p><span style="font-size: 14px;"><span style="font-family: ����;"><?=$product['wesay']?></span></span></p>
</div>
<div class="at_xts_f"></div></div>
</div>
<div class="t_detail_r">
<h1><?=$product['sellername']?></h1>
<b>��ַ��</b><?=$product['selleraddress']?><br/>
<b>�绰��</b><?=$product['sellerphone']?><br/>
<a href="<?=$product['sellerurl']?>" target="_blank"><?=$product['sellerurl']?></a><br/>
<? if($sellermap['0']!='') { ?>
<button id="img1">�鿴��ͼ</button>
<? } ?>
 </div>
<div style="clear: both;"></div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����ʴ�</h1>
<div class="t_area_in"> <a target="_blank" href="/channel/question#q_form">��Ҫ����</a> | <a target="_blank" href="/channel/question">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?></a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$("#img1").click(function() {
tipsWindown("�̼ҵ�ͼ","img:http://ditu.google.cn/staticmap?center=<?=$sellermap['0']?>,<?=$sellermap['1']?>&zoom=<?=$sellermap['2']?>&size=512x512&maptype=mobile&markers=<?=$sellermap['0']?>,<?=$sellermap['1']?>,reda&key=<?=$this->config['default_googlemapkey']?>&sensor=false","512","512","true","","true","img")
});
});
</script>
<? include $this->TemplateHandler->template("tttuangou_footer"); ?>