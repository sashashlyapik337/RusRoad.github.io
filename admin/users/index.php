<?php
session_start();
include "../../path.php";
include "../../applicate/control/users.php";
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

        <!-- User Management Section -->
        <div class="posts-management">

            <!-- Title -->
            <h2 class="posts-title"><b>Управление пользователями</b></h2>

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
                    <span>Логин</span>
                    <span>Управление</span>
                </div>

                <!-- Table Rows -->
                <?php foreach ($users as $key => $user): ?>
                    <div class="posts-table-row">
                        <span class="posts-text"><?= $user['username']; ?></span>
                        <div class="posts-row-actions">
                            <!-- Кнопка изменения статуса администратора -->
                            <?php if ($user['admin'] == 0): ?>
                                <a href="index.php?toggle_admin=<?= $user['id']; ?>" class="posts-link posts-edit-link">Дать права администратора</a>
                            <?php else: ?>
                                <a href="index.php?toggle_admin=<?= $user['id']; ?>" class="posts-link posts-edit-link">Удалить права администратора</a>
                            <?php endif; ?>
                            <a href="index.php?delete_id=<?= $user['id']; ?>" class="posts-link posts-delete-link">Удалить</a>
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
