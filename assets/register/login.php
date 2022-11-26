<?php
session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';
include '../../includes/head.php';
?>

<div class="form-div">
    <form action="<?php echo BASE_URL?>/assets/register/signin.php" method="post">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>
            У Вас нет аккаунта? - <a href="<?php echo BASE_URL?>/assets/register/register.php">Зарегистрируйтесь</a>!
        </p>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg">'.$_SESSION['message'].'</p>';
        }
            unset($_SESSION['message']);
        ?>
    </form>
</div>

</body>
</html>
