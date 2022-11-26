<?php
session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';
include '../../includes/head.php';
?>

<div class="form-div">
    <form action="<?php echo BASE_URL?>/assets/register/signup.php" method="post" enctype="multipart/form-data">
        <label>ФИО</label>
        <input type="text" name="full_name" placeholder="Введите ФИО">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Почта</label>
        <input type="email" name="email" placeholder="Введите свою почту">
        <label>Изображение</label>
        <input type="file" name="avatar">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button type="submit">Зарегистрироваться</button>
        <p>
            У Вас уже есть аккаунт? - <a href="<?php echo BASE_URL?>/assets/register/login.php">Авторизуйтесь</a>!
        </p>
        <?php

        //email
               if ($_SESSION['message']) {
            echo '<p class="msg">'.$_SESSION['message'].'</p>';
        }
        unset($_SESSION['message']);
        ?>

    </form>
</div>

</body>
</html>
