<? include $this->TemplateHandler->template("tttuangou_header"); ?>
<body>   
<div class="m960">
<div class="t_area_out">
<div class="t_area_in">
<p class="cur_title2"><?=$this->Config['site_name']?>��ʾ��Ϣ</p>
<div class="sect msg">
<ul style="font-size:14px;list-style-type:none;">
<li class="li_nostyle"><span class="opreate_span">��ʾ��Ϣ:</span></li>
<? if(is_array($message)==false) { ?>
<li><span class="opreate_span"><?=$message?></span></li>
<? } else { ?>
<? if(is_array($message)) { foreach($message as $one_message) { ?>
<li><span class="opreate_span"><?=$one_message?></span></li>
<? } } ?>
<? } ?>
<li class="li_nostyle">
<span id="s" style="color:#cc0000"></span>&nbsp;
<? if($redirectto!='null') { ?>
<a href="<?=$redirectto?>">����Զ���ת�����ҳ��</a>��
<? } ?>
 </li>
</ul>
</div>
</div>
</div>
</div>
<script language="javascript">   
var i=<?=$time?>;     
function myclock(){       
document.getElementById("s").innerHTML = i;   
if(i>0)   
setTimeout("myclock();",1000);   
else     
window.location='<?=$redirectto?>';       
i--;   
}  
<? if($redirectto!='null') { ?>
myclock();
<? } ?>
</script>
<? include $this->TemplateHandler->template("tttuangou_footer"); ?>