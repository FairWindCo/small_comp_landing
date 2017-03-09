<?php
require 'small-computers/mailer/PHPMailerAutoload.php';

function getParams($name,$param_array){
  if(array_key_exists($name,$param_array)){
    return $param_array[$name];
  } else {
    return '';
  }
}

function getParamsPost($name){
  return getParams($name,$_POST);
}

$name=getParamsPost('name');
$email=getParamsPost('email');
$phone=getParamsPost('phone');
$comment=getParamsPost('comment');
$key=getParamsPost('key');
$obj_id=getParamsPost('object_id');
$price=getParamsPost('price');

if(!empty($key) && $key=='NKT-324DFGghdh56#$tryFDGDF') {

  $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'user@example.com';                 // SMTP username
//$mail->Password = 'secret';                           // SMTP password
//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('mailer@nkt.kiev.ua', 'Mailer');
  $mail->addAddress('777@nkt.kiev.ua', 'NKT');     // Add a recipient
  $mail->addAddress('slam@nkt.kiev.ua', 'Sergey');               // Name is optional
  $mail->addAddress('s.manenok@nkt.kiev.ua', 'Sergey');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Here is the subject';
  $mail->Body = "Клиент <b>$name</b> интересуется продуктом <b>$$obj_id</b> по цене <i>$price</i><br> Контактные данные<br> Телефон: $phone<br>E-Mail: $email<br>$comment";
  $mail->AltBody = "Клиент $name интересуется продуктом $$obj_id по цене $price\n Контактные данные \n Телефон: $phone E-Mail: $email \n $comment";

  $data = array();

  if (!$mail->send()) {
    $data['message'] = 'Сообщение не было отправленно';
    $data['error'] = 'Ошибка Mailer: ' . $mail->ErrorInfo;
  } else {
    $data['message'] = 'Сообщение успешно отправленно!';
    $data['text'] = 'Менеджер свяжется с Вами в ближайщее время';
  }
} else {
  $data['message'] = 'Сообщение не было отправленно';
  $data['error'] = 'Ошибка Mailer: ' . ' Correct Key not found!';
}

//header('Content-Type: application/json');
echo json_encode($data);
