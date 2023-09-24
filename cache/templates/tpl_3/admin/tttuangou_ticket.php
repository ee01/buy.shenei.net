<? include $this->TemplateHandler->template('admin/header'); ?>
 <script src="templates/default/js/calenderJS.js"></script> <form method="post"  action="<?=$action?>">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="8">团购券管理 </td> </tr> 
<? if(!empty($ticket)) { ?>
 <tr> <td colspan="11">请输入您要搜索的团购券或用户名：
<input name="keyword" value="<?=$keyword?>" id="keyword" type="text" /> <select name="type"> <option value="1" 
<? if($searchtype==1) { ?>
selected
<? } ?>
>团购券编号</option> <option value="2" 
<? if($searchtype==2) { ?>
selected
<? } ?>
>用户名</option> </select>&nbsp;， 
过期时间<input name="time" value="<?=$time?>" id="keyword" type="text" onfocus="HS_setDate(this)" /> <select name="used"> <option value="false" 
<? if($used=='false') { ?>
selected
<? } ?>
>使用状态不限</option> <option value="0" 
<? if($used=='0') { ?>
selected
<? } ?>
>已使用</option> <option value="1" 
<? if($used=='1') { ?>
selected
<? } ?>
>未使用</option> <option value="2" 
<? if($used=='2') { ?>
selected
<? } ?>
>已过期</option> </select> <input name="bottom" type="submit" id="bottom" value="搜索" /></td> </tr> 
<? } ?>
 <tr> <td width="40%" bgcolor="#F8F8F8">产品名称</td> <td width="10%" bgcolor="#F8F8F8">购买人</td> <td width="15%" bgcolor="#F8F8F8">团购券号</td> <td width="10%" bgcolor="#F8F8F8">过期时间</td> <td width="10%" bgcolor="#F8F8F8">状态</td> <td width="15%" align="center" bgcolor="#F8F8F8">管理</td> </tr> 
<? if(empty($ticket)) { ?>
 <tr><td colspan="8">暂时没有团购券哦。<BR>
团购券是在商品达到或者超过最低团购人数时，由系统自动生成！</td></tr> 
<? } ?>
 
<? if(is_array($ticket)) { foreach($ticket as $i => $value) { ?>
 <tr> <td bgcolor="#FFFFFF"><?=$value['name']?></td> <td bgcolor="#FFFFFF"><?=$value['username']?></td> <td bgcolor="#FFFFFF"><?=$value['number']?></td> <td bgcolor="#FFFFFF"><?=$value['perioddate']?></td> <td bgcolor="#FFFFFF">
<? if($value['status']==1) { ?>
未使用<? } elseif($value['status']==0) { ?><font color=blue>已使用</font>
<? } else { ?><font color=red>已过期</font>
<? } ?>
</td> <td align="center" bgcolor="#FFFFFF">
<? if($value['status']!=1) { ?>
<a href="#" onclick="if(confirm('您确认要删除该消费券吗？请谨慎使用该功能！')){window.location.href='?mod=tttuangou&code=deleteticket&ticketid=<?=$value['ticketid']?>'}">删除</a>
<? } ?>

<? if($value['status']==1) { ?>
<a href="?mod=tttuangou&code=warnofticket&id=<?=$value['ticketid']?>">Email到期提醒</a>
<? } ?>
</td> </tr> 
<? } } ?>
 </table>
<?=$page_arr?>
<br> <center> </center> </form>
<? include $this->TemplateHandler->template('admin/footer'); ?>