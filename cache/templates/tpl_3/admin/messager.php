<br /><br /><br /><br /><br /><br /> <table width="500" border="0" cellpadding="0" cellspacing="0" align="center" class="tableborder"> <tr class="header"><td>TTtuangou ��ʾ</td> </tr> <tr> <td class="altbg2"> <div align="center"><br /><br /><br /> 
<? if(is_array($message)==false) { ?>
<?=$message?>
<? } else { ?> 
<? if(is_array($message)) { foreach($message as $k => $one_message) { ?>
<? if($k) { ?>
<?=$k?>
<? } ?>
<?=$one_message?><br> 
<? } } ?>
 
<? } ?>
 
<? if($return_msg=="") { ?>
 <br /><br /><br /> 
<? if($time!==null) { ?>
 <script>setTimeout("redirect('<?=$redirectto?>');", <?=$time?>*1000);</script> <a href="<?=$redirectto?>">������������û���Զ���ת������������</a> 
<? } else { ?> <a href="<?=$redirectto?>"><?=$to_title?></a> 
<? } ?>
 
<? } else { ?><?=$return_msg?>
<? } ?>
 </div><br /><br /></td> </tr> </table><br /><br /><br />