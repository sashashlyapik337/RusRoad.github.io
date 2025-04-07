<?php
    session_start();
    include "../../path.php";
    include "../../applicate/control/topics.php"; 
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

        <!-- Topics Management Section -->
        <div class="posts-management">

            <!-- Action Buttons -->
            <div class="posts-actions">
                <a href="<?php echo BASE_URL . "admin/topics/create.php"; ?>" class="posts-btn posts-create">
                    Создать
                </a>
            </div>
            
            <!-- Title -->
            <h2 class="posts-title"><b>Управление категориями</b></h2>

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
                <?php foreach ($topics as $key => $topic): ?>
                    <div class="posts-table-row">
                        <span class="posts-text"><?= htmlspecialchars($topic['name']); ?></span>
                        <div class="posts-row-actions">
                            <a href="index.php?del_id=<?= $topic['id']; ?>" class="posts-link posts-delete-link">Удалить</a>
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
