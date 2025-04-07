<?php session_start();
    include "../../path.php";
    include "../../applicate/control/users.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../asset/css/admin.css">
    <title>RusRoad</title>
</head>
<body>

<?php include("../../applicate/include/header-admin.php"); ?>

<div class="container">
<?php include "../../applicate/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class="col-2 btn btn-success">Создать</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-3 btn btn-warning">Редактировать</a>
        </div>
        <div class="row title-table">
            <h2>Создать пользователя</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <!-- Вывод массива с ошибками -->
                <?php include "../../applicate/helps/errorInfo.php"; ?>
            </div>
            <form action="edit.php" method="post">
                <input name="id" value="<?=$id;?>" type="hidden">
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label">Логин</label>
                    <input name="login" value="<?=$username;?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="введите ваш логин...">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="mail" value="<?=$email;?>" type="email" class="form-control" readonly id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
                </div>
                <div class="col">
                    <label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль...">
                </div>
                <div class="col">
                    <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль...">
                </div>
                <input name="admin" class="form-check-input" value="1" type="checkbox" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    Admin?
                </label>
                <div class="col">
                    <button name="update-user" class="btn btn-primary" type="submit">Обновить</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>


<?php include("../../applicate/include/footer.php"); ?>

</body>
</html>

