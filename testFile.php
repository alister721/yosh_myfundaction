<?php
require_once ('vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php
    
$token="ssaqwe21356765sdfs"; // Ultramsg.com token
$instance_id="alister7211"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
    
$to="+601151200398"; 
$body="Hello world"; 
$api=$client->sendChatMessage($to,$body);
print_r($api);

?>