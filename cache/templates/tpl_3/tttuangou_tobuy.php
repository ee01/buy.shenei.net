<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">�Ź�ָ��</p>
<div class="sect guide">
<ul class="guide_steps">
<li>
<h3 class="step1">�鿴�����Ź�</h3>
<p class="text">����ÿ���Ƴ�һ����Ʒ���ѣ�������ҳ���ɿ�����Ҳ����ͨ���ʼ����ĵڶ������Ϣ��</p>
</li>
<li>
<h3 class="step2">����</h3>
<p class="text"> �Ա��ڵ��Ź�����Ȥ��ֻҪ�������ť��������ʾ������о�OK�� <img style="margin-left: -9px;" src="/templates/default/images/buy_guide.gif" width="290px;" height="200px;"> </p>
<div class="bubble">
<div class="bubble_top">
<ol class="buy">
<li>�Ź�����ֹʱ��ͽ������е��Ź������������ޣ��ȵ��ȵã�</li>
<li>�Ź��������������������һ������ɣ����ܻ��<?=$this->config['default_payfinder']?> Ԫ������</li>
<li class="last">�Ź�����ʱ��δ�ﵽ�������Ҫ�����Ź���ʧ���ˣ����ǻ�����ȫ���˿</li>
</ol>
</div>
<div class="bubble_bottom"></div>
</div>
</li>
<li>
<h3 class="step3">��ȡ�Ź�ȯ������</h3>
<p class="text"> �Ź��ɹ���Ϳɡ��ҵ����롱ҳ��鿴��<img style="margin-left: -9px;" src="/templates/default/images/buy_yhq.gif" ></p>
<div class="bubble">
<div class="bubble_top"> ��ȡ�Ź��Ź�ȯ�����ַ�ʽ��
<ol class="coupon">
<li><strong>�ֹ���¼</strong><br>
<p>��¼���Ź�ȯ�����뼴��</p>
</li>
<li><strong>���ߴ�ӡ</strong>
<p>��ӡ�Ź��Ź�ȯֱ�ӳ�ʾ</p>
</li>
</ol>
</div>
<div class="bubble_bottom"></div>
</div>
</li>
<li>
<h3 class="step4">ȥ�̼�����</h3>
<p class="text"> ��¼���Ź�ȯ�����룬����Ч����ȥ�̼����ѣ�����֪�̼ҽ��к˶Ժ����ѣ� </p>
</li>
</ul>
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