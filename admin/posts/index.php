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

        <!-- Post Management Section -->
        <div class="posts-management">

            <!-- Action Buttons -->
            <div class="posts-actions">
                <a href="<?php echo BASE_URL . "admin/posts/create.php"; ?>" class="posts-btn posts-create">
                    Создать
                </a>
            </div>
            <!-- Title -->
            <h2 class="posts-title"><b>Управление записями</b></h2>

            <!-- Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="posts-error">
                    <p><?= $_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Table -->
            <div class="posts-table">
                <!-- Table Header -->
                <div class="posts-table-header">
                    <span>Название</span>
                    <span>Управление</span>
                </div>

                <!-- Table Rows -->
                <?php foreach ($postsAdm as $key => $post): ?>
                    <div class="posts-table-row">
                        <span class="posts-text"><?= mb_substr($post['title'], 0, 100, 'UTF-8') . '...'; ?></span>
                        <div class="posts-row-actions">
                            <a href="edit.php?id=<?= $post['id']; ?>" class="posts-link posts-edit-link">Редактировать</a>
                            <a href="edit.php?delete_id=<?= $post['id']; ?>" class="posts-link posts-delete-link">Удалить</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include("../../applicate/include/footer.php"); ?>

</div>
</body>
</html>
