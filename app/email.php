<?php

if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
    http_response_code(400);
    die();
}

require '../vendor/autoload.php';

$sendgrid = new SendGrid('xxx', 'xxx');
$email = new SendGrid\Email();
$email->
    addTo('its.jenetic@gmail.com')->
    setFrom($_POST['email'])->
    setSubject('Mengzhen.me Contact Request')->
    setHtml('Name: '.$_POST['name'].'<br/>'.'Email: '.$_POST['email'].'<br/><br/>'.nl2br($_POST['message']));
       
try {
    if($sendgrid->send($email))
        http_response_code(200);
    else
        http_response_code(500);
    die();
} catch(Exception $e) {
    http_response_code(500);
    die();
}

?>