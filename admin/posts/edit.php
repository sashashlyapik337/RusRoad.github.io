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
    <title>RusRoad</title>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <?php include("../../applicate/include/header.php"); ?>
    
    <main class="main">
        <!-- Sidebar -->
        <?php include "../../applicate/include/sidebar-admin.php"; ?>

        <!-- Post Editing Section -->
        <div class="posts-management">

            <!-- Title -->
            <h2 class="posts-title"><b>Редактирование записи</b></h2>

            <!-- Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="posts-error">
                    <p><?= $_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="edit.php" method="post" enctype="multipart/form-data" class="posts-form">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                    <label for="title">Название статьи</label>
                    <input value="<?= $post['title']; ?>" name="title" type="text" id="title" class="form-control" placeholder="Введите название статьи">
                </div>
                <div class="form-group">
                    <label for="editor">Содержимое записи</label>
                    <textarea name="content" id="editor" class="form-control" rows="6"><?= $post['content']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="inputGroupFile02">Изображение</label>
                    <input name="img" type="file" class="form-control" id="inputGroupFile02">
                </div>
                <div class="form-group">
    <label for="topic">Категория</label>
    <select name="topic" class="form-select" id="topic">
    <?php foreach ($topics as $key => $topic): ?>
        <option value="<?= $topic['id']; ?>" <?= $topic['id'] == $post['id_topic'] ? 'selected' : ''; ?>><?= $topic['name']; ?></option>
    <?php endforeach; ?>
</select>

</div>

                <div class="form-group">
                    <button name="edit_post" class="btn" type="submit">Сохранить запись</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include("../../applicate/include/footer.php"); ?>

</div>
</body>
</html>
