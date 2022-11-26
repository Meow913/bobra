<?php
session_start();
include '../../path.php';
unset($_SESSION['user']);
header("Location: $BASE_URL/index.php");
