<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">��������</p>
<div class="sect">
<ol class="faqlist2">
<li>
<p><?=$this->config['joinus']?></p>
</li>
</ol>
</div>
</div>
</div>
</div>
<div class="t_r">
<? include $this->TemplateHandler->template("tttuangou_myfinder"); ?>
<div class="t_area_out">
<h1>�����ʴ�</h1>
<div class="t_area_in"> <a target="_blank" href="/">��Ҫ����</a> | <a target="_blank" href="/">�鿴ȫ��</a> 
<? if(is_array($question)) { foreach($question as $i => $value) { ?>
 <a target="_blank" class="txt13" href="/"><?=$value['content']?>��</a> 
<? } } ?>
 </div>
</div>
<? include $this->TemplateHandler->template('tttuangou_mail'); ?>
</div>
</div>
<? include $this->TemplateHandler->template('tttuangou_footer'); ?>