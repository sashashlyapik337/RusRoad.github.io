<?php   include("path.php");
        include "applicate/control/users.php";
?>
<html lang="ru">
<head>

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
    <form action="reg.php" method="post" class="reg_form_action">
        <h2>Форма регистрации</h2>
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
            <!-- <label for="formGroupExampleInput" class="label">Ваш логин</label> -->
            <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="введите ваш логин...">
        </div>

        <div class="form-label">
            <!-- <label for="exampleInputEmail1" class="label">Email</label> -->
            <input name="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
        </div>

        <div class="form-label">
            <!-- <label for="exampleInputPassword1" class="label">Пароль</label> -->
            <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="введите ваш пароль...">
        </div>

        <div class="form-label">
            <!-- <label for="exampleInputPassword2" class="label">Повторите пароль</label> -->
            <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="повторите ваш пароль...">
        </div>
        <div class="btn-label">
            <button type="submit" class="btn-auth" name="button-reg">Регистрация</button>
            
        </div>
    </form>
</div>
</main>


<?php include("applicate/include/footer.php"); ?>

</div>

</body>
</html>