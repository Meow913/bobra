<?php

session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';

if($_POST["value"]) {
    $value = $_POST["value"];
    $_SESSION['value'] = $value;
}
if($_POST["id_post"]) {
    $id_post = $_POST["id_post"];
    $_SESSION['id_post'] = $id_post;
}
if($_POST["login"]) {
    $login = $_POST["login"];
    $_SESSION['login'] = $login;
}

$checked_star = $star->checkStar($_SESSION['id_post'], $_SESSION['login']);
$count_stars = $checked_star->rowCount();
//var_dump($count_stars);

if ($count_stars > 0) {
    $star->changeValue($_SESSION['id_post'], $_SESSION['login'], $_SESSION['value']);
} else {
    $star->setValue($_SESSION['id_post'], $_SESSION['value'], $_SESSION['login']);
}

$star_value = $star->getRating($_SESSION['id_post']);

$result = array(
    'text'  => $star_value,
);

echo json_encode($result);


//$data = $star->getStars(33);


 //JSON
//$file = file_get_contents('../../json.json');
//
//$taskList = json_decode($file, TRUE);

//echo '<pre>';
//print_r($taskList);
//echo '</pre>';
//unset($file);
//
//$taskList[] = array("newRating" => $star_value);
//file_put_contents('../../json.json', '');
//
//file_put_contents('../../json.json', json_encode($taskList));
//
//unset($taskList);
//
//$json[] = json_encode(array("newRating" => $star_value));

//unset($_SESSION['value'], $_SESSION['id_post'], $_SESSION['login']);
?>



