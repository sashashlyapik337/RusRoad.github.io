<?php

include SITE_ROOT . "/applicate/database/db.php";
if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

// Код для формы создания записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
    // Проверка загрузки изображения
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "/asset/img/posts/" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Подгружаемый файл не является изображением!");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);
            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер");
            }
        }
    } else {
        array_push($errMsg, "Ошибка получения картинки");
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    // Проверка значений
    if ($title === '' || $content === '' || $topic === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($title, 'UTF8') < 7) {
        array_push($errMsg, "Название статьи должно быть более 7-ми символов");
    } else {
        // Проверяем, существует ли topic с указанным id
        $topicExists = selectOne('topics', ['id' => $topic]);
        if (!$topicExists) {
            array_push($errMsg, "Выбранная тема не существует.");
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => isset($_POST['img']) ? $_POST['img'] : '',
                'status' => $publish,
                'id_topic' => $topic
            ];

            // Вставка записи, если тема найдена
            $post = insert('posts', $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }
}

// АПДЕЙТ СТАТЬИ
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);

    $id =  $post['id'];
    $title =  $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {
    $id =  $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    // Обработка изображения
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "/asset/img/posts/" . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Подгружаемый файл не является изображением!");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);
            if ($result) {
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер");
            }
        }
    } else {
        // Если изображение не изменилось, оставляем старое
        $_POST['img'] = isset($_POST['img']) ? $_POST['img'] : $post['img'];
    }

    // Проверка значений и обновление поста в базе
    if ($title === '' || $content === '' || $topic === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($title, 'UTF8') < 7) {
        array_push($errMsg, "Название статьи должно быть более 7-ми символов");
    } else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = update('posts', $id, $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
} else {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = isset($_POST['id_topic']) ? $_POST['id_topic'] : '';
}

// Статус опубликовать или снять с публикации
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

// Удаление статьи
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
