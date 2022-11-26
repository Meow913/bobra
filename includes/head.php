<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>bobra - сайт с инструкциями</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>/css/index.css">
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
                            echo '<li><a href="'.BASE_URL.'/assets/register/logout.php">Выход</a></li>';
                        }
                        ?>

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</header>

