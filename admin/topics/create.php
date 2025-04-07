<?php
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
    <title>RusRoad - Создать категорию</title>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <?php include("../../applicate/include/header.php"); ?>

    <main class="main">
        <!-- Sidebar -->
        <?php include "../../applicate/include/sidebar-admin.php"; ?>

        <!-- Create Category Section -->
        <div class="posts-management">
            <!-- Title -->
            <h2 class="posts-title"><b>Создать категорию</b></h2>

            <!-- Error Message -->
            <div class="posts-error">
                <?php if (isset($errMsg) && $errMsg !== ''): ?>
                    <?= $errMsg ?>
                <?php endif; ?>
            </div>

            <!-- Form -->
            <div class="posts-form">
                <form action="create.php" method="post">
                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="category-name">Имя категории</label>
                        <input type="text" id="category-name" name="name" class="form-control" value="<?= $name; ?>" placeholder="Имя категории" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" name="topic-create" class="btn btn-primary">Создать категорию</button>
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
