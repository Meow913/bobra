<?php session_start();

include '../path.php';
include '../assets/functions.php';


if($_POST["id"]) {
    $id_post = $_POST["id"];
    $_SESSION['id'] = $id_post;
}

$post = $queryToDataBase->getOnePost($_SESSION['id']);
//$category = $queryToDataBase->getCategoriesById(1);
$text = $post['text'];
$text = "<p>". str_replace("\n", "</p>\n<p>", $text)."</p>";




?>

<div class="modal modal_active" id="modal-window" data-id="<?php echo $_SESSION['id']; ?>">
            <div class="modal__content" data-url="<?php echo $post['img']; ?>">
                <!-- Контент модального окна -->
                <h1 class="modal__title">Редактировать</h1>
                <input style="width: 100%" type="text" name="title" class="title" value="<?php echo $post['title']; ?>"><br>
                <textarea name="content" class="content" rows="20" style="width: 100%"><?php echo $post['text']; ?> </textarea><br>
                <div class="div-pic-edit">
                    <?php
                        $url = BASE_URL.'/'.$post['img'];
                        if (!empty($post['img']) ) {
                            echo '<div class="div-pic-cover" style=" background-image: url(' . $url . ');" > </div> <br>';
                            echo '<div class="div-pic-edit-btn"><button class="btn-edit-pic">Изменить картинку</button></div>';
                        }else {
                            echo '<input type="file" id="js-file" name="js-file" >';
                        }
                    ?>
                </div>
                <hr>
                <div id="result">
                    <!-- Результат из upload.php -->
                </div>

                <label>Категория: </label>
                <select class = "select-class" name="category" style="margin-left: 25px"><br>
                    <?php $categoriesAll = $queryToDataBase->getAllCategories();
                    foreach ($categoriesAll as $categoryOne):?>
                        <option class="category" value="<?php echo $categoryOne['id']; ?>">
                            <?php
                            echo $categoryOne['name'];
                            ?>
                        </option>
                    <?php endforeach;?>

                </select><br>

                <button class="btn-yes" data-url="<?php echo $post['img'] ?>">Редактировать</button>
                <button class="btn-no">Отмена</button>
            </div>
</div>

<script>
        $(function () {
        $('button.btn-no').click(function () {
            $('#div-load-modal').remove();
        });
        // pic
        $('button.btn-edit-pic').click(function (e) {
            e.preventDefault();

            let postId = $('#modal-window').data("id");
            $('div.div-pic-edit').append('<input type="file" id="js-file" name="js-file">');
            $('div.div-pic-edit-btn').remove();

        });

            $('div.div-pic-edit').on('change','#js-file', function(){
                //console.log('ghtht');
                if (window.FormData === undefined) {
                    alert('В вашем браузере FormData не поддерживается')
                } else {
                    let formData = new FormData();
                    $('div.div-pic-cover').remove();
                    formData.append('file', $("#js-file")[0].files[0]);
                    $.ajax({
                        type: "POST",
                        url: 'includes/submit.php',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        dataType : 'json',
                        success: function(){

                        }
                    });
                }
            });


        $('button.btn-yes').on('click', function (){

            let titleValue = $('input.title').val();
            $('input.title').val(titleValue);

            let contentValue = $('textarea.content').val();
            $('textarea.content').val(contentValue);

            let categoryValue = $('select.select-class').change().val();
            //console.log(categoryValue );

            let img = $(this).data('url');
            console.log(img);
            $.ajax({
                method: "POST",
                url: "../assets/scripts/changepost.php",
                data: { title: titleValue, content: contentValue, category: categoryValue, imgUrl: img},
                success: function (){
                    $('#div-load-modal').remove();
                }
            });

        });

    });

</script>



