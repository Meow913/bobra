<?php
session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';

if($_POST["id"]) {
    $id_post = $_POST["id"];
    $_SESSION['id'] = $id_post;
}

//var_dump($_SESSION['id'] );
$id=$_SESSION['id'];
echo $id;

$insert_post->deletePost($id);
?>