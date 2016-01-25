<?php 			
function mymail($email,$subject,$activate)
{	
  $msg="http://localhost/new/activate.php?email={$email}&key={$activate}";
  $headers='From: rajkumararisetty143@gmail.com' . "\r\n";
  $headers .= "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($email,$subject,$msg,$headers);
}
function mymail1($email,$subject,$activate)
{
  mymail($email,$subject,$activate);
}
?>
