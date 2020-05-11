<?php
function sendMail($to_mail, $to_name, $msg, $msg_body){
$path = $_SERVER['DOCUMENT_ROOT'];
$vendorpath = $path . "/vendor/autoload.php";
require_once($vendorpath);
$path .= "/mrm_mail.php";
include_once($path);

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'));
$transport->setUsername($mrm_mail)->setPassword($mrm_pass);

$mailer = new Swift_Mailer($transport);

$message = new Swift_Message ($msg);
$message
   ->setFrom([$mrm_mail => $mrm_name])
   ->setTo([$to_mail => $to_name])
   ->setSubject($msg)
   ->setBody($msg_body, 'text/html');

$result = $mailer->send($message);

return $result;
}
?>