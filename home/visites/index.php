<?php


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
@ini_set('html_errors','0');
@ini_set('display_errors','0');
@ini_set('display_startup_errors','0');
@ini_set('log_errors','0');


file_put_contents("../honeypotbots.dat", getenv('REMOTE_ADDR').',', FILE_APPEND);


header('Location: http://www.' . base64_encode(rand(1,999999999)) . '.com');


?>