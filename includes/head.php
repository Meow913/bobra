<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>bobra - сайт с инструкциями</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/index.css">

    <script src="<?php echo BASE_URL?>/assets/scripts/app.js" defer></script>

    <script
            src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
            crossorigin="anonymous">
    </script>

</head>

<body>

<header>
    <div id="div-header">
        <div id="div-logo">
            <p id="p-pic-logo">
            <a id="logo-href-main" href="<?php echo BASE_URL?>">
                    <img id="logo-pic" src="/img/logo-pic.png" alt="bobra" height="74">
                </a>
            </p>
        </div>
        <div id="div-menu">
            <ul class="mmenuu">
                <li class="head-li-menu"><a href="#" onclick="return false">Каталог</a>
                    <ul class="ssubmenuu">
                        <?php $categoriesAll = $queryToDataBase->getAllCategories();
                        foreach ($categoriesAll as $categoryOne):?>
                        <li><a href=#>
                                <?php
                                echo $categoryOne['name'];

                        ?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class="head-li-menu"><a href=#>Поиск</a>
                </li>
                <li class="head-li-menu"><a href="#" onclick="return false">Личный кабинет</a>
                    <ul class="ssubmenuu">
                        <?php
                        if (!isset($_SESSION['user'])){
                            echo '<li><a href="'.BASE_URL.'/assets/register/login.php">Войти</a></li>';
                        }else {
                            echo '<li><a href="'.BASE_URL.'/assets/register/profile.php">Моя страница</a></li>';
                            echo '<li><a href="'.BASE_URL.'/includes/myposts.php">Мои статьи</a></li>';
                            echo '<li><a href="'.BASE_URL.'/assets/register/logout.php">Выход</a></li>';
                        }
                        ?>

                    </ul>
                </li>
            </ul>

        </div>
        <div id="my-page">
                        <?php
                        $url = BASE_URL.'/'.$_SESSION['user']['avatar'];
                        echo '<div class="avatar-div" style=" background-image: url('.$url.');"> </div>';
                        echo '<div class="my-page-full-name"><p>'.$_SESSION['user']['full_name'].'</p></div>';
                        ?>

        </div>
        <div class="hamburger-menu>
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>  <ul class="menu__box">
                <li><a class="menu__item" href="#">Главная</a></li>
                <li><a class="menu__item" href="#">Проекты</a></li>
                <li><a class="menu__item" href="#">Команда</a></li>
                <li><a class="menu__item" href="#">Блог</a></li>
                <li><a class="menu__item" href="#">Контакты</a></li>
            </ul>
        </div>
    </div>
</header>

