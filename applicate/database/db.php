<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'connect.php';


// Проверка выполнения запроса к БД
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}



// Запрос на получение данных с одной таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function selectLatestPosts($table, $limit = 4) {
    global $pdo;
    $sql = "SELECT * FROM $table ORDER BY created_date DESC LIMIT $limit";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}



// Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Запись в таблицу БД
function insert($table, $params) {
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" ."$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $pdo->lastInsertId();
}


// Обновление строки в таблице
function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = :$key";
        }else {
            $str = $str . ", " . $key . " = :$key";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = :id";
    $query = $pdo->prepare($sql);
    $params['id'] = $id; // Добавляем ID к массиву параметров
    $query->execute($params); // Связываем параметры с помощью подготовленного запроса
    dbCheckError($query);
}


// Обновление строки в таблице
function delete($table, $id){
    global $pdo;
    //DELETE FROM `topics` WHERE id = 3
    $sql = "DELETE FROM $table WHERE id =". $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

}
// Выборка записей (posts) с автором в админку
    function selectAllFromPostsWithUsers($table1, $table2) {
    global $pdo;
    
    // Проверяем, является ли пользователь администратором
    if ($_SESSION['admin'] == 0) {
        // Если пользователь не администратор, добавляем условие фильтрации по id_user
        $sql = "SELECT 
                    t1.id,
                    t1.title,
                    t1.img,
                    t1.content,
                    t1.status,
                    t1.id_topic,
                    t1.created_date,
                    t2.username
                FROM $table1 AS t1
                JOIN $table2 AS t2 ON t1.id_user = t2.id
                WHERE t1.id_user = :user_id"; // Фильтруем по id_user
    } else {
        // Если пользователь администратор, возвращаем все записи
        $sql = "SELECT 
                    t1.id,
                    t1.title,
                    t1.img,
                    t1.content,
                    t1.status,
                    t1.id_topic,
                    t1.created_date,
                    t2.username
                FROM $table1 AS t1
                JOIN $table2 AS t2 ON t1.id_user = t2.id";
    }

    // Подготовка запроса
    $query = $pdo->prepare($sql);

    // Если пользователь не администратор, связываем параметр с id_user
    if ($_SESSION['admin'] == 0) {
        $query->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_INT);
    }

    // Выполнение запроса
    $query->execute();
    
    // Проверка на ошибки
    dbCheckError($query);
    
    // Возвращаем результат
    return $query->fetchAll();
}


// Выборка записей (posts) с автором на главную
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1 LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записей (posts) с автором на главную
function selectTopTopicFromPostsOnIndex($table1){
    global $pdo;
    $sql = "SELECT * FROM $table1 ";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();

}


// Поиск по заголовкам и содержимому (простой)
function seacrhInTitileAndContent($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
        p.*, u.username 
        FROM $table1 AS p 
        JOIN $table2 AS u 
        ON p.id_user = u.id 
        WHERE p.status=1
        AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

// Выборка записи (posts) с автором для синг
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id=$id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

// Считаем количество строк в таблице
function countRow($table){
    global $pdo;
    $sql = "SELECT Count(*) FROM $table";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}