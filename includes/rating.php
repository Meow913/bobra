<?php
session_start();
include '../path.php';
include '../assets/functions.php';
include 'head.php';
123
?>

<div class="wrapper">
    <h1>Звёздный рейтинг</h1>
    <form action="#" class="form form_margin">
        <div class="form__item">
            <div class="form__label">Простой рейтинг (без JS):</div>
            <div class="simple-rating">
                <div class="simple-rating__items">
                    <input id="simple-rating__5" type="radio" class="simple-rating__item" name="simple-rating" value="5">
                    <label for="simple-rating__5" class="simple-rating__label"></label>
                    <input id="simple-rating__4" type="radio" class="simple-rating__item" name="simple-rating" value="4">
                    <label for="simple-rating__4" class="simple-rating__label"></label>
                    <input id="simple-rating__3" type="radio" class="simple-rating__item" name="simple-rating" value="3">
                    <label for="simple-rating__3" class="simple-rating__label"></label>
                    <input id="simple-rating__2" type="radio" class="simple-rating__item" name="simple-rating" value="2">
                    <label for="simple-rating__2" class="simple-rating__label"></label>
                    <input id="simple-rating__1" type="radio" class="simple-rating__item" name="simple-rating" value="1">
                    <label for="simple-rating__1" class="simple-rating__label"></label>
                </div>
            </div>
        </div>
        <div class="form__item">
            <div class="form__label">Точный рейтинг (JS):</div>
            <div class="rating rating_set">
                <div class="rating__body">
                    <div class="rating__active"></div>
                    <div class="rating__items">
                        <input type="radio" class="rating__item" value="1" name="rating">
                        <input type="radio" class="rating__item" value="2" name="rating">
                        <input type="radio" class="rating__item" value="3" name="rating">
                        <input type="radio" class="rating__item" value="4" name="rating">
                        <input type="radio" class="rating__item" value="5" name="rating">
                    </div>
                </div>
                <div class="rating__value">1.8</div>
            </div>
        </div>
        <button type="submit" class="form__btn btn">Отправить</button>
    </form>
    <div class="form">
        <div class="form__label">Точный рейтинг (JS + AJAX):</div>
        <div data-ajax="true" class="rating rating_set">
            <div class="rating__body">
                <div class="rating__active"></div>
                <div class="rating__items">
                    <input type="radio" class="rating__item" value="1" name="rating">
                    <input type="radio" class="rating__item" value="2" name="rating">
                    <input type="radio" class="rating__item" value="3" name="rating">
                    <input type="radio" class="rating__item" value="4" name="rating">
                    <input type="radio" class="rating__item" value="5" name="rating">
                </div>
            </div>
            <div class="rating__value">1.5</div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function (){
        $('input.rating__item').on('click', function (){
            let starValue = $(this).val();
            console.log(starValue);
            $.ajax({
                method: "POST",
                url: "../assets/scripts/star_rating.php",
                data: { "value": starValue }
            })
        });

    });
</script>



</body>
</html>