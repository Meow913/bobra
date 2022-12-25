<?php
session_start();
include '../../database/connection.php';
include '../../path.php';
include '../functions.php';

if($_POST['id']){
    $_SESSION['id'] = $_POST['id'];
}
if($_POST['title']){
    $_SESSION['title'] = $_POST['title'];
}
if($_POST['content']){
    $_SESSION['content'] = $_POST['content'];
}
if($_POST['category']){
    $_SESSION['category'] = $_POST['category'];
}
if($_POST['imgUrl']){
    $_SESSION['imgUrl'] = $_POST['imgUrl'];
}else

var_dump($_SESSION['imgUrl']);

$id = $_SESSION['id'];
$title = $_SESSION['title'];
$alt = $title;
$text = $_SESSION['content'];
$id_category = $_SESSION['category'];
$login = $_SESSION['user']['login'];


if (!$_SESSION['PATH'] AND (empty($_SESSION['imgUrl']))) {
    $img = "";
} elseif (!$_SESSION['PATH'] AND $_SESSION['imgUrl']) {
    $img = $_SESSION['imgUrl'];
} else {
    $img = $_SESSION['PATH'];
}

$insert_post->changePost($id, $title, $img, $alt, $text, $id_category, $login);



unset ($_SESSION['PATH']);


?>