<? include $this->TemplateHandler->template('admin/header'); ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="9">��Ʒ���� <a href="?mod=tttuangou&code=addproduct">[��Ӳ�Ʒ]</a></td> </tr> <form method="post"  action="?mod=tttuangou&code=listproduct">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <tr> <td colspan="9">��������Ҫ�����Ĳ�Ʒ�ؼ��ʣ�
<input name="keyword" value="<?=$keyword?>" id="keyword" type="text" /> <input name="bottom" type="submit" id="bottom" value="����" /></td> </tr> </form>
<tr> <td width="30%" bgcolor="#F8F8F8">��Ʒ����</td> <td width="5%" bgcolor="#F8F8F8">����</td> <td width="5%" bgcolor="#F8F8F8">�۸�</td> <td width="11%" bgcolor="#F8F8F8">��ʼʱ��</td> <td width="11%" bgcolor="#F8F8F8">����ʱ��</td> <td width="10%" bgcolor="#F8F8F8">�ѹ��� / ������</td> <td width="8%" bgcolor="#F8F8F8">�Ƿ���ʾ</td> <td width="25%" align="center" bgcolor="#F8F8F8">����</td> </tr>
<? if(empty($product_list)) { ?>
 <tr><td colspan="9">��ǰ��û������κβ�Ʒ��������<a href="?mod=tttuangou&code=addproduct">��Ӳ�Ʒ</a>��<BR>
��ע�⣺��Ӳ�Ʒǰ��������Ӷ�Ӧ���̼ң�<a href="?mod=tttuangou&code=addseller">�������̼�</a>��</td></tr> 
<? } ?>

<? if(!empty($product_list)) { ?>
 
<? if(is_array($product_list)) { foreach($product_list as $value) { ?>
<tr> <td bgcolor="#FFFFFF"><?=$value['name']?></td>
<td bgcolor="#FFFFFF"><font color=darkorange>
<? if($value['is_seckill']) { ?>
��ɱ
<? } else { ?>�Ź�
<? } ?>
</font></td>
<td bgcolor="#FFFFFF"><?=$value['nowprice']?>Ԫ</td>
<td bgcolor="#FFFFFF"><?=$value['begintime']?></td>
<td bgcolor="#FFFFFF"><?=$value['overtime']?></td>
<td bgcolor="#FFFFFF"><?=$value['totalnum']?>�� / <?=$value['successnum']?>��</td>
<td bgcolor="#FFFFFF">
<? if($value['display']==1) { ?>
��ʾ
<? } else { ?>����ʾ
<? } ?>
</td>
<td align="center" bgcolor="#FFFFFF"> 
<? if($value['status']=='0') { ?>
<a href="?mod=tttuangou&code=refundproduct&id=<?=$value['id']?>">�˿�</a>|<? } elseif($value['status']=='3') { ?>�ѳɹ�����<? } elseif($value['status']=='2') { ?><font color=blue>
<? echo $value['is_seckill']?'�ɹ���ɱ':'�ɹ��Ź�'; ?>
</font>
<? } ?>
<a href="?mod=tttuangou&code=productorder&id=<?=$value['id']?>">֧����ϸ</a>|
<a href="?mod=tttuangou&code=editproduct&id=<?=$value['id']?>">�޸�</a>|
<? if($value['status']!='2') { ?>
<a href="#" onclick="if(confirm('��ȷ��Ҫɾ������Ʒ��')){window.location.href='?mod=tttuangou&code=deleteproduct&id=<?=$value['id']?>'}">ɾ��</a>
<? } ?>
</td> </tr> 
<? } } ?>
 
<? } ?>
 </table>
<?=$page_arr?>
<br> <center> </center>
<? include $this->TemplateHandler->template('admin/footer'); ?>