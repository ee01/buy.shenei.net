<? include $this->TemplateHandler->template('admin/header'); ?>
 <table cellspacing="1" cellpadding="4" width="100%" align="center" class="tableborder"> <tr class="header"> <td colspan="9">产品管理 <a href="?mod=tttuangou&code=addproduct">[添加产品]</a></td> </tr> <form method="post"  action="?mod=tttuangou&code=listproduct">
<input type="hidden" name="FORMHASH" value='<?=FORMHASH?>'/> <tr> <td colspan="9">请输入您要搜索的产品关键词：
<input name="keyword" value="<?=$keyword?>" id="keyword" type="text" /> <input name="bottom" type="submit" id="bottom" value="搜索" /></td> </tr> </form>
<tr> <td width="30%" bgcolor="#F8F8F8">产品名称</td> <td width="5%" bgcolor="#F8F8F8">类型</td> <td width="5%" bgcolor="#F8F8F8">价格</td> <td width="11%" bgcolor="#F8F8F8">开始时间</td> <td width="11%" bgcolor="#F8F8F8">结束时间</td> <td width="10%" bgcolor="#F8F8F8">已购买 / 最少需</td> <td width="8%" bgcolor="#F8F8F8">是否显示</td> <td width="25%" align="center" bgcolor="#F8F8F8">管理</td> </tr>
<? if(empty($product_list)) { ?>
 <tr><td colspan="9">当前还没有添加任何产品！您可以<a href="?mod=tttuangou&code=addproduct">添加产品</a>。<BR>
请注意：添加产品前必须先添加对应的商家，<a href="?mod=tttuangou&code=addseller">点此添加商家</a>！</td></tr> 
<? } ?>

<? if(!empty($product_list)) { ?>
 
<? if(is_array($product_list)) { foreach($product_list as $value) { ?>
<tr> <td bgcolor="#FFFFFF"><?=$value['name']?></td>
<td bgcolor="#FFFFFF"><font color=darkorange>
<? if($value['is_seckill']) { ?>
秒杀
<? } else { ?>团购
<? } ?>
</font></td>
<td bgcolor="#FFFFFF"><?=$value['nowprice']?>元</td>
<td bgcolor="#FFFFFF"><?=$value['begintime']?></td>
<td bgcolor="#FFFFFF"><?=$value['overtime']?></td>
<td bgcolor="#FFFFFF"><?=$value['totalnum']?>人 / <?=$value['successnum']?>人</td>
<td bgcolor="#FFFFFF">
<? if($value['display']==1) { ?>
显示
<? } else { ?>不显示
<? } ?>
</td>
<td align="center" bgcolor="#FFFFFF"> 
<? if($value['status']=='0') { ?>
<a href="?mod=tttuangou&code=refundproduct&id=<?=$value['id']?>">退款</a>|<? } elseif($value['status']=='3') { ?>已成功返款<? } elseif($value['status']=='2') { ?><font color=blue>
<? echo $value['is_seckill']?'成功秒杀':'成功团购'; ?>
</font>
<? } ?>
<a href="?mod=tttuangou&code=productorder&id=<?=$value['id']?>">支付详细</a>|
<a href="?mod=tttuangou&code=editproduct&id=<?=$value['id']?>">修改</a>|
<? if($value['status']!='2') { ?>
<a href="#" onclick="if(confirm('您确认要删除该商品吗？')){window.location.href='?mod=tttuangou&code=deleteproduct&id=<?=$value['id']?>'}">删除</a>
<? } ?>
</td> </tr> 
<? } } ?>
 
<? } ?>
 </table>
<?=$page_arr?>
<br> <center> </center>
<? include $this->TemplateHandler->template('admin/footer'); ?>