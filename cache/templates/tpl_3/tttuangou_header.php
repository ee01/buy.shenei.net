<? $__my=$this->
MemberHandler->MemberFields; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?=$this->Config['site_url']?>/" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<? if('index'==$_GET['mod'] && 1==count($_GET)) { ?>
<title>��<?=$this->Config['site_name']?>��(<?=$this->Config['site_domain']?>) - ������</title>
<? } else { ?><title><?=$this->Title?> - <?=$this->Config['site_name']?>(<?=$this->Config['site_domain']?>)<?=$this->Config['page_title']?></title>
<? } ?>
<meta name="Keywords" content="<?=$this->MetaKeywords?>,<?=$this->Config['site_name']?><?=$this->Config['meta_keywords']?>" />
<meta name="Description" content="<?=$this->MetaDescription?>,<?=$this->Config['site_notice']?><?=$this->Config['meta_description']?>" />
<script type="text/javascript">
var thisSiteURL = '<?=$this->Config['site_url']?>/';
</script>
<link rel="shortcut icon" href="/favicon.ico" />
<link href="/templates/default/styles/main.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="/templates/default/js/jquery.js"></script>
<script language="javascript" src="/templates/default/js/main.js"></script>
</head>
<body>
<div class="m_bg">
<a name="htop" id="htop"></a>
<div class="header">
<div class="h960">
<div class="at_logo"> 
<div class="vcoupon"><a href="
<? echo $this->Config['site_url'];  ?>
/?u=<?=MEMBER_ID?>" onclick="copyText(this.href);">&raquo;������ѹ��� <?=$this->config['default_payfinder']?>Ԫ</a><a href="/channel/ckticket">&raquo;�Ź�ȯ��֤�����ѵǼ�</a></div>
<div class="logo"><a href="/"><img src="/templates/default/images/logo_m.gif" /></a></div>
<a class="at_city" href="javascript:void(0)"><?=$this->cityname?></a>
<div id="change_city"> <span id="top_title">�л�����</span>
<div id="show_provinces">
<div style=" position:absolute; font-weight:normal; right:8px; top:8px;" id="close">[�ر�]</div>
<div style="margin-bottom:0.75em; font-weight:bolder;"><span>��ѡ�������ڵĳ���:</span></div>
<ul class="scity">
<? if(is_array($this->cityary)) { foreach($this->cityary as $i => $value) { ?>
<li><span class="sub_title"><a href="/city-<?=$value['shorthand']?>"><?=$value['cityname']?></a></span></li>
<? } } ?>
</ul>
</div>
</div>
<div id="Tpl_c"> <a class="ft_top" href="
<? if(MEMBER_ID>=1) { ?>
?mod=index&code=email
<? } else { ?>?mod=me&code=register
<? } ?>
">�ʼ�����ÿ�������Ź�</a>
<span id="page_options" onclick="ShowHideDiv()">����ģ��<div id="Sright"><script type="text/javascript">writeCSSLinks();</script></div></span> 
</div>
</div>
</div>
</div>
<div class="t_nav">
<div class="h960">
<div class="sign">
<? if(MEMBER_ID > 0) { ?>
<?=MEMBER_NAME?>: <a href="/myself">�ҵ�����</a> 
<? if(MEMBER_ROLE_ID==2 or MEMBER_ROLE_ID==7) { ?>
|<a href="/admin.php">�����̨</a>
<? } ?>
 
<? if(MEMBER_ROLE_ID==6) { ?>
| <a href="/magseller">�̼ҹ���</a>
<? } ?>
 | <a href="/login/logout">�˳�</a>
<? } else { ?>���ã���ӭ���ĵ�����<a href="/login">��½</a> | <a href="/myself/register">ע��</a>
<? } ?>
</div>
<ul class="menu">
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a href="http://www.shenei.net" target="_blank" title="����ҳ"><span>��վ��ҳ</span></a>
<div class="list">
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a <?=$p1?> href="/" title="��������"><span>��������</span></a>
<div class="list">
<a <?=$p1_1?> href="/home/type-SecKills" title="������ɱ"><span>������ɱ</span></a><br />
<a <?=$p1_2?> href="/home/type-GroupBuy" title="�����Ź�"><span>�����Ź�</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a <?=$p2_2?> href="/channel/backlist" title="��������"><span>��������</span></a>
<div class="list">
<a <?=$p2_2?> href="/channel/backlist/type-GroupBuy" title="�����Ź�"><span>�����Ź�</span></a><br />
<a <?=$p2_1?> href="/channel/backlist/type-SecKills" title="������ɱ"><span>������ɱ</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a <?=$p3?> href="/channel/tobuy" title="�Ź�ָ��"><span>�Ź�ָ��</span></a>
<div class="list">
<a <?=$p4?> href="/channel/problem" title="��������"><span>��������</span></a><br />
</div>
</li>
<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'"><a <?=$p5?> href="/channel/question" title="�����ʴ�"><span>�����ʴ�</span></a>
<div class="list">
</div>
</li>
</ul>
<? if(0) { ?>
<!--<a <?=$p1?> href="/" title="��������"><span>��������</span></a>--> <a <?=$p1_1?> href="/home/type-SecKills" title="������ɱ"><span>������ɱ</span></a> <a <?=$p1_2?> href="/home/type-GroupBuy" title="�����Ź�"><span>�����Ź�</span></a> <a <?=$p2_2?> href="/channel/backlist/type-GroupBuy" title="�����Ź�"><span>�����Ź�</span></a> <a <?=$p2_1?> href="/channel/backlist/type-SecKills" title="������ɱ"><span>������ɱ</span></a> <a <?=$p3?> href="/channel/tobuy" title="�Ź�ָ��"><span>�Ź�ָ��</span></a> <!--<a <?=$p4?> href="/channel/problem" title="��������"><span>��������</span></a>--> <a <?=$p5?> href="/channel/question" title="�����ʴ�"><span>�����ʴ�</span></a>
<? } ?>
</div>
</div>