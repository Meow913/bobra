<?php
session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';
include '../../includes/head.php';
?>

<div class="form-div" style="margin: 0 auto; padding-top: 50px">
    <form action="<?php echo BASE_URL?>/assets/register/check_code.php" method="post">
        <label>Код из почты</label>
        <input type="text" name="code_from_input" placeholder="Введите код">
        <button type="submit">Подтвердить</button>
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
