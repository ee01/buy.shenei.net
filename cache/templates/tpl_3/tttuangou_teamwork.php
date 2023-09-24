<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<script language="javascript">
function check(){
if($('#name').val()=='' || $('#phone').val()=='' || $('#content').val()==''){
alert('请将基本信息填写完整，谢谢！');
return false;
}
return true;
}
</script>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">商务合作</p>
<div class="sect">
<div class="nleftL">
特别欢迎优质商家、淘宝大卖家提供团购信息。
<div class="field">
<form action="/home/doteamwork" method="post"  onsubmit="return check()">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<label>您的称呼</label>
<input type="text" name="name" id="name"  class="f_input" value=""  size="30">
</div>
<div class="field">
<label>您的电话</label>
<input type="text" name="phone" id="phone" onblur="checkuname();" class="f_input"size="30">
</div>
<div class="field">
<label>其他联系方式</label>
<input name="elsecontat" type="text" class="f_input" id="elsecontat"  size="30">
<span class="hint">请留下您的手机、QQ号或邮箱，方便联系</span> 
</div>
<div class="field">
<label>团购内容</label>
<textarea name="content" id="content" rows="5" cols="80" class="f-textarea"></textarea>
</div>
<div class="clear"></div>
<div class="act">
<input type="submit" class="formbutton"  value="提交">
</div>
</div>
</form>
</div>
</div>
</div>  </div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>团秒问答</h1>
<div class="t_area_in"> <a target="_blank" href="/">我要提问</a> | <a target="_blank" href="/">查看全部</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/"><?=$value['content']?>？</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>