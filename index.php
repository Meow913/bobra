<?php

include 'database/connection.php';
include 'assets/functions.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>bebra - сайт с инструкциями</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>

<header>
    <div id="div-header">
        <div id="div-logo">
                <a id="logo-href-main" href="#">
                    <img id="logo-pic" src="/img/logo-pic.png" alt="bobra" width="70" height="74">
                </a>
                    <a id="logo-title" href="#" >bobra</a>

        </div>
        <div id="div-menu">
            <ul class="mmenuu">
                <li><a href=#>Меню №1</a>
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
                <li><a href=#>Меню №2</a>
                </li>
                <li><a href=#>Меню №3</a>
                </li>
            </ul>

        </div>
    </div>
</header>

<div id="main-index-div">
    <?php
    global $dbh;
    $posts = $queryToDataBase->getAllPosts();
    foreach ($posts as $post):
        $category = $queryToDataBase->getCategoriesById($post['id_category']);
        ?>
    <section class="article-section">
        <div class="article-title-div">
            <h3><?php echo $post['title']; ?></h3>
        </div>
        <p><?php echo $post['text']; ?></p>
        <p><?php echo $category['name']; ?></p>



    </section>
    <?php endforeach; ?>
</div>

<?php
//
//global $dbh;
//
//$STH = $dbh->query('SELECT * from `posts`');
//$STH->setFetchMode(PDO::FETCH_ASSOC);
//
//while($row = $STH->fetch()) {
//    echo $row['title'] . "\n";
//    echo $row['img'] . "\n";
//    //echo $row['city'] . "\n";
//}
//
//?>
</body>
</html>
