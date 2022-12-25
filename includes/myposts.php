<?php
session_start();
include '../path.php';
include '../assets/functions.php';
include 'head.php';
?>
<script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous">
</script>
<div id="main-index-div">
    <section class="article-section">
    <div id="article-title-div" class="div-add">
        <button id="add-my-post-btn" class="btn-add" name="btn-name" type="submit">Добавить пост</button>
    </div>
        <div id="id-add-post-block">

        </div>
    </section>
    <?php
    $login = $_SESSION['user']['login'];
    $my_posts = $queryToDataBase->getMyPosts($login);
    foreach ($my_posts as $my_post):
        $category = $queryToDataBase->getCategoriesById($my_post['id_category']);
        ?>
    <section class="article-section">
        <div class="article-title-div">
            <h3><?php echo $my_post['title'];
                $_POST['id'] = $my_post['id'];
            ?></h3>
        </div>
        <p><?php echo $my_post['text']; ?></p>
        <p><?php echo $category['name']; ?></p>
    </section>
    <?php endforeach; ?>

</div>

<script>
    $(document).ready(function (){
        $('button.btn-add').on('click', function (){
            $("#id-add-post-block").load("formaddpost.php", function() {
            });
            $("div.div-add").remove();
        })
    });
</script>




<?php
echo $_SESSION['id_post'];
include 'includes/footer.php';
?>


