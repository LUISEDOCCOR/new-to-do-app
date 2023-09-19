<?php
session_start(); 
require 'database.php'; 
if (!isset($_SESSION['user'])) { 
    header('Location: signup.php');
    return;
}
if (!isset($_GET['id'])) {
    http_response_code(404);
    echo ("HTTP ERROR 404 NOT FOUND");
    return;
}

$x = $conn->prepare('SELECT * FROM dolist WHERE id = :id');
$x->execute([
    ':id' => $_GET['id']
]);

if ($x->rowCount() == 0) {
    http_response_code(404);
    echo ("HTTP ERROR 404 NOT FOUND");
    return;
}

$todo = $x->fetch(PDO::FETCH_ASSOC);
if ($todo['user_id'] !== $_SESSION['user']['id']) {
    http_response_code(403);
    echo ('HTTP 403 UNAUTHORIZED');
    return;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!empty($_POST['title']) || !empty($_POST['des'])){
        $x = $conn->prepare('UPDATE dolist SET title = :title, subtitle = :des WHERE id = :id');
        

        $x->execute([
            ':title' => $_POST['title'],
            ':des' => $_POST['des'],
            ':id' => $_GET['id']
        ]);

        header('Location: home.php');
    }
}
require 'head.php'
?>
<script defer src="./js/home.js"></script>
<link rel="stylesheet" href="./css/home.css">
<body>
    <header>
        <?php require 'nav.php' ?>
    </header>
    <main>
    <article id="root_alert">
        <div class="alert alert-dismissible alert-danger d-none" id="alert">

        </div>
    </article>    
    <article class="d-flex justify-content-center mt-3">
            <table class="table table-hover" id="add_to_do">
                <thead>
                    <tr class="table-dark text-center">
                        <td colspan="3">Edit To Do</td>
                    </tr>
                </thead>
                <tbody>
                    <form action="edit.php?id=<?=$todo['id']?>" method="POST" id="new_todo">
                        <tr class="table-dark">
                            <td class="w-25">
                                <input type="text" name="title" value="<?=$todo['title']?>" class="form-control " id="title" placeholder="Title">
                            </td>
                            <td>
                                <input type="text" name="des" value="<?=$todo['subtitle']?>" class="form-control w-100" id="des" placeholder="Description">
                            </td>
                            <td id="center">
                                <input id="add" type="submit" class="btn btn-success"></input>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </article>
    </main>
</body>

</html>