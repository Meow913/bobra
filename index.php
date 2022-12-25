<?php
session_start();
include 'path.php';
include 'database/connection.php';
include 'assets/functions.php';
include 'includes/head.php';

//$data = array();
//$data2 = array();
//$data = $star->getRating(47);
//$data = round($data,2);
//var_dump($data);
//$count = count($data);
//foreach ($data as $value) {
//    array_push($data2, $value['value']);
//}
//echo $count;
//echo '<pre>';
//print_r($data2);
//echo '</pre>';
//
//$sum = array_sum($data2);
//echo $sum;
?>
<script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous">
</script>


<div id="main-index-div">
    <?php
    $posts = $queryToDataBase->getAllPosts();
    foreach ($posts as $post):
        $category = $queryToDataBase->getCategoriesById($post['id_category']);
        $star_value = $star->getRating($post['id']);
        $url = BASE_URL.'/'.$post['img'];
        $url_no_pic = BASE_URL.'/img/nopic.png';
        ?>
    <section class="article-section">
        <div class="article-title-div">
            <?php
            if(!empty($post['img'])) {
                echo ' <div class="post-div-pic-card" style=" background-image: url('.$url.')"> </div>';
            }else {
                echo ' <div class="post-div-pic-card" style=" background-image: url('.$url_no_pic.')"> </div>';
            }
            ?>

            <div class="post-div-h3" style="display: inline-block;"> <h3><a href="includes/post.php?id=<?=$post['id']?>"><?php echo $post['title']; ?> </a></h3> </div>
        </div>

        <p><?php echo my_cut($post['text'], 128)?></p>
        <p>Категория: <?php echo $category['name']; ?></p>
        <p>Автор: <?php echo $post['login']; ?></p>
        <?php
        if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $post['login']) {
            echo ' <button class="btn-edit" data-id="'.$post['id'].'">Редактировать</button>';
        }
        if(isset($_SESSION['user']) AND $_SESSION['user']['login'] == $post['login']) {
            echo '<button class="btn-delete" data-id="'.$post['id'].'" id="'.$post['id'].'" style="background: #ee3838">Удалить</button>';
        }
        ?>

        <div class="form"
             <?php
             if(!isset($_SESSION['user'])) {

             echo 'style="pointer-events: none;"';

        }
             ?>
        >
            <div data-ajax="true" class="rating rating_set">
                <div class="rating__body">
                    <div class="rating__active"></div>
                    <div class="rating__items">
                        <input type="radio" class="rating__item" value="1" name="rating" data-id="<?php echo $post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                        <input type="radio" class="rating__item" value="2" name="rating" data-id="<?php echo $post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                        <input type="radio" class="rating__item" value="3" name="rating" data-id="<?php echo $post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                        <input type="radio" class="rating__item" value="4" name="rating" data-id="<?php echo $post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                        <input type="radio" class="rating__item" value="5" name="rating" data-id="<?php echo $post['id']; ?>" data-login="<?php echo $_SESSION['user']['login']; ?>">
                    </div>
                </div>
                <div class="rating__value" data-id="<?php echo $post['id']; ?>">
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


</div>
<script>
$(function () {
    $('button.btn-delete').click(function (e) {
        e.preventDefault();
        //let id = $('button.btn-delete').attr("id");
        let postId = $(this).data("id");
        //console.log(postId);
        $.ajax({
            method: "POST",
            //contentType: "application/json";
            //dataType: "json",
            url: "/includes/modaldelete.php",
            data: { "id" : postId},
            success: function (data){ // это done
                $('#main-index-div').append('<div id="div-load-modal">'+data+'</div>');
                $('#div-load-modal').data;
                //console.log(data);
            }
        })
            });
    $('button.btn-edit').click(function (e) {
        e.preventDefault();
        let postId = $(this).data("id");
        console.log(postId);
        $.ajax({
            method: "POST",
            //contentType: "application/json";
            //dataType: "json",
            url: "/includes/modaledit.php",
            data: { "id" : postId},
            success: function (data){ // это done
                $('#main-index-div').append('<div id="div-load-modal">'+data+'</div>');
                $('#div-load-modal').data;
                //console.log(data);
            }
        })
    });
    });
</script>

<script>
    $(document).ready(function (){
        $('input.rating__item').on('click', function (e){
            //debugger;
            let idPost = $(this).data("id");
            let login = $(this).data("login");
            //console.log(idPost);
            //console.log(login);
            let starValue = $(this).val();
            //console.log(starValue);
            let element = $(this).parent().parent().parent().find('div.rating__value');
            //console.log(element);
            $.ajax({
                method: "POST",
                url: "/assets/scripts/star_rating.php",
                data: { "id_post": idPost, "value": starValue, "login": login },
                success: function () {

                }
            });
            $.ajax({
                url: '/assets/scripts/star_rating.php',
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

include 'includes/footer.php';
?>

