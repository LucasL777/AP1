<!DOCTYPE html>
<?php
  session_start();
  $nom =  $_SESSION['nom'];
  $prenom =  $_SESSION['prenom'];
  $email =  $_SESSION['email'];
  $date = $_SESSION['date_naissance'];
  $type = $_SESSION['type'];

  // Redirection en fonction du type d'utilisateur
  if ($type==1){
    $type = "etudiant/home.php";
  }else if ($type == 2){
    $type = "professeur/home.php";
  }
  ?>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Mes informations</title>
  </head>
  <body>
    <header>
      <div class="content header-content">
        <div class="navlogo-container">
          <a href="<?php echo"$type"; ?>" class="navlogo">
            <img src="../assets/img/logo.png" alt="logo" />
            <span>JournaStage</span>
          </a>
        </div>
        <div class="navlink-centre">
          <p>Mes informations</p>
        </div>
        <nav>
          <a href="<?php echo"$type"; ?>" class="navlink1 active">Mon espace</a>
          <a href="../index.php" class="navlink2">Déconnexion</a>
        </nav>
      </div>
    </header>
    <main>
      <div class="content">
        <div class="main-content">
          <h1>Mon profil</h1>
          <div class="profil-container">
            <h2><?php echo $prenom." ".$nom;  ?></h2>
            <a href="changePassword.php"  class="center">
            <button class="medium" style="color: #4a536b;">Changer mon mot de passe</button>
            </a>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
