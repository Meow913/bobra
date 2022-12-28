<div id="main-index-div">
    <?php

    foreach ($posts as $post):
        //$category = $queryToDataBase->getCategoriesById($post['id_category']);
        //$star_value = $star->getRating($post['id']);
        //$url = BASE_URL.'/'.$post['img'];
        //$url_no_pic = BASE_URL.'/img/nopic.png';
        ?>
        <section class="article-section">
            <div class="article-title-div">


                <div class="post-div-h3" style="display: inline-block;"> <h3><a href="includes/post.php?id=<?=$post['id']?>"><?php echo $post['title']; ?> </a></h3> </div>
            </div>

            <p><?php echo my_cut($post['text'], 128)?></p>

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
                <div data-ajax="true" class="rating rating_set" style="padding-top: 10px">
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
