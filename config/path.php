<?php
define ('ROOT_PATH',str_replace('config','',__DIR__));
/* echo ROOT_PATH;
echo '<br>'; */
$proyect_name='proyecto';
define ('BASE_URL','http://' . $_SERVER['SERVER_NAME'].'/' . $proyect_name .'/' );/* 'HTTP_HOST' */
/* echo BASE_URL; */
?>