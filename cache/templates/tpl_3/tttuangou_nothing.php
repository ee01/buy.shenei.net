<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden;_width:695px; _height:100%">
<p class="cur_title"><?=$this->Title?></p>
<div class="sect">
<p class="B R">今日暂时没有<?=$TITLE?>信息，你可以：</p>
<? if($type) { ?>
<div class="enter_address" style="width:610px">
<? if($type==1) { ?>
<p class="B2">虽然今天没有惊心动魄的秒杀，我们可以去看看超值低价的团购啊！</p><? } elseif($type==2) { ?><p class="B2">虽然今天没有惊心动魄的秒杀，我们可以去看看超值低价的团购啊！</p>
<? } ?>
<div class="enter_address_c">
<input type="button" value="今日<?=$TITLE_?>" onclick="window.location='?mod=index&type=<?=$type_?>'" class="formbutton formbutton_extra">
<input type="button" value="往日团购" onclick="window.location='?mod=list&code=backlist&type=GroupBuy'" class="formbutton formbutton_extra">
<input type="button" value="往日秒杀" onclick="window.location='?mod=list&code=backlist&type=SecKills'" class="formbutton formbutton_extra">
<!--<input type="button" value="往日团秒" onclick="window.location='?mod=list&code=backlist'" class="formbutton formbutton_extra">
<input type="button" value="更多团购" onclick="window.open('http://shop.shenei.net/?app=search&act=groupbuy')" class="formbutton formbutton_extra" style="margin-right:0px">-->
</div>
</div>
<? } ?>
<div class="enter_address" style="width:610px">
<p class="B2">到其他地方逛逛吧～</p>
<div class="enter_address_c">
<input type="button" value="更多团购" onclick="window.open('http://shop.shenei.net/?app=search&act=groupbuy')" class="formbutton formbutton_extra">
<input type="button" value="学生网店" onclick="window.open('http://shop.shenei.net')" class="formbutton formbutton_extra">
<input type="button" value="交流Home" onclick="window.open('http://u.shenei.net')" class="formbutton formbutton_extra">
<input type="button" value="免费信息" onclick="window.open('http://xx.shenei.net')" class="formbutton formbutton_extra" style="margin-right:0px">
<BR>
<style type="text/css">
a { color: #2C629E; text-decoration: none; }
a:hover { text-decoration: underline; }
.line_list li { padding: 5px 10px 5px 10px; border-bottom: 1px solid #ECF1F3; }
    .line_list img { margin: 0 2px 0 0; vertical-align: middle; }
</style>
<div style="margin:20px 0px 0px 25px;"><SPAN id=feed>&nbsp;网站动态载入中...</SPAN></div>
</div>
</div>
<div class="enter_address">
<p class="B2"><?=$this->Config['site_name']?>运行中，今天暂时没有<?=$TITLE?>。欢迎通过邮件订阅最新团秒信息，或明天再来看！</p>
<div class="enter_address_c">
<form action="<?=$action?>" enctype="multipart/form-data" method="post"  onsubmit="return check()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<script language="javascript">
function checkEmail(email){
var emailRegExp = new RegExp(            "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('email地址格式错误了哦~~');
$('#email').val('');
}else{
return true;
}
}
function check(){
if(!checkEmail($('#email').val())){
return false;
}
return true;
}
</script>
<div class="mail">
<label>邮件地址：</label>
<input name="email" type="text" class="f_input f_mail" id="email" size="20">
<span class="tip">邮件地址不会被公开或发垃圾邮件。</span> 
</div>
<div class="product">
<label>选择您关注的城市：</label>
<select name="city" style="text" class="f_product">
<? if(is_array($this->cityary)) { foreach($this->cityary as $i => $value) { ?>
<option value="<?=$value['cityid']?>" 
<? if($this->city==$value['cityid']) { ?>
selected
<? } ?>
><?=$value['cityname']?></option>
<? } } ?>
</select>
&nbsp;&nbsp;
<input type="submit" value="订阅" class="formbutton">
</div>
</form>
</div>
</div>
<p></p>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>团秒问答</h1>
<div class="t_area_in"> <a target="_blank" href="/channel/question#q_form">我要提问</a> | <a target="_blank" href="/channel/question">查看全部</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?>？</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>
<!----解决动态载入延迟 Add By 01----->
<SPAN id=feed_>
<script language="javascript" type="text/javascript" src="http://u.shenei.net/js.php?id=2"></script>
</SPAN>
<SCRIPT>feed.innerHTML=feed_.innerHTML;feed_.innerHTML="";</SCRIPT>