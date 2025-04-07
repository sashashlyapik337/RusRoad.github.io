<?php include "../../path.php"; ?>
    <div class="sidebar">
        
        <ul class="topics-wrap">
            <li class="topic-item-blog">
                <a href="<?php echo BASE_URL . "admin/posts/index.php";?>">Записи</a>
            </li>
            <?php if ($_SESSION['admin']): ?>
            <li class="topic-item-blog">
                <a href="<?php echo BASE_URL . "admin/topics/index.php";?>">Категории</a>
            </li>
            <li class="topic-item-blog">
                <a href="<?php echo BASE_URL . "admin/users/index.php";?>">Пользователи</a>
            </li>
            <li class="topic-item-blog">
                <a href="<?php echo BASE_URL . "admin/comment/index.php";?>">Комментарии</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
