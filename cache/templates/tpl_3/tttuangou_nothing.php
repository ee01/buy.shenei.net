<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden;_width:695px; _height:100%">
<p class="cur_title"><?=$this->Title?></p>
<div class="sect">
<p class="B R">������ʱû��<?=$TITLE?>��Ϣ������ԣ�</p>
<? if($type) { ?>
<div class="enter_address" style="width:610px">
<? if($type==1) { ?>
<p class="B2">��Ȼ����û�о��Ķ��ǵ���ɱ�����ǿ���ȥ������ֵ�ͼ۵��Ź�����</p><? } elseif($type==2) { ?><p class="B2">��Ȼ����û�о��Ķ��ǵ���ɱ�����ǿ���ȥ������ֵ�ͼ۵��Ź�����</p>
<? } ?>
<div class="enter_address_c">
<input type="button" value="����<?=$TITLE_?>" onclick="window.location='?mod=index&type=<?=$type_?>'" class="formbutton formbutton_extra">
<input type="button" value="�����Ź�" onclick="window.location='?mod=list&code=backlist&type=GroupBuy'" class="formbutton formbutton_extra">
<input type="button" value="������ɱ" onclick="window.location='?mod=list&code=backlist&type=SecKills'" class="formbutton formbutton_extra">
<!--<input type="button" value="��������" onclick="window.location='?mod=list&code=backlist'" class="formbutton formbutton_extra">
<input type="button" value="�����Ź�" onclick="window.open('http://shop.shenei.net/?app=search&act=groupbuy')" class="formbutton formbutton_extra" style="margin-right:0px">-->
</div>
</div>
<? } ?>
<div class="enter_address" style="width:610px">
<p class="B2">�������ط����ɡ�</p>
<div class="enter_address_c">
<input type="button" value="�����Ź�" onclick="window.open('http://shop.shenei.net/?app=search&act=groupbuy')" class="formbutton formbutton_extra">
<input type="button" value="ѧ������" onclick="window.open('http://shop.shenei.net')" class="formbutton formbutton_extra">
<input type="button" value="����Home" onclick="window.open('http://u.shenei.net')" class="formbutton formbutton_extra">
<input type="button" value="�����Ϣ" onclick="window.open('http://xx.shenei.net')" class="formbutton formbutton_extra" style="margin-right:0px">
<BR>
<style type="text/css">
a { color: #2C629E; text-decoration: none; }
a:hover { text-decoration: underline; }
.line_list li { padding: 5px 10px 5px 10px; border-bottom: 1px solid #ECF1F3; }
    .line_list img { margin: 0 2px 0 0; vertical-align: middle; }
</style>
<div style="margin:20px 0px 0px 25px;"><SPAN id=feed>&nbsp;��վ��̬������...</SPAN></div>
</div>
</div>
<div class="enter_address">
<p class="B2"><?=$this->Config['site_name']?>�����У�������ʱû��<?=$TITLE?>����ӭͨ���ʼ���������������Ϣ����������������</p>
<div class="enter_address_c">
<form action="<?=$action?>" enctype="multipart/form-data" method="post"  onsubmit="return check()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<script language="javascript">
function checkEmail(email){
var emailRegExp = new RegExp(            "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
if (!emailRegExp.test(email)||email.indexOf('.')==-1){
alert('email��ַ��ʽ������Ŷ~~');
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
<label>�ʼ���ַ��</label>
<input name="email" type="text" class="f_input f_mail" id="email" size="20">
<span class="tip">�ʼ���ַ���ᱻ�����������ʼ���</span> 
</div>
<div class="product">
<label>ѡ������ע�ĳ��У�</label>
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
<input type="submit" value="����" class="formbutton">
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
<h1>�����ʴ�</h1>
<div class="t_area_in"> <a target="_blank" href="/channel/question#q_form">��Ҫ����</a> | <a target="_blank" href="/channel/question">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/channel/question#id<?=$value['id']?>"><?=$value['content']?>��</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>
<!----�����̬�����ӳ� Add By 01----->
<SPAN id=feed_>
<script language="javascript" type="text/javascript" src="http://u.shenei.net/js.php?id=2"></script>
</SPAN>
<SCRIPT>feed.innerHTML=feed_.innerHTML;feed_.innerHTML="";</SCRIPT>