<?php
    include "../../path.php";
    include "../../applicate/control/posts.php"; 
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../../asset/css/admin.css">
    <title>RusRoad - Добавить запись</title>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <?php include("../../applicate/include/header.php"); ?>

    <main class="main">
        <!-- Sidebar -->
        <?php include "../../applicate/include/sidebar-admin.php"; ?>

        <!-- Create Post Section -->
        <div class="posts-management">
            <!-- Title -->
            <h2 class="posts-title"><b>Добавление записи</b></h2>

            <!-- Error Message -->
            <div class="posts-error">
                <?php include "../../applicate/helps/errorInfo.php"; ?>
            </div>

            <!-- Form -->
            <div class="posts-form">
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?= $title; ?>" placeholder="Название статьи">
                    </div>

                    <div class="form-group">
                        <label for="editor">Содержимое</label>
                        <textarea id="editor" name="content" class="form-control" rows="6" placeholder="Содержимое записи"><?= $content; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputGroupFile02">Изображение</label>
                        <input type="file" id="inputGroupFile02" name="img" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="topic">Категория</label>
                        <select id="topic" name="topic" class="form-select">
                            <option selected>Категория поста:</option>
                            <?php foreach ($topics as $key => $topic): ?>
                                <option value="<?= $topic['id']; ?>"><?= $topic['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <button type="submit" name="add_post" class="btn btn-primary">Добавить запись</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include("../../applicate/include/footer.php"); ?>

</div>
</body>
</html>
