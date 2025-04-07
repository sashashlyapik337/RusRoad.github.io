<?php include("path.php");

include "applicate/control/topics.php";
$post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="asset/css/style.css">
    <title>RusRoad</title>
</head>
<body>
<div class="wrapper">
<?php include("applicate/include/header.php"); ?>
<!-- блок main-->
<main class="main">
        <!-- Main Content -->
        <div class="main-content">
            <h2 class="comment-title"><?php echo $post['title']; ?></h2>

            <div class="single_post">
                <div class="img">
                    <img src="<?=BASE_URL . 'asset/img/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                </div>
                <div class="single_post_text">
                    <?=$post['content'];?>
                </div>
                <?php include("applicate/include/comments.php"); ?>
            </div>

        </div>
        <!-- sidebar Content -->

</main>

<?php include("applicate/include/footer.php"); ?>
</div>
</body>
</html>