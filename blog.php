<?php
include "path.php";
include "applicate/control/topics.php";

// Инициализация переменных по умолчанию
$posts = selectAll('posts'); // Отображение всех статей по умолчанию
$category = null;
$topics = selectAll('topics'); // Получение списка всех категорий
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RusRoad</title>
  <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
<div class="wrapper">
  
  <?php include("applicate/include/header.php"); ?>

  <main class="main">
        <div class="content-row">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="topics-wrap">
                    <ul>
                        <!-- Добавление пункта "Все категории" -->
                        <li class="topic-item-blog">
                            <a href="<?= BASE_URL . 'blog.php'; ?>">Все категории</a>
                        </li>
                        <?php foreach ($topics as $topic): ?>
                        <li class="topic-item-blog">
                            <a href="<?= BASE_URL . 'blog.php?id=' . $topic['id']; ?>">
                                <?= $topic['name']; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="topic-stat">
            <!-- Main Content -->
            
                <?php
                // Проверка, выбрана ли категория
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    $posts = selectAll('posts', ['id_topic' => $id]);
                    $category = selectOne('topics', ['id' => $id]);
                }
                ?>
                <h1 class="topic-title">
                  <span class="line"></span>
                <?php if ($category): ?>
                    Статьи из раздела &nbsp;<strong><?=   $category['name']; ?></strong>
                <?php else: ?>
                    Все статьи
                <?php endif; ?>
                  <span class="line"></span>
              </h1>
                <ul class="topic-list">
                  <?php foreach ($posts as $post): ?>


                   <li class="topic-item">
                      <a class="topic-text" href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>">
                          <img class="topic-img" src="<?=BASE_URL . 'asset/img/posts/' . $post['img']; ?>" alt="<?=$post['title'];?>">
                          <?=mb_substr($post['title'], 0, 80, 'UTF-8') . '...'; ?>
                      </a>
                   </li>


                  <?php endforeach; ?>

                  <?php if (empty($posts)): ?>
                      <p class="no-articles">Статьи по данной категории пока отсутствуют.</p>
                  <?php endif; ?>
                </ul>
        </div>

  </main>

  <?php include("applicate/include/footer.php"); ?>

</div>
</body>
</html>
