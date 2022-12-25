<?php
    session_start();
    global $dbh;
    include '../../path.php';
    include '../../database/connection.php';
    include '../functions.php';
    include '../../includes/head.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>bobra - сайт с инструкциями</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/index.css">
</head>
<body>
<?php
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $check_user = $dbh->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $row_count = $check_user -> rowCount();
        if ($row_count > 0) {
        $user = $check_user->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "full_name" => $user['full_name'],
            "avatar" => $user['avatar'],
            "email" => $user['email'],
        ];
        header("Location: $BASE_URL/assets/register/profile.php");
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header("location: $BASE_URL/assets/register/login.php");
    }
?>

</body>
</html>
