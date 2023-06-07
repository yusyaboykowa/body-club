<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PhpMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"]))
{
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host='smtp.gmail.com';
  $mail->SMTPAuth=true;
  $mail->Username='yusya.boykowa@gmail.com';
  $mail->Password='tnmhffrqkribaltw';
  $mail->SMTPSecure='ssl';
  $mail->Port=465;

  $mail->setFrom('yusya.boykowa@gmail.com');
  $mail->addAddress($_POST["email"]);
  $mail->isHTML(true);
  $mail->Subject="Subscription to Body Club";
  $mail->Body="Congratulations, my dear! From now you will get the latest news of our Body Club and by subscribing to our newsletter to receive exclusive recipes, discounts, new course updates, and more.";
  $mail->send();

  echo
  "
  <script>
  alert('Sent message');
  document.location.href='index.php';
  </script>
  ";
}
?>
