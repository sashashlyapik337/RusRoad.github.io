<?php
    include "path.php";
    include "applicate/control/topics.php";
    $limit = 8;

    $page = isset($_GET['page']) ? $_GET['page']: 1;
    $offset = $limit * ($page - 1);
 
    $posts = selectLatestPosts('posts'); 
    $topTopic = selectTopTopicFromPostsOnIndex('posts');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RusRoad</title>
  <link rel="stylesheet" href="asset\css\style.css">
</head>
<body>
<div class="wrapper">
  
  <?php include("applicate/include/header.php")?>

  <main class="main">
    <div class="prezent-block">
      <img src="asset/img/image 5.png" class="prezent-img" alt="">
      <div class="prezent-title">
        <p class="prezent-text">
          RUSROAD — это больше, чем просто автомобили. Это о людях, которые не боятся выходить за пределы привычного, искать новые маршруты и покорять горизонты. Мы делимся полезными статьями, честными отзывами, советами для тех, кто за рулём день и ночь, а также секретами путешествий по российским и мировым дорогам.
        </p>
      </div>
    </div>

    <div class="topic-stat">
      <h1 class="topic-title"><span>НАШИ НОВЫЕ СТАТЬИ</span></h1>
      <ul class="topic-list">
          <?php foreach ($posts as $post): ?>
              <li class="topic-item">
                  <a class="topic-text" href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>">
                      <img class="topic-img" src="<?=BASE_URL . 'asset/img/posts/' . $post['img']; ?>" alt="<?=$post['title'];?>">
                      <?=mb_substr($post['title'], 0, 80, 'UTF-8') . '...'; ?>
                  </a>
              </li>

              
          <?php endforeach; ?>
      </ul>

      <a href="<?php echo BASE_URL . 'blog.php' ?>" class="topic-plus">
                    Смотреть все статьи>>
      </a>
      <a href="<?=BASE_URL . 'all_articles.php'; ?>" ></a>
</div>

    <hr style="border: 0; height: 2px; background-color: #333;">
  </main>

  <?php include("applicate/include/footer.php")?>

</div>
</body>
</html>