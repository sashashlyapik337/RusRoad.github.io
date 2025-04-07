<?php
include SITE_ROOT . "/applicate/database/db.php";

$errMsg = [];

// Функция для авторизации пользователя
function userAuth($user) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    if ($_SESSION['admin']) {
        header('Location: ' . BASE_URL . "admin/posts/index.php");
    } else {
        header('Location: ' . BASE_URL);
    }
}

// Код для изменения статуса администратора
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['toggle_admin'])) {
    $user_id = $_GET['toggle_admin'];

    // Получаем информацию о пользователе
    $user = selectOne('users', ['id' => $user_id]);

    if ($user) {
        // Переключаем статус администратора
        $new_admin_status = ($user['admin'] == 1) ? 0 : 1;

        // Обновляем статус пользователя в базе данных
        update('users', $user_id, ['admin' => $new_admin_status]);

        // Перенаправляем обратно на страницу с пользователями
        header('Location: ' . BASE_URL . 'admin/users/index.php');
        exit();
    }
}

// Получаем список всех пользователей
$users = selectAll('users');

// Код для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if ($login === '' || $email === '' || $passF === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин должен быть более 2-х символов");
    } elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence && $existence['email'] === $email) {
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);
        }
    }
} else {
    $login = '';
    $email = '';
}

// Код для формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['mail']);
    $pass = trim($_POST['password']);

    if ($email === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence && password_verify($pass, $existence['password'])) {
            userAuth($existence);
        } else {
            array_push($errMsg, "Почта либо пароль введены неверно!");
        }
    }
} else {
    $email = '';
}

// Код добавления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if ($login === '' || $email === '' || $passF === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин должен быть более 2-х символов");
    } elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email) {
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);
        }
    }
} else {
    $login = '';
    $email = '';
}

// Код удаления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('Location: ' . BASE_URL . 'admin/users/index.php');
}

// РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЯ ЧЕРЕЗ АДМИНКУ
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id =  $user['id'];
    $admin =  $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {
    $id = $_POST['id'];
    $mail = trim($_POST['mail']);
    $login = trim($_POST['login']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);
    $admin = isset($_POST['admin']) ? 1 : 0;

    if ($login === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($errMsg, "Логин должен быть более 2-х символов");
    } elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
    } else {
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        $user = [
            'admin' => $admin,
            'username' => $login,
            'password' => $pass
        ];

        $user = update('users', $id, $user);
        header('Location: ' . BASE_URL . 'admin/users/index.php');
    }
} else {
    // Проверяем, определена ли переменная $user, чтобы избежать ошибок доступа к неопределённой переменной
    if (isset($user)) {
        $id =  $user['id'];
        $admin =  $user['admin'];
        $username = $user['username'];
        $email = $user['email'];
    } else {
        // Задаём значения по умолчанию, если $user не определён
        $id = '';
        $admin = 0;
        $username = '';
        $email = '';
    }
}
?>
