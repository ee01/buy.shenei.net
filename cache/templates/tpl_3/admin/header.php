<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=gbk"> <link href="./templates/default/styles/admincp.css" rel="stylesheet" type="text/css" /> <script language="JavaScript">
function checkalloption(form, value) {
for(var i = 0; i < form.elements.length; i++) {
var e = form.elements[i];
if(e.value == value && e.type == 'radio' && e.disabled != true) {
e.checked = true;
}
}
}
function checkallvalue(form, value, checkall) {
var checkall = checkall ? checkall : 'chkall';
for(var i = 0; i < form.elements.length; i++) {
var e = form.elements[i];
if(e.type == 'checkbox' && e.value == value) {
e.checked = form.elements[checkall].checked;
}
}
}
function zoomtextarea(objname, zoom) {
zoomsize = zoom ? 10 : -10;
obj = $(objname);
if(obj.rows + zoomsize > 0 && obj.cols + zoomsize * 3 > 0) {
obj.rows += zoomsize;
obj.cols += zoomsize * 3;
}
}
function redirect(url) {
window.location.replace(url);
}
function checkall(form, prefix, checkall) {
var checkall = checkall ? checkall : 'chkall';
for(var i = 0; i < form.elements.length; i++) {
var e = form.elements[i];
if(e.name != checkall && (!prefix || (prefix && e.name.match(prefix)))) {
e.checked = form.elements[checkall].checked;
}
}
}
var collapsed = Cookies.getCookie('guanzhu_collapse');
function collapse_change(menucount) {
if($('menu_' + menucount).style.display == 'none') {
$('menu_' + menucount).style.display = '';collapsed = collapsed.replace('[' + menucount + ']' , '');
$('menuimg_' + menucount).src = './templates/default/images/admincp/menu_reduce.gif';
} else {
$('menu_' + menucount).style.display = 'none';collapsed += '[' + menucount + ']';
$('menuimg_' + menucount).src = './templates/default/images/admincp/menu_add.gif';
}
Cookies.setCookie('guanzhu_collapse', collapsed, 2592000);
}
function advance_search(o)
{
o.innerHTML=$('advance_search').visible()?"�߼�����":"������";
$('advance_search').toggle();
return false;
}
</script> </head> <body> <table width="100%" border="0" cellpadding="2" cellspacing="6" style="_margin-left:-10px; "> <tr> <td><table width="100%" border="0" cellpadding="2" cellspacing="6"> <tr> <td>
<? if($__is_messager!=true) { ?>
 <div style="width: 100%; height: 30px; line-height: 30px; background: url(./templates/default/images/admincp/bg_list2.gif) repeat-x; margin: 0pt 0pt 10px;"> <div style="float: left; margin-left: 10px; color:#fff;"><img style="border: medium none; margin: 6px 5px 0pt 0pt; float: left;" src="./templates/default/images/admincp/user.png">&nbsp;<a href="admin.php?mod=index&code=home"><b style="color:#fff">���������ҳ</b></a>&nbsp;&raquo;&nbsp;
<? echo $this->actionName(); ?>
</div> <div style="float: right; margin: 0pt;"><a onclick="javascript:window.open('http://bizapp.qq.com/webc.htm?new=0&amp;sid=938044022&amp;o=tttuangou.net&amp;q=7', '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" title="ͨ����ҵQQ��ϵ����" href="javascript:void(0)"><img style="border: medium none;" src="./templates/default/images/admincp/qq.gif"></a></div> </div> 
<? } ?>