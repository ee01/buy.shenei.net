<? include $this->TemplateHandler->template("tttuangou_header"); ?>
<script language="javascript">
var time=<?=$product['time']?>;
</script>
<script language="javascript" src="/templates/default/js/time.js"></script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style=" _width:695px; *height:100%">
<table class="at_jrat">
<tbody>
<tr>
<td width="150px" style="color:#000000">今日团购：</td>
<td><?=$product['name']?></td>
</tr>
</tbody>
</table>
<div style="position: relative;" class="t_deal">
<div style="height: 160px; padding-top: 30px;" class="t_deal_l">
<div class="at_zk"><?=$product['agio']?></div>
原价<strong style="text-decoration: line-through;">&yen;<?=$product['price']?></strong><br>
节省&yen;<?=$product['price']-$product['nowprice']?>
<div class="at_buy"> 
<div class="deal_m">&yen; <?=$product['nowprice']?> </div>
<div class="deal_b"><a href="/home/buy/id-<?=$product['id']?>"><img src="/templates/default/images/logo_m.gif"></a> </div></div>
</div>
<div id="tuanState" style="float: left;" class="t_deal_l mb_0625">
<div style="text-align: center;"> <?=$product['num']?>人已购买<br>
<span class="txt12">数量有限行动要快哦</span><br>
<? if($product['success']<=0) { ?>
<img src="/templates/default/images/sue.gif" />
已达最低团购人数要求，团购成功，仍可继续购买
<? } else { ?>达成团购还需<?=$product['success']?>人 <BR>
<a <a href="
<? echo $this->Config['site_url'];  ?>
/?u=<?=MEMBER_ID?>" onclick="copyText(this.href);">邀请朋友一起买，返利<?=$this->config['default_payfinder']?>元</a>
<? } ?>
</div>
</div>
<div class="t_deal_l mb_0625"> 
剩余时间
<div class="deal_djs" id="remainTime"></div>
</div>
</div>
<script type="text/javascript">
function changeImg(mypic){
var xw=450;
var xl=268;
var width = mypic.width;
var height = mypic.height;
if (width > xw ) mypic.width = xw;
if (height > xl ) mypic.height = xl;
}
</script>
<div class="t_deal_r">  <div class="t_deal_r_img">
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
<h4>本单详情</h4>
<div class="t_detail_txt"><?=$product['content']?></div>
<h4>特别提示</h4>
<div class="t_detail_txt"><?=$product['cue']?></div>
<h4>他们说</h4>
<div class="t_detail_txt"><?=$product['theysay']?></div>
<div class="at_xts">
<div class="at_xts_t"><div class="sName"><?=$this->Config['site_name']?>说</div></div>
<div class="at_xts_m">
<p><span style="font-size: 14px;"><span style="font-family: 宋体;"><?=$product['wesay']?></span></span></p>
</div>
<div class="at_xts_f"></div></div>
</div>
<div class="t_detail_r">
<h1><?=$product['sellername']?></h1>
<b>地址：</b><?=$product['selleraddress']?><br/>
<b>电话：</b><?=$product['sellerphone']?><br/>
<a href="<?=$product['sellerurl']?>" target="_blank"><?=$product['sellerurl']?></a><br/>
<? if($sellermap['0']!='') { ?>
<button id="img1">查看地图</button>
<? } ?>
<div style="margin-top:50px;">
<h1>舍内团秒客服：</h1>
<p><a href="http://sighttp.qq.com/cgi-bin/check?sigkey=ae8441a8470085845e015a2386ae2554cbc2a14b09583b4e85956c1882786ba8"; target=_blank; onclick="var tempSrc='http://sighttp.qq.com/wpa.js?rantime='+Math.random()+'&sigkey=ae8441a8470085845e015a2386ae2554cbc2a14b09583b4e85956c1882786ba8';var oldscript=document.getElementById('testJs');var newscript=document.createElement('script');newscript.setAttribute('type','text/javascript'); newscript.setAttribute('id', 'testJs');newscript.setAttribute('src',tempSrc);if(oldscript == null){document.body.appendChild(newscript);}else{oldscript.parentNode.replaceChild(newscript, oldscript);}return false;"><img border="0" SRC='http://wpa.qq.com/pa?p=1:185813620:42' alt=""></a>
　<a href="tencent://Message/?menu=yes&exe=&uin=162053702&websiteName=舍内网&info=&Service=200&sigT=af83d1e019b73e472e9cd1dd8bfffec7c1483bba58aa993df11c8a477cdabe7395553151be3852dc" target="_blank"><img src="http://wpa.qq.com/pa?p=1:162053702:42" alt="QQ"></a></p>
<p><a href="tencent://Message/?menu=yes&exe=&uin=598618077&websiteName=舍内网&info=&Service=200&sigT=af83d1e019b73e472e9cd1dd8bfffec7c1483bba58aa993df11c8a477cdabe7395553151be3852dc" target="_blank"><img src="http://wpa.qq.com/pa?p=1:598618077:42" alt="QQ"></a>
　<a href="tencent://Message/?menu=yes&exe=&uin=834343007&websiteName=舍内网&info=&Service=200&sigT=af83d1e019b73e472e9cd1dd8bfffec7c1483bba58aa993df11c8a477cdabe7395553151be3852dc" target="_blank"><img src="http://wpa.qq.com/pa?p=1:834343007:42" alt="QQ"></a></p>
<font color="gray" size=2>注：QQ头像灰色很可能隐身！</font>
</div>

</div>
<div style="clear: both;"></div>
</div>
</div>
</div>
<div class="t_r">
<div class="t_area_out">
<div class="t_area_in" style="padding:5px" align="center">
<a href="/home/type-SecKills"><span style="font:bold 20px/40px Microsoft YaHei,Times New Roman;color:#f60;">去看看即将开始的秒杀</span></a>
</div>
</div>

<div class="t_area_out">
<div class="t_area_in" style="padding:5px">
<div class="at_lietuan">
<a href="http://lietuan.net" target="_blank"><img src="/templates/default/images/new/at_invite10.png"></a>
</div>
</div>
</div>
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>团秒问答</h1>
<div class="t_area_in"> <a target="_blank" href="/channel/question#q_form">我要提问</a> | <a target="_blank" href="/channel/question">查看全部</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?></a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? if($sellermap['0']!='') { ?>
<script type="text/javascript">
$(document).ready(function() {
$("#img1").click(function() {
tipsWindown("商家地图","img:http://ditu.google.cn/staticmap?center=<?=$sellermap['0']?>,<?=$sellermap['1']?>&zoom=<?=$sellermap['2']?>&size=512x512&maptype=mobile&markers=<?=$sellermap['0']?>,<?=$sellermap['1']?>,reda&key=<?=$this->config['default_googlemapkey']?>&sensor=false","512","512","true","","true","img")
});
});
</script>
<? } ?>
<? include $this->TemplateHandler->template("tttuangou_footer"); ?>