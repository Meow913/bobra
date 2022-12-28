<?php
session_start();
include '../../path.php';
include '../../database/connection.php';
include '../functions.php';
if(isset($_POST['input'])) {
    $_SESSION['input_search'] = $_POST['input'];
}
$posts = $queryToDataBase->searchPosts($_SESSION['input_search']);

$num_rows = count($posts);
//echo '<pre>';
//print_r($posts);
//echo '</pre>';

if ($num_rows > 0) {
    echo "<div id=\"main-index-div\">";
    foreach ($posts as $post):
        $category = $queryToDataBase->getCategoriesById($post['id_category']);
        $star_value = $star->getRating($post['id']);
        $cut_text = my_cut($post['text'], 128);
        $url = BASE_URL.'/'.$post['img'];
        $url_no_pic = BASE_URL.'/img/nopic.png';
        echo"<section class=\"article-section\">
        <div class=\"article-title-div\">";
        if(!empty($post['img'])) {
            echo ' <div class="post-div-pic-card" style=" background-image: url('.$url.')"> </div>';
        }else {
            echo ' <div class="post-div-pic-card" style=" background-image: url('.$url_no_pic.')"> </div>';
        }
        echo "<div class=\"post-div-h3\" style=\"display: inline-block;\"> <h3><a href=\"includes/post.php?id={$post['id']}\">{$post['title']}</a></h3> </div>";

        echo "</div>";

        echo "<p>Категория: {$category['name']}</p>";

    echo "</div>";
    echo "</section>";
    endforeach;
    echo "</div>";
}else {
    echo '<h1>Data not found</h1>';
}
?>


<script>
    $(function () {
        $('button.btn-delete').click(function (e) {
            e.preventDefault();
            let postId = $(this).data("id");
            $.ajax({
                method: "POST",
                url: "../../includes/modaldelete.php",
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
            console.log(postId);
            $.ajax({
                method: "POST",
                url: "../../includes/modaledit.php",
                data: { "id" : postId},
                success: function (data){ // это done
                    $('#main-index-div').append('<div id="div-load-modal">'+data+'</div>');
                    $('#div-load-modal').data;
                }
            })
        });
    });
</script>



