<?php
// контроллер
include_once SITE_ROOT . "/applicate/database/db.php";

$commentsForAdm = selectAll('comments');

$page = isset($_GET['post']) ? $_GET['post'] : null;
$email = '';
$comment = '';
$errMsg = [];
$status = 1;
$comments = [];

// Код для формы создания комментария
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    // Проверка, если пользователь авторизован, используем его email
    if ($_SESSION) {
        $email = $_SESSION['login'];
    } else {
        $email = trim($_POST['email']);
    }

    $commentText = trim($_POST['comment']);

    // Проверка на заполненность полей
    if ($email === '' || $commentText === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($commentText, 'UTF8') < 5) {
        array_push($errMsg, "Комментарий должен быть длиннее 5 символов");
    } else {
        // Проверка, если такой комментарий от этого пользователя уже существует на этой странице
        $existingComment = selectOne('comments', [
            'email' => $email,
            'comment' => $commentText,
            'page' => $page
        ]);

        if ($existingComment) {
            // Если комментарий уже есть, выводим ошибку
            array_push($errMsg, "Вы уже оставили этот комментарий.");
        } else {
            // Вставляем новый комментарий в базу данных
            $commentData = [
                'status' => $status,
                'page' => $page,
                'email' => $email,
                'comment' => $commentText
            ];

            insert('comments', $commentData);
            // Перенаправляем на текущую страницу, чтобы избежать повторной отправки формы при обновлении
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit(); // Завершаем скрипт, чтобы предотвратить дальнейшее выполнение
        }
    }
} else {
    $email = '';
    $comment = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

// Удаление комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('comments', $id);
    header('Location: ' . BASE_URL . 'admin/comment/index.php');
    exit();
}

// Статус опубликовать или снять с публикации
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    update('comments', $id, ['status' => $publish]);

    header('Location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}

// АПДЕЙТ СТАТЬИ
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $oneComment = selectOne('comments', ['id' => $_GET['id']]);
    $id = $oneComment['id'];
    $email = $oneComment['email'];
    $text1 = $oneComment['comment'];
    $pub = $oneComment['status'];
} else {
    $text1 = '';
    $pub = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $id = $_POST['id'];
    $text = isset($_POST['content']) ? trim($_POST['content']) : ''; // Проверка на наличие 'content'
    $publish = isset($_POST['publish']) ? 1 : 0;

    if ($text === '') {
        array_push($errMsg, "Комментарий не имеет содержимого текста");
    } else {
        $com = [
            'comment' => $text,
            'status' => $publish
        ];

        $comment = update('comments', $id, $com);
        header('Location: ' . BASE_URL . 'admin/comments/index.php');
        exit();
    }
} else {
    $text = isset($_POST['content']) ? trim($_POST['content']) : '';
    $publish = isset($_POST['publish']) ? 1 : 0;
}
