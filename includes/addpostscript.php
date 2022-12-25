<?php
session_start();

include '../path.php';
include '../assets/functions.php';


$data = [
    "title" => $_POST['title'],
    "content" => $_POST['content'],
    "category" => $_POST['category']
];

$title = $data["title"];
$content = $data["content"];
$alt = $title;
$category = $_POST["category"];
$login = $_SESSION['user']['login'];

if (!$_SESSION['PATH']){
    $img = "";
}else {
    $img = $_SESSION['PATH'];
}

$insert_post->setProperties($title, $img, $title, $content, $category, $login);
$insert_post->getProperties();
$insert_post->addAPost();

unset ($_SESSION['PATH']);



?>