<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">��������</p>
<div class="sect">
<ol class="faqlist">
<li>
<h4>�Ź���ʲô��</h4>
<p>�Ź�������֯һ����������ĳʱ���һ����ĳ��Ʒ��ֻҪ�չ�����Ź������������ܳ����ۿۡ�</p>
</li>
<li class="alt">
<h4>������Ź���������������ô����</h4>
<p>ֻ�����Ź���ֹʱ��֮ǰ���"����"��ť��������ʾ�¶������ѹ��򼴿ɡ�����μ��Ź������ﵽ����������ޣ����Ź��ɽ��������õ�ϵͳ�ʼ�֪ͨ����Ȼ�����ʱ�鿴���ҵ����롱ҳ�档</p>
</li>
<li>
<h4>�Ź�����Щ֧����ʽ��</h4>
<p>Ŀǰ֧��֧�������Ƹ�ͨ����������֧����ʽ��</p>
<div class="paytype">
<p class="alipay">�Ƽ�֧�����û�ʹ��</p>
<p class="tenpay">�Ƽ��Ƹ�ͨ�û�ʹ��</p>
<p class="chinabank">֧���������е�ת�˻��������֧��ҳ��</p>
</div>
</li>
<li class="alt">
<h4>�Ź��ɽ����һ��ܹ���ô��</h4>
<p>�Ź��ɽ����Կ��Լ�������ֱ���Ź���ֹʱ�䡣������ע������Ź����������ޣ�����Ϊֹ�� </p>
</li>
<li>
<h4>����μ��Ź��������㣬��ô�죿</h4>
<p>�����ֹ�Ź�ʱ����δ�ﵽ�Ź��������Ҫ����ô��Ź�ʧ�ܡ���֧���Ŀ�����ǽ��������������˺ţ����������κ���ʧ���������ϣ������Ź��ɽ���������������һ���������~</p>
</li>
<li class="alt">
<h4>ʲô���Ź��Ź�ȯ����ôʹ�ã�</h4>
<p>���Ź��ɹ��������ڡ��ҵ����롱ҳ���л���Ź�ȯ�����Լ���Ӧ���롣����ȥ�̼�����ʱ���ṩ�Ź��Ź�ȯ���������룩���ɣ�ÿ���Ź�ȯֻ��ʹ��һ�Σ���</p>
</li>
<li>
<h4>ʹ���Ź��Ź�ȯʱ����ͬʱ���������Ż�ô��</h4>
<p>һ�㲻���ԡ�������ԣ����ǻ����Ź���ʾ���ر�˵����</p>
</li>
<li class="alt">
<h4>�ҹ�����Ź��Ź�ȯ�����Ը�������ʹ��ô��</h4>
<p>��Ȼ���ԣ��������Ź�ȯ��������뼴�ɣ����ϲ����Ź�������/��һ����ϲ�� :)</p>
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