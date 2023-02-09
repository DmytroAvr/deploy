<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('uk', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'forms.send.dimax@gmail.com';                     //SMTP username
	$mail->Password   = 'fxororvpfrjhxqur';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 


	//Від кого лист
	$mail->setFrom('forms.send.dimax@gmail.com', 'DIMAX client form'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('onvix96@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'DIMAX site form';

	//Тіло листа
	$body = '<h1>Form from website dimaxglobal.com was filled in</h1> 
	<p>Client input next info:</p>';


	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Name:</strong> ' . $_POST['name']. '</p>';
	}	
	if(trim(!empty($_POST['company']))){
		$body.='<p><strong>Company:</strong> ' . $_POST['company']. '</p>';
	}	
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> ' . $_POST['email']. '</p>';
	}	
	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>Tel:</strong> ' . $_POST['tel']. '</p>';
	}	
	if(trim(!empty($_POST['text']))){
		$body.='<p><strong>Message:</strong> ' . $_POST['text']. '</p>';
	}	


	//if(trim(!empty($_POST['name']))){
	//	$body.=$_POST['name'];
	//}	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>