<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in" style="overflow:hidden; _width:695px;">
<p class="cur_title">团秒问答</p>
<ul class="consult_list" style="overflow:hidden">
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
<li>
<div class="item"><a name="id<?=$value['id']?>" id="id<?=$value['id']?>"></a>
<p class="user"><strong><?=$value['username']?></strong><span>
<? echo date('Y-m-d',$value['time']) ?>
</span></p>
<div class="clear"></div>
<p class="text"><?=$value['content']?></p>
<p class="reply"><strong>回复：</strong><?=$value['reply']?></p>
</div>
</li>
<? } } ?>
</ul>
<ul class="paginator">
<?=$page_arr?>
</ul>
<p class="cur_title">? 我要提问<a name="q_form" id="q_form"></a></p>
<? if(MEMBER_ID<=0) { ?>
<div class="sect">你还没有登录，请 <a href="/myself/register">注册</a> 或 <a href="/login">登录</a></div>
<? } else { ?><div class="sect"><?=MEMBER_NAME?>:你已经成功登陆，欢迎您发表提问！</div>
<? } ?>
<div class="sect consult">
<form action="<?=$action?>" enctype="multipart/form-data" method="post" >
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/>
<textarea name="question" rows="5" cols="80" class="f-textarea"></textarea>
<p class="commit">
<input type="submit" class="formbutton" name="commit" value="好了，提交">
</p>
</form>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>