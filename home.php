<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    header('Location: signup.php');
    return;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['title']) || !empty($_POST['des'])) {
        $x = $conn->prepare('INSERT INTO dolist (title, subtitle, user_id) VALUES (:title, :des, :user_id)');
        $x->execute([
            ':title' => $_POST['title'],
            ':des' => $_POST['des'],
            ':user_id' => $_SESSION['user']['id']

        ]);
    }
}

$x = $conn->prepare('SELECT * FROM dolist WHERE user_id = :user_id');
$x->execute([
    ':user_id' => $_SESSION['user']['id']
]);
$todos = $x;
require 'head.php';
?>
<script src="https://kit.fontawesome.com/91c956bb82.js" crossorigin="anonymous"></script>
<script defer src="./js/home.js"></script>
<link rel="stylesheet" href="./css/home.css">

<body>
    <header>
        <?php require 'nav.php' ?>
        <div id="welcome">
            <h2>Welcome</h2>
            <h3><?= $_SESSION['user']['name'] ?></h3>
        </div>
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
                        <td colspan="3">Add To Do</td>
                    </tr>
                </thead>
                <tbody>
                    <form action="home.php" method="POST" id="new_todo">
                        <tr class="table-dark">
                            <td class="w-25">
                                <input type="text" name="title" class="form-control " id="title" placeholder="Title">
                            </td>
                            <td>
                                <input type="text" name="des" class="form-control w-100" id="des" placeholder="Description">
                            </td>
                            <td id="center">
                                <input id="add" type="submit" class="btn btn-success"></input>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </article>
        <article class="table table-hover d-flex flex-column justify-content-center align-items-center">
            <table id="todos">
                <thead class="text-center">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <?php if($todos->rowCount() == 0): ?>
                    <h4 class="text-center mt-5">You don't have things to do</h4>
                <?php endif ?>
                <tbody>
                    <!-- x cada item -->
                    <?php foreach ($todos as $item) : ?>
                        <tr class="table-primary ">
                            <td class="w-25 text-center"><?= $item['title'] ?></td>
                            <td class="w-50 text-center"><?= $item['subtitle'] ?></td>
                            <td class="w-25 text-center">
                                <a href="edit.php?id=<?= $item['id'] ?>" type="button" class="btn btn-warning m-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td class="w-25 text-center">
                                <a href="delete.php?id=<?= $item['id'] ?>" type="button" class="btn btn-success m-2">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                            </td>
                            <td class="w-25 text-center">
                                <a href="delete.php?id=<?= $item['id'] ?>" type="button" class="btn btn-danger m-2">
                                    <i class="fa-solid fa-delete-left"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </article>
    </main>
</body>

</html>