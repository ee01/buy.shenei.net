<?php
/*******************************************************************
 *[TTTuangou] (C)2005 - 2010 Cenwor Inc.
 *
 * This is NOT a freeware, use is subject to license terms
 *
 * @Filename index.php $
 *
 * @Author http://www.tttuangou.net $
 *
 * @Date 2010-11-09 11:04:57 $
 *******************************************************************/ 
 
 


require("class.phpmailer.php"); 


$mail = new PHPMailer(); 


$mail->CharSet ="GB2312"; 

$mail->IsSMTP(); 
$mail->Host = "smtp.qq.com"; 
$mail->SMTPAuth = true; 
$mail->Username = "270464839"; 
$mail->Password = "sdfe"; 
$mail->From = "270464839@qq.com"; 

$mail->FromName = "guanle"; 

$mail->AddAddress("guanle1986@163.com","Josh Adams"); 




$mail->WordWrap = 50; 


$mail->IsHTML(true); 
$mail->Subject = "Here is the subject"; 

$mail->Body = '<meta http-equiv=content-type content="text/html; charset=GB2312">This is the <b>HTML body</b>支持中文'; 

$mail->AltBody = "This is the text-only body"; 

if(!$mail->Send()) 

{ 

echo "Message was not sent <p>"; 

echo "Mailer Error: ".$mail->ErrorInfo; 

exit; 

} 

else { 

echo "Message has been sent"; 

}
