<?php

session_start();
include '../assets/functions.php';
?>
<script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous">
</script>
    <label>Заголовок</label><br>
    <input type="text" name="title" class="title" style="width: 100%"><br>
    <label>Текст</label><br>
    <textarea name="content" class="content" rows="10" style="width: 100%"></textarea><br>
    <input type="file" id="js-file"> <br>

    <div id="result">
        <!-- Результат из upload.php -->
    </div>
    <label>Категория: </label>
    <select name="category" style="margin-left: 25px"><br>
        <?php $categoriesAll = $queryToDataBase->getAllCategories();
        foreach ($categoriesAll as $categoryOne):?>
                    <option class="category" value="<?php echo $categoryOne['id']; ?>">
                    <?php
                    echo $categoryOne['name'];
                    ?>
                    </option>
        <?php endforeach;?>

    </select><br>
    <input type="text" name="login" class="login" placeholder="<?php echo $_SESSION['user']['login']; ?>" disabled="disabled"><br>
    <button type="submit" class="btn-add-information" name="addpost">Добавить статью</button>
    <?php
    if ($_SESSION['message']) {
        echo '<p class="msg">'.$_SESSION['message'].'</p>';
    }
    unset($_SESSION['message']);
    ?>
<script>
    $(document).ready(function (){
        $('button.btn-add-information').on('click', function (){
            let titleValue = $('input.title').val();
            let contentValue = $('textarea.content').val();
            let categoryValue = $('option.category').val();
            $.ajax({
                method: "POST",
                url: "addpostscript.php",
                data: { title: titleValue, content: contentValue, category: categoryValue }
            })
                .done(function( ) {
                    window.location.replace("myposts.php");
                });
        });

        $("#js-file").change(function(){
            if (window.FormData === undefined) {
                alert('В вашем браузере FormData не поддерживается')
            } else {
                var formData = new FormData();
                formData.append('file', $("#js-file")[0].files[0]);

                $.ajax({
                    type: "POST",
                    url: 'submit.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType : 'json',
                    success: function(msg){
                        if (msg.error == '') {
                            //$("#js-file").hide();
                            //$('#result').html(msg.success);
                        } else {
                            $('#result').html(msg.error);
                        }
                    }
                });
            }
        });
    });



</script>

<?php

?>