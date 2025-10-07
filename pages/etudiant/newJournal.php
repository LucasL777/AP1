<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Nouveau compte rendu</title>
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
session_start();
$id_etudiant = $_SESSION['id'];
if (isset($_POST["btn_compte_rendu"])){
  $titre = $_POST['title'];
  $date = $_POST['date'];
  $content = $_POST['journal-content'];

  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "Insert into journastage_compte_rendu(titre, contenu, date, id_etudiant, date_time) VALUES('$titre', '$content', '$date', '$id_etudiant', NOW());";

    if ($resultat = mysqli_query($connexion,$requete)){
      ?>
      <main>
          <div class="content">
              <div class="main-content">
                  <div class="title-with-btn">
                      <h1>Compte-rendu créer !</h1>
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
    echo 'Erreur de connexion à la base de donnée';
  }
}else{ 
?>

    <main>
      <div class="content">
        <div class="main-content">
          <div class="title-with-btn">
            <div class="spacer">
                <a href="home.php" class="center">
                  <button class="medium fa-solid fa-arrow-left" style="color: #4a536b;">
                  </button>
                </a>
            </div>
            <h1>Saisir un nouveau compte rendu</h1>
            <div class="spacer"></div>
          </div>
          <p class="description">Veuillez remplir le formulaire ci-dessous pour créer un nouveau compte rendu.</p>
          <form action="#" method="post" class="newJournal">
            <div class="field-container">
              <label class="without-icon" for="title">Titre</label>
              <div class="textarea-container">
                <input
                  name="title"
                  class="field xlarge no-return"
                  id="title"
                  type="text"
                  maxlength="200"
                  placeholder="Saisissez le titre ici"
                  required
                />
              </div>
            </div>
            <div class="field-container">
              <label class="without-icon" for="date">Date</label>
              <input name="date" class="field small" id="date" type="date" required />
            </div>
            <div class="field-container">
              <label class="without-icon" for="journal-content">Contenu</label>
              <div class="textarea-container">
                <textarea
                  name="journal-content"
                  class="field xxlarge"
                  id="journal-content"
                  type="text"
                  style="resize: none;"
                  rows="10"
                  cols="50"
                  placeholder="Saisissez ici votre texte (2000 caractères maximum)"
                  maxlength="2000"
                  required
                ></textarea>
              </div>
            </div>
            <button class="medium" type="submit" style="color: #4a536b;" name="btn_compte_rendu" >Créer le compte rendu</button>
          </form>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="../contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
<?php
}
?>
