<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
    <div class="container px-4">
        <a class="navbar-brand" href="#page-top">To Do app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#contact"><?php if(isset($_SESSION['user']['name'])):?>
                    <b><?=$_SESSION['user']['name']?></b>
                <?php endif ?> 
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </a></li>
            </ul>
        </div>
    </div>
</nav>