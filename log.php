<?php   
    include("path.php");
    include "applicate/control/users.php";
?>
<html lang="ru">
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


<main class="main">

<div class="reg_form">
    <form class="reg_form_action" method="post" action="log.php">
        <h2>Авторизация</h2>
        <div class="err">
            <?php if (!empty($errMsg)): ?>
                <ul>
                    <?php foreach ($errMsg as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="form-label">
            <!-- <label for="formGroupExampleInput" class="form-label">Ваша почта (при регистрации)</label> -->
            <input name="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
        </div>
        <div class="form-label">
            <!-- <label for="exampleInputPassword1" class="form-label">Пароль</label> -->
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль...">
        </div>
        <div class="btn-label">
            <button type="submit" name="button-log" class="btn-auth">Войти</button>
            <!-- <a href="reg.php">Зарегистрироваться</a> -->
        </div>
    </form>
</div>
<!-- END FORM -->
</main>

<?php include("applicate/include/footer.php"); ?>
</div>
</body>
</html>