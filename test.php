<?php 

$password = "admin01010";
$salt = "41F2CA0181A50810C944E388C9AB538CE48FDF1AAA2D4952";


// $string = mcrypt_create_iv(24, MCRYPT_DEV_URANDOM);
$salt = hex2bin($salt);


$hash = hash_pbkdf2("sha1", $password, $salt , 1000, 24, true);
$hash = strtoupper(bin2hex($hash));
echo $hash;
?>