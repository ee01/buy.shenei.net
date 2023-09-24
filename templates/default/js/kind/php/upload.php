<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename upload.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:58 $
 *******************************************************************/ 
 

$save_path = './../attached/';
require_once('./../../../../setting/settings.php');
$save_url = $config['site_url'].'/templates/default/js/kind/attached/';
$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
$max_size = 1000000;

if (empty($_FILES) === false) {
		$file_name = $_FILES['imgFile']['name'];
		$tmp_name = $_FILES['imgFile']['tmp_name'];
		$file_size = $_FILES['imgFile']['size'];
		if (!$file_name) {
		alert("请选择文件。");
	}
		if (@is_dir($save_path) === false) {
		alert("上传目录不存在。");
	}
		if (@is_writable($save_path) === false) {
		alert("上传目录没有写权限。");
	}
		if (@is_uploaded_file($tmp_name) === false) {
		alert("临时文件可能不是上传文件。");
	}
		if ($file_size > $max_size) {
		alert("上传文件大小超过限制。");
	}
		$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
		if (in_array($file_ext, $ext_arr) === false) {
		alert("上传文件扩展名是不允许的扩展名。");
	}
		$new_file_name = date("YmdHms") . '_' . rand(10000, 99999) . '.' . $file_ext;
		$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("上传文件失败。");
	}
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;
		echo '<html>';
	echo '<head>';
	echo '<title>Insert Image</title>';
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
	echo '</head>';
	echo '<body>';
	echo '<script type="text/javascript">';
	echo 'parent.parent.KE.plugin["image"].insert("' . $_POST['id'] . '", "' . $file_url . '","' . $_POST['imgTitle'] . '","' . $_POST['imgWidth'] . '","' . $_POST['imgHeight'] . '","' . $_POST['imgBorder'] . '","' . $_POST['align'] . '");';
	echo '</script>';
	echo '</body>';
	echo '</html>';
}

function alert($msg)
{
	echo '<html>';
	echo '<head>';
	echo '<title>error</title>';
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
	echo '</head>';
	echo '<body>';
	echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	echo '</body>';
	echo '</html>';
	exit;
}
?>