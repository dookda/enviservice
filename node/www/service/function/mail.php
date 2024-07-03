<?php

function SMTP_Mail($subject,$message,$to,$reply){
	
		global $_FILES;
        $message_all='';
				$message_footer='';
		$message_all.=$message.$message_footer;
		
		$data=json_decode(GetConfig());	

		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 2;                               // Enable verbose debug output
		$mail->CharSet = "utf-8";
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $data->email[0];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;  
		$mail->SMTPSecure = $data->email[1];                             // Enable SMTP authentication
		$mail->Username = $data->email[2];                 // SMTP username
		$mail->Password = $data->email[3];                           // SMTP password
		$mail->Port = $data->email[4];    
		$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

		
		$mail->setFrom($data->email[2], $data->email[5]);
		$mail->addAddress($to);               // Name is optional
		$mail->addReplyTo($reply);
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $message_all;
		
		if($mail->send()!=1) {
			return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
			
		}else{
			return true;
		}
	
}
    ?>
