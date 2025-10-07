<!DOCTYPE html>
<?php
include "../../config/_config.php";
if (isset($_POST['btn_creation'])){
  $id = $_POST['id']; 
  $email = $_POST['email'];

  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete2 = "Delete from journastage_utilisateur Where id_utilisateur = '$id' and email = '$email'";
    if ($resultat = mysqli_query($connexion,$requete2)){
      header("Refresh: 1");
    }
    mysqli_close($connexion);
  }
}    
?>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Supprimer un compte</title>
  </head>
  <body>
    <header>
        <div class="content header-content">
          <div class="navlogo-container">
            <a href="homeAdmin.php" class="navlogo">
              <img src="../../assets/img/logo.png" alt="logo" />
              <span>JournaStage</span>
            </a>
          </div>
          <div class="navlink-centre">
            <p>Espace administrateur</p>
          </div>
          <nav>
            <a href="../../index.php" class="navlink1">Déconnexion</a>
          </nav>
        </div>
      </header>
    <main>
      <div class="content">
        <div class="main-content">
          <h1>Supprimer un compte existant</h1>
          <form action="#" method="post" class="newJournal">
            <div class="field-container">
              <label class="without-icon" for="email">Adresse email du compte</label>
              <input
                name="email"
                class="field large"
                id="email"
                type="email"
                placeholder="Saisir l'adresse email du compte"
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon" for="id">ID du compte</label>
              <input
                name="id"
                class="field large"
                id="id"
                type="text"
                placeholder="Saisir l'ID du compte"
                required
              />
            </div>
            <button class="medium" type="submit" name="btn_creation">Supprimer le compte</button>
          </form>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
      </div>
    </footer>
  </body>
</html>
