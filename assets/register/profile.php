<?php
session_start();
global $dbh;
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';
include '../../includes/head.php';
?>

<form>
    <img src="<?= $_SESSION['user']['avatar']?>" width="100" alt="">
    <h2><?= $_SESSION['user']['full_name']?></h2>
    <a href="#"><?= $_SESSION['user']['email']?></a>
    <a href="logout.php">Выход</a>
</form>
</body>
</html>
