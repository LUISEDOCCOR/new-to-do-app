<?php 
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: signup.php');
        return;
    }

    require 'head.php';

    $todos = array(
        array('Title' => 'Tarea', 'Des' => 'Pag 186'),
        array('Title' => 'Tv', 'Des' => 'Ver Naruto'),
        array('Title' => 'Papeleria', 'Des' => 'Comprar carutlina')
    );
?> 
<script src="https://kit.fontawesome.com/91c956bb82.js" crossorigin="anonymous"></script> 
<script defer src="./js/home.js"></script>
<link rel="stylesheet" href="./css/home.css">
<body>
    <header>
        <?php require 'nav.php'?> 
        <div id="welcome">
            <h2>Welcome</h2>
            <h3><?=$_SESSION['user']['name']?></h3>
        </div>
    </header>
    <main>
        <article id="root_alert" >
            <div class="alert alert-dismissible alert-danger d-none" id="alert">
                
            </div>
        </article>
        <article class="d-flex justify-content-center mt-3" >
            <table class="table table-hover" id="add_to_do">
                <thead>
                    <tr class="table-dark text-center">
                        <td colspan="3">Add To Do</td>
                    </tr>
                </thead>
               <tbody>
                    <form action="" method="" id="new_todo">
                        <tr class="table-dark">
                            <td class="w-25">
                                <input type="text" name="title" class="form-control " id="title" placeholder="Title">
                            </td>
                            <td>
                                <input type="text" name="des" class="form-control w-100" id="des" placeholder="Description">
                            </td>
                            <td id="center">
                                <input id="add" type="submit" class="btn btn-success">
                            </td>
                        </tr>
                    </form>
               </tbody>
            </table>
        </article> 
        <article class="table table-hover d-flex justify-content-center">
            <table id="todos">
                <thead class="text-center">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- x cada item -->
                   <?php foreach($todos as $item): ?>
                        <tr class="table-primary">
                            <td class="w-25 text-center"><?=$item['Title'] ?></td>
                            <td class="w-50 text-center"><?=$item['Des'] ?></td>
                            <td class="w-25 text-center">
                                <a href="#" type="button" class="btn btn-warning m-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td class="w-25 text-center">
                                <a href="#" type="button" class="btn btn-success m-2">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                            </td>
                            <td class="w-25 text-center">
                                <a href="#" type="button" class="btn btn-danger m-2">
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