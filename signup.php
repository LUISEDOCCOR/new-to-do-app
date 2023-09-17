<?php 
    require 'database.php';
    $error = '';
    $vh = 'vh-100';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(empty($_POST['email']) || empty($_POST['password'])){
            $error = 'Fill out all the fields' ;
            $vh = 'vh-95';    
         }else{
            $x = $conn->prepare('SELECT * FROM users WHERE gmail = :gmail LIMIT 1');
            $x->execute([':gmail' => $_POST['email']]);
            if($x->rowCount()>0){
                $error = 'That email already exists, try again';
                $vh = 'vh-95';
            }else{
                  if(strlen($_POST['password']) < 6){
                    $error = 'Min 6 characters' ;
                    $vh = 'vh-95'; 
                  }else{
                    $x = $conn->prepare('INSERT INTO users (name, gmail, password) VALUES (:name, :email, :password)');
                    $x->execute([
                    ":name" => $_POST['name'],
                    ":email" => $_POST['email'],
                    ":password" =>password_hash($_POST['password'],PASSWORD_BCRYPT)
                    ]);
                    
                    $x = $conn->prepare('SELECT * FROM users WHERE gmail = :gmail LIMIT 1');
                    $x->execute([':gmail' => $_POST['email']]);
                    $user = $x->fetch(PDO::FETCH_ASSOC);

                    session_start() ;
                    
                    unset($user['password']);
                    $_SESSION['user'] = $user;

                    header('Location: home.php');
                  }
                }
            }
    }
    require 'head.php';

?>
<body>
    <header>
        <?php require 'nav.php' ?>
        <div class="d-flex justify-content-center mt-5">
            <?php if(!empty($error)):?>
                <div class="alert alert-dismissible alert-danger mt-5 w-50 text-center" id="alert">
                    <?=$error?>
                </div>
            <?php endif ?> 
        </div>
    </header>
    <main>
        <section class="<?=$vh?> gradient-custom mb-5" id="login">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <form action="signup.php" method="post">
                                        <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                        <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                        
                                        <div class="form-outline form-white mb-4">
                                            <input name="name" type="text" id="name" class="form-control form-control-lg" />
                                            <label class="form-label" for="name">Name</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input name="email" type="email" id="email" class="form-control form-control-lg" />
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input name="password" type="password" id="password" class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <input class="btn btn-outline-light btn-lg px-5" type="submit" />
                                    </form>
                                </div>
                                <div>
                                    <p class="mb-0">Don't have an account? <a href="login.php"
                                            class="text-white-50 fw-bold">Login</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>