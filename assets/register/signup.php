<?php
session_start();
global $dbh;
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';

require_once('../mail/phpmailer/PHPMailerAutoload.php');

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
$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$random_number = rand(1000, 9999);
setcookie("CODE", $random_number);
setcookie("FULL_NAME", $full_name);
setcookie("LOGIN", $login);
setcookie("EMAIL", $email);



//mail
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'a355318.smtp.mchost.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@modern-farm.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'RedmIIVAn2017!'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('info@modern-farm.ru'); // от кого будет уходить письмо?
$mail->addAddress('tatyanko@bk.ru');     // Кому будет уходить письмо
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Код авторизации';
$mail->Body    = 'Код для авторизации: '.$random_number;
$mail->AltBody = '';

if(!$mail->send()) {
    $_SESSION['message'] = 'ERROR';
    header("location: $BASE_URL/assets/register/autorization.php");
} else {
    $_SESSION['message'] = 'Введите код подтверждения (на почте)';
    $_SESSION['code'] = $random_number;
    header("location: $BASE_URL/assets/register/autorization.php");
    //header('location: thank-you.html');
}

//mail end



$checkUsersForLogin = $queryToDataBase->checkUserIsset($_POST['login']);
$count_users = $checkUsersForLogin->rowCount();

$checkUsersForEmail = $queryToDataBase->checkEmailIsset($_POST['email']);
$count_emails = $checkUsersForEmail->rowCount();




if (!$_POST['full_name'] || !$_POST['login'] || !$_POST['email']) {
    $_SESSION['message'] = 'Заполните все поля';
    header("location: $BASE_URL/assets/register/register.php");
} else {
    if ($count_users > 0) {
        $_SESSION['message'] = 'Пользователь с таким логином уже существует';
        header("location: $BASE_URL/assets/register/login.php");
    } else {
        if ($count_emails > 0) {
            $_SESSION['message'] = 'Данная почта уже используется';
            header("location: $BASE_URL/assets/register/login.php");
        } else {

            if ($password === $password_confirm) {
                $path = 'uploads/' . time() . $_FILES['avatar']['name'];
                setcookie("PATH", $path);
                if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../../' . $path)) {   // '../'.
                    $_SESSION['message'] = 'Ошибка при загрузке картинки';
                    header("location: $BASE_URL/assets/register/register.php");
                }
                $password = md5($password);
                setcookie("PASSWORD", $password);
            } else {
                $_SESSION['message'] = 'Пароли не совпадают';
                header("location: $BASE_URL/assets/register/login.php");

            }
        }
    }
}
?>



</body>
</html>
