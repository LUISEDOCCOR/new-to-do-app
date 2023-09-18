<?php
    session_start();
    require 'database.php';
     if(!isset($_SESSION['user'])){
        header('Location: signup.php');
        return;
    }
    if(!isset($_GET['id'])){
        http_response_code(404);
        echo("HTTP ERROR 404 NOT FOUND");
        return;
    }
    
    $x = $conn->prepare('SELECT * FROM dolist WHERE id = :id');
    $x->execute([
        ':id' => $_GET['id']
    ]);
    
    if($x->rowCount() == 0){
        http_response_code(404);
        echo("HTTP ERROR 404 NOT FOUND");
        return;
    }

    $todo = $x->fetch(PDO::FETCH_ASSOC);
    if($todo['user_id'] !== $_SESSION['user']['id']){
        http_response_code(403);
        echo('HTTP 403 UNAUTHORIZED');
        return;
    }

    $x = $conn->prepare('DELETE FROM dolist WHERE id = :id');
    $x->execute([
        ':id' => $_GET['id']
    ]);
    header('Location: home.php');