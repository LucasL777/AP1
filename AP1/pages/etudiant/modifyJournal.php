<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Modifier mon compte rendu</title>
  </head>
  <body>
    <header>
      <div class="content header-content">
        <div class="navlogo-container">
          <a href="home.php" class="navlogo">
            <img src="../../assets/img/logo.png" alt="logo" />
            <span>JournaStage</span>
          </a>
        </div>
        <div class="navlink-centre">
          <p>Espace étudiant</p>
        </div>
        <nav>
          <a href="../informations.php"  class="navlink1">Mes informations</a>
          <a href="../../index.php" class="navlink2">Déconnexion</a>
        </nav>
      </div>
    </header>
<?php
include "../../config/_config.php";
$titre = $_POST['newtitle'];
$date = $_POST['newdate'];
$content = $_POST['newjournal-content'];
$id = $_POST['id_compte_rendu'];

  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "Update journastage_compte_rendu set titre = '$titre', date = '$date', contenu = '$content' where id_compte_rendu = '$id';";

    if ($resultat = mysqli_query($connexion,$requete)){
      ?>
      <main>
          <div class="content">
              <div class="main-content">
                  <div class="title-with-btn">
                      <h1>Compte-rendu modifié !</h1>
                  <div class="spacer"></div>
                  </div>
                  <button class="medium"><a href="home.php" style="color: white;" >Retour au menu</a></button>
              </div>
          </div>
      </main>
      <?php
    }
    mysqli_close($connexion);
  }
  else{
    echo 'Erreur';
  }
  ?>
