<? include $this->TemplateHandler->template('tttuangou_header'); ?>
<div class="m960">
<div class="t_l">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title">常见问题</p>
<div class="sect">
<ol class="faqlist">
<li>
<h4>团购是什么？</h4>
<p>团购就是组织一定的人数在某时间段一起购买某产品，只要凑够最低团购人数就能享受超低折扣。</p>
</li>
<li class="alt">
<h4>今天的团购看起来不错，怎么购买？</h4>
<p>只需在团购截止时间之前点击"购买"按钮，根据提示下订单付费购买即可。如果参加团购人数达到最低人数下限，则团购成交，您将得到系统邮件通知，当然你可随时查看“我的团秒”页面。</p>
</li>
<li>
<h4>团购有哪些支付方式？</h4>
<p>目前支持支付宝、财付通和网银三种支付方式：</p>
<div class="paytype">
<p class="alipay">推荐支付宝用户使用</p>
<p class="tenpay">推荐财付通用户使用</p>
<p class="chinabank">支持主流银行的转账汇款，详见购买支付页面</p>
</div>
</li>
<li class="alt">
<h4>团购成交后，我还能购买么？</h4>
<p>团购成交后，仍可以继续购买，直到团购截止时间。但是请注意个别团购有数量上限，卖完为止。 </p>
</li>
<li>
<h4>如果参加团购人数不足，怎么办？</h4>
<p>如果截止团购时间仍未达到团购最低人数要求，则该次团购失败。已支付的款项，我们将立即返还您的账号，您不会有任何损失。如果您很希望这次团购成交，邀请您的朋友一起来购买吧~</p>
</li>
<li class="alt">
<h4>什么是团购团购券，怎么使用？</h4>
<p>当团购成功后，您将在“我的团秒”页面中获得团购券编码以及对应密码。当您去商家消费时，提供团购团购券（包括密码）即可（每单团购券只可使用一次）。</p>
</li>
<li>
<h4>使用团购团购券时，能同时享用其他优惠么？</h4>
<p>一般不可以。如果可以，我们会在团购提示里特别说明。</p>
</li>
<li class="alt">
<h4>我购买的团购团购券，可以给其他人使用么？</h4>
<p>当然可以，告诉他团购券编码和密码即可！马上参与团购，给他/她一个惊喜吧 :)</p>
</li>
</ol>
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