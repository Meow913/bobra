<?php
session_start();
include 'path.php';
include 'database/connection.php';
include 'assets/functions.php';
include 'includes/head.php';
?>



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


?>
</body>
</html>
