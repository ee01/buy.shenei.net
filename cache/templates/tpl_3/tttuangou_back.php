<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<script type="text/javascript">
function changeImg(mypic){
var xw=200;
var xl=121;
var width = mypic.width;
var height = mypic.height;
if (width > xw ) mypic.width = xw;
if (height > xl ) mypic.height = xl;
}
</script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden; _width:695px; _height:90%;">
<p class="cur_title">����<?=$TITLE?></p>
<ul class="deal_list">
<? if(is_array($product)) { foreach($product as $i => $value) { ?>
<li>
<p class="time"><?=$value['begintime']?> - <?=$value['overtime']?></p>
<h4><a target="_blank" href="/channel/history/id-<?=$value['id']?>"><?=$value['name']?></a></h4>
<div class="pic2"> <a target="_blank" href="/channel/history/id-<?=$value['id']?>"><img src="images/product/<?=$value['img']?>" onload="changeImg(this)" /></a> </div>
<div class="info">
<p class="total"><strong class="count"><?=$value['totalnum']?></strong>�˹���</p>
<p class="price">ԭ�ۣ�<strong class="old">&yen;<?=$value['price']?></strong><br>
�ۿۣ�<strong class="discount">
<? echo round(10/($value['price']/$value['nowprice']),1) ?>
��</strong><br>
�ּۣ�<strong>&yen;<?=$value['nowprice']?></strong><br>
��ʡ��<strong>&yen;
<? echo ($value['price']-$value['nowprice']) ?>
</strong><br>
</p>
</div>
</li>
<? } } ?>
</ul>
<?=$page_arr?> 
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����ʴ�</h1>
<div class="t_area_in"><a target="_blank" href="/channel/question#q_form">��Ҫ����</a> | <a target="_blank" href="/channel/question">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?>��</a>
</li>
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>