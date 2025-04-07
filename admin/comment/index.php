<?php
    include "../../path.php";
    include "../../applicate/control/commentaries.php"; 
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

        <!-- Comments Management Section -->
        <div class="posts-management">

            <!-- Title -->
            <h2 class="posts-title"><b>Управление комментариями</b></h2>

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

                    <span>Текст</span>

                    <span>Управление</span>
                </div>

                <!-- Table Rows -->
                <?php foreach ($commentsForAdm as $key => $comment): ?>
                    <div class="posts-table-row">

                        <span class="posts-text"><?= mb_substr($comment['comment'], 0, 50, 'UTF-8') . '...'; ?></span>
                        <?php
                            $user = $comment['email'];
                            $user = explode('@', $user);
                            $user = $user[0];
                        ?>
                        <div class="posts-row-actions">

                            <a href="edit.php?delete_id=<?= $comment['id']; ?>" class="posts-link posts-delete-link">Удалить</a>

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
