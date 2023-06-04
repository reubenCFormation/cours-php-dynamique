<?php
    require_once('../session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
   

    <body style="background:#fafdfe;">
        <div class="container">
            <div class="d-flex justify-content-between bg-info col-12"> 
                <h4 class="m-3 text-white"> Ma Belle boutique</h4>
            <nav class="navbar navbar-expand-lg navbar-light">
           
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                 <li class="nav-item active">
                     <a class="nav-link btn btn-primary m-2" href="./home_page.php"> Accueil </a>
                 </li>
                <li class="nav-item active ">
                    <?php if(isset($_SESSION["user"])): ?>
                        <a class="nav-link btn btn-primary m-2" href="./home_page.php?logout=<?php echo true?>"> Deconnexion </a>
                    <?php else:?>
                        <a class="nav-link btn btn-primary m-2" href="./login.php"> Connection </a>
                    <?php endif ?>
                   
                </li>
                <li class="nav-item active">
                    <?php if(isset($_SESSION["user"])): ?>
                        <a class="nav-link btn btn-primary m-2" href="./cart.php">Mon Panier</a>
                    <?php else: ?>
                        <a class="nav-link btn btn-primary m-2" href="./signup.php"> Inscription </a>
                    <?php endif ?>
                
            
                </li>

                <li class="nav-item active">
                    <?php if(isset($_SESSION["user"])):?>
                        <a class="nav-link btn btn-primary m-2" href="./add_product.php"> Ajouter un produit </a>
                    <?php endif ?>
                </li>
           
          
                </div>
            </nav>
            </div>   
      
        </div>

    </body>
</html>

