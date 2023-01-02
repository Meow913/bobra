123
<?php
    session_start();
    global $dbh;
    include '../../path.php';
    include '../../database/connection.php';
    include '../functions.php';


    $login = $_POST['login'];
    $password = md5($_POST['password']);

        $check_user = $dbh->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

        $row_count = count($check_user);
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

