<?php


session_start();
global $dbh;
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';

require_once('../mail/phpmailer/PHPMailerAutoload.php');

$password = $_COOKIE['PASSWORD'];
$path = $_COOKIE['PATH'];
$full_name = $_COOKIE['FULL_NAME'];
$login= $_COOKIE['LOGIN'];
$email = $_COOKIE['EMAIL'];


$code_from_input = $_POST['code_from_input'];
$code_from_registration = $_COOKIE['CODE'];

if ($code_from_input === $code_from_registration) {
    $query_insert = "INSERT INTO `users` (`id`, `full_name`, `login`, `password`, `email`, `avatar`) VALUES (NULL, '$full_name','$login','$password','$email','$path')";
    $user_login = $dbh->exec($query_insert);
    $_SESSION['message'] = 'Регистрация прошла успешно';
    header("location: $BASE_URL/assets/register/login.php");
}else {
    $_SESSION['message'] = 'Неверный код';
    header("location: $BASE_URL/assets/register/autorization.php");
}