<?php session_start();

//include '../path.php';
//include '../assets/functions.php';
//include '../assets/scripts/getdata.php';

if($_POST["id"]) {
    $id_post = $_POST["id"];
    //$_SESSION['id'] = $id;
}

//$id_post = $_SESSION['id'];

//var_dump($_SESSION['id']);

?>


<div class="modal modal_active" id="modal-window" data-id="<?php echo $id_post; ?>">
            <div class="modal__content">
                <!-- Контент модального окна -->
                <h1 class="modal__title">Вы действительно хотите удалить статью:</h1>
                <button class="btn-yes">Да</button>
                <button class="btn-no" >Нет</button>
            </div>
</div>

<script>
    $(function () {
        $('button.btn-no').click(function () {
            console.log('OK');
            $('#modal-window').remove();
        });
    });
    $(function () {

    $('button.btn-yes').click(function (){
        let idPost = $('#modal-window').data("id");
        console.log(idPost);
        $.ajax({
            method: "POST",
            url: "../assets/scripts/deletepost.php",
            data: {"id": idPost},
            success: function () {
                //window.location.replace("../../index.php");
                window.location.reload();
            }

            //success: function (){

                //window.location.replace("../../index.php");
            //}
        })
    });
    });
</script>