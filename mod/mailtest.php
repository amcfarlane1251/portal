<?php 
	$from = "no-reply@img-dco-av01497.forces.gc.ca";
	$to = "alex@mcfarlanecreative.com";
	$subject = "PHP mail test script";
	$message = "test";
	$headers = "From:".$from;
	$mail = mail($to,$subject,$message,$headers);
	if($mail){
	echo $mail;
	}
?>
