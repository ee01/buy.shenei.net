<? include $this->TemplateHandler->template('admin/header'); ?>
 <script src="templates/default/js/calenderJS.js"></script> <form method="post"  action="<?=$action?>">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="8">�Ź�ȯ���� </td> </tr> 
<? if(!empty($ticket)) { ?>
 <tr> <td colspan="11">��������Ҫ�������Ź�ȯ���û�����
<input name="keyword" value="<?=$keyword?>" id="keyword" type="text" /> <select name="type"> <option value="1" 
<? if($searchtype==1) { ?>
selected
<? } ?>
>�Ź�ȯ���</option> <option value="2" 
<? if($searchtype==2) { ?>
selected
<? } ?>
>�û���</option> </select>&nbsp;�� 
����ʱ��<input name="time" value="<?=$time?>" id="keyword" type="text" onfocus="HS_setDate(this)" /> <select name="used"> <option value="false" 
<? if($used=='false') { ?>
selected
<? } ?>
>ʹ��״̬����</option> <option value="0" 
<? if($used=='0') { ?>
selected
<? } ?>
>��ʹ��</option> <option value="1" 
<? if($used=='1') { ?>
selected
<? } ?>
>δʹ��</option> <option value="2" 
<? if($used=='2') { ?>
selected
<? } ?>
>�ѹ���</option> </select> <input name="bottom" type="submit" id="bottom" value="����" /></td> </tr> 
<? } ?>
 <tr> <td width="40%" bgcolor="#F8F8F8">��Ʒ����</td> <td width="10%" bgcolor="#F8F8F8">������</td> <td width="15%" bgcolor="#F8F8F8">�Ź�ȯ��</td> <td width="10%" bgcolor="#F8F8F8">����ʱ��</td> <td width="10%" bgcolor="#F8F8F8">״̬</td> <td width="15%" align="center" bgcolor="#F8F8F8">����</td> </tr> 
<? if(empty($ticket)) { ?>
 <tr><td colspan="8">��ʱû���Ź�ȯŶ��<BR>
�Ź�ȯ������Ʒ�ﵽ���߳�������Ź�����ʱ����ϵͳ�Զ����ɣ�</td></tr> 
<? } ?>
 
<? if(is_array($ticket)) { foreach($ticket as $i => $value) { ?>
 <tr> <td bgcolor="#FFFFFF"><?=$value['name']?></td> <td bgcolor="#FFFFFF"><?=$value['username']?></td> <td bgcolor="#FFFFFF"><?=$value['number']?></td> <td bgcolor="#FFFFFF"><?=$value['perioddate']?></td> <td bgcolor="#FFFFFF">
<? if($value['status']==1) { ?>
δʹ��<? } elseif($value['status']==0) { ?><font color=blue>��ʹ��</font>
<? } else { ?><font color=red>�ѹ���</font>
<? } ?>
</td> <td align="center" bgcolor="#FFFFFF">
<? if($value['status']!=1) { ?>
<a href="#" onclick="if(confirm('��ȷ��Ҫɾ��������ȯ�������ʹ�øù��ܣ�')){window.location.href='?mod=tttuangou&code=deleteticket&ticketid=<?=$value['ticketid']?>'}">ɾ��</a>
<? } ?>

<? if($value['status']==1) { ?>
<a href="?mod=tttuangou&code=warnofticket&id=<?=$value['ticketid']?>">Email��������</a>
<? } ?>
</td> </tr> 
<? } } ?>
 </table>
<?=$page_arr?>
<br> <center> </center> </form>
<? include $this->TemplateHandler->template('admin/footer'); ?>