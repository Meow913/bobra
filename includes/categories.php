<?php
session_start();
include '../path.php';
//include '../database/connection.php';
include '../assets/functions.php';

include 'head.php';
?>

<script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous">
</script>

<div id="main-index-div">

    <?php
    $id_category = $_GET['id'];
    //var_dump($id_category);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    $login = $_SESSION['user']['login'];
    $notesOnPage = 3;
    $from = ($page - 1) * $notesOnPage;
    $my_posts = $queryToDataBase->getPostCategoryPagination($id_category, $from, $notesOnPage);

    $postsAll = $queryToDataBase->getPostsByIdCategory($id_category);
//    echo '<pre>';
//    print_r($postsAll);
//    echo '</pre>';
    //var_dump($page);

    $totals = count($postsAll);
    $totals = $postsAll->rowCount();
    $pagesCount = ceil($totals / $notesOnPage);
    $pagesCount = (int) $pagesCount;


    foreach ($my_posts as $my_post):
        $category = $queryToDataBase->getCategoriesById($my_post['id_category']);
        $star_value = $star->getRating($my_post['id']);
        $url = BASE_URL.'/'.$my_post['img'];
        $url_no_pic = BASE_URL.'/img/nopic.png';
        ?>
        <section class="article-section">
            <div class="article-title-div">
                <?php
                if(!empty($my_post['img'])) {
                    echo ' <div class="post-div-pic-card" style=" background-image: url('.$url.')"> </div>';
                }else {
                    echo ' <div class="post-div-pic-card" style=" background-image: url('.$url_no_pic.')"> </div>';
                }
                ?>

                <div class="post-div-h3" style="display: inline-block;"> <h3><a href="post.php?id=<?=$my_post['id']?>"><?php echo $my_post['title']; ?> </a></h3> </div>
            </div>

            <p><?php echo my_cut($my_post['text'], 128)?></p>
            <p>Категория: <?php echo $category['name']; ?></p>
            <p>Автор: <?php echo $my_post['login']; ?></p>
            <?php
            if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $my_post['login']) {
                echo ' <button class="btn-edit" data-id="'.$my_post['id'].'">Редактировать</button>';
            }
            if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $my_post['login']) {
                echo '<button class="btn-delete" data-id="'.$my_post['id'].'" id="'.$my_post['id'].'" style="background: #ee3838">Удалить</button>';
            }
            ?>

            <div class="form"
                <?php
                if(!isset($_SESSION['user'])) {

                    echo 'style="pointer-events: none;"';

                }
                ?>
            >
                <div data-ajax="true" class="rating rating_set" style="padding-top: 10px">
                    <div class="rating__body">
                        <div class="rating__active"></div>
                        <div class="rating__items">
                            <input type="radio" class="rating__item" value="1" name="rating" data-id="<?php echo $my_post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                            <input type="radio" class="rating__item" value="2" name="rating" data-id="<?php echo $my_post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                            <input type="radio" class="rating__item" value="3" name="rating" data-id="<?php echo $my_post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                            <input type="radio" class="rating__item" value="4" name="rating" data-id="<?php echo $my_post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                            <input type="radio" class="rating__item" value="5" name="rating" data-id="<?php echo $my_post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                        </div>
                    </div>
                    <div class="rating__value" data-id="<?php echo $my_post['id']; ?>">
                        <?php
                        if(is_nan($star_value)){
                            echo 'Нет оценок';
                        }else {
                            echo $star_value; };
                        ?>

                    </div>
                </div>
                <?php
                if(!isset($_SESSION['user'])) {
                    echo '<p style="font-size: 10px;">*Только зарегистрированные пользователи могут ставить оценку</p>';
                }
                ?>
            </div>






        </section>
    <?php endforeach; ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pagesCount; $i ++){
            if($pagesCount == 1){end();}else{
                ?>

                <a href = "?id=<?php echo $id_category;?>&page=<?php echo $i;?>"><?php echo $i;?></a>

            <?php }}?>

    </div>


</div>


<script>
    $(function () {
        $('button.btn-delete').click(function (e) {
            e.preventDefault();
            let postId = $(this).data("id");
            $.ajax({
                method: "POST",
                url: "modaldelete.php",
                data: { "id" : postId},
                success: function (data){ // это done
                    $('#main-index-div').append('<div id="div-load-modal">'+data+'</div>');
                    $('#div-load-modal').data;
                }
            })
        });
        $('button.btn-edit').click(function (e) {
            e.preventDefault();
            let postId = $(this).data("id");
            //console.log(postId);
            $.ajax({
                method: "POST",
                url: "modaledit.php",
                data: { "id" : postId},
                success: function (data){ // это done
                    $('#main-index-div').append('<div id="div-load-modal">'+data+'</div>');
                    $('#div-load-modal').data;
                }
            })
        });
    });
</script>

<script>
    $(document).ready(function (){
        $('input.rating__item').on('click', function (e){

            let idPost = $(this).data("id");
            let login = $(this).data("login");

            let starValue = $(this).val();
            //console.log(starValue);
            let element = $(this).parent().parent().parent().find('div.rating__value');
            //console.log(element);
            $.ajax({
                method: "POST",
                url: "../assets/scripts/star_rating.php",
                data: { "id_post": idPost, "value": starValue, "login": login },
            });
            $.ajax({
                url: '../assets/scripts/star_rating.php',
                method: 'get',
                dataType: 'json',
                success: function(data){
                    //element.text(data.newRating);    /* выведет "Текст" */
                    element.text(data.text);
                }
            });
        });

    });
</script>


<?php
include 'footer.php';
?>
