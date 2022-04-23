<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';                            

  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.yandex.ru';                               
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->Username = 'Название почты';
    $mail->Password = 'Пароль от почты';
    $mail->setLanguage('ru', 'phpmailer/language/');

    $mail->setFrom('sales@systemcontrol.ru', 'Kinco');
    $mail->addAddress('sales@systemcontrol.ru', 'Kinco');
    $mail->isHTML(true); 
    $mail->Subject =  '=?UTF-8?B?'.base64_encode($_POST['subject']).'?=';
    $body = '<h1>Письмо с сайта Control System Kinco</h1>';

    if(trim(!empty($_POST['name']))) {
      $body.='<p><strong>ФИО:</strong>'.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['phone']))) {
      $body.='<p><strong>Телефон:</strong>'.$_POST['phone'].'</p>';
    }
    if(trim(!empty($_POST['email']))) {
      $body.='<p><strong>E-mail:</strong>'.$_POST['email'].'</p>';
    }
  

    $mail->Body = $body;
    $mail->send();
    $message = 'Данные отправлены!';
} catch (Exception $e) {
    $message = 'Ошибка';
}

  $response = ['message' => $message];
  echo json_encode($response);
?>