<?php
session_start();
include '../path.php';
include '../assets/functions.php';
include 'head.php';


$post_id = $_GET['id'];

$post = $queryToDataBase->getOnePost($post_id);
$category = $queryToDataBase->getCategoriesById($post['id_category']);
$text = $post['text'];
$text = "<p>". str_replace("\n", "</p>\n<p>", $text)."</p>";
$url = BASE_URL.'/'.$post['img'];
$url_no_pic = BASE_URL.'/img/nopic.png';
$path_to_pdf = BASE_URL.'/includes/pdf.php';


// For PDF
$_SESSION['title_pdf'] = $post['title'];
$_SESSION['text_pdf'] = $text;
$_SESSION['img_pdf'] = $post['img'];
$_SESSION['text_pdf'] = $post['text'];
?>



<div id="main-index-div">

    <section class="article-section">
        <div class="article-title-div">
            <?php
            if(!empty($post['img'])) {
            echo ' <div class="post-div-pic" style=" background-image: url('.$url.')"> </div>';
            }else {
                echo ' <div class="post-div-pic" style=" background-image: url('.$url_no_pic.')"> </div>';
            }
            ?>

            <div class="post-div-h3" style="display: inline-block;"> <h3><?php echo $post['title']; ?></h3> </div>
        </div>
        <div class="post-text">
        <?php echo $text; ?>
        </div>
        <p>Категория: <?php echo $category['name']; ?></p>
        <p>Автор: <?php echo $post['login']; ?></p>
        <?php
        if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $post['login']) {
            echo ' <button id="add-my-post-btn" class="btn-add" name="btn-name" type="submit">Редактировать</button> <br>';
        }
        if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $post['login']) {
            echo '<button name="idname" class="btn-delete" data-id="'.$post['id'].'" id="'.$post['id'].'">Удалить</button>';
        }
        ?>
        <div id="div-logo "style="padding-top: 25px">
            <p id="p-pic-logo">
                <a id="logo-href-main" href="<?php echo $path_to_pdf; ?>">
                    <img id="logo-pic" src="../img/pdf.png" alt="bobra" height="30">
                    Скачать PDF
                </a>
            </p>
        </div>
    </section>
</div>




