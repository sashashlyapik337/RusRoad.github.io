<?php
include SITE_ROOT . "/applicate/control/commentaries.php";

?>

<div class="comments">
    <h3>Оставить комментарий</h3>
    <form action="<?=BASE_URL . "single.php?post=$page"?>" method="post">
        <input type="hidden" name="page" value="<?=$page; ?>">
        <div class="form-email">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-comment">
            <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="form-submit">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>



    <?php if(count($comments) > 0): ?>
        <div class="all-comments">
            <h3 class="one-comment">Комментарии к записи</h3>
            <?php foreach ($comments as $comment): ?>
                <div class="one-comment col-12">
                    <?php if(strpos($comment['email'],'@')): ?>
                        <span><i class="email-one"></i><?=$comment['email']  ?></span>
                    <?php else: ?>
                        <span><i class="email-two"></i><?=$comment['email']  ?></span>
                    <?php endif; ?>
                    <span><i class="fart"></i><?=$comment['created_date']  ?></span>
                    <div class="text-comment-one">
                        <?=$comment['comment']  ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
</div>
