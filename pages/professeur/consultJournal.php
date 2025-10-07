<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Mon compte-rendu</title>
  </head>
  <?php
    include "../../config/_config.php";
    include "../class.php";
    session_start();
    $id_professeur = $_SESSION['id'];
    $id = $_GET['id_compte_rendu'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "SELECT titre, date, DAY(date_time), MONTH(date_time), YEAR(date_time), contenu, id_etudiant, journastage_utilisateur.nom, prenom FROM journastage_compte_rendu, journastage_utilisateur WHERE journastage_compte_rendu.id_etudiant = journastage_utilisateur.id_utilisateur and id_compte_rendu = '$id';";
      if ($resultat = mysqli_query($connexion, $requete )) {
        $resultat = mysqli_query($connexion, $requete);
        $nbligne= mysqli_num_rows ($resultat);
        if ($resultat && $nbligne > 0) {
          while ($donnees = mysqli_fetch_assoc($resultat)) {
            $contenu = $donnees['contenu'];
            $id = $donnees['id_etudiant'];
            $nom = $donnees['nom'];
            $prenom = $donnees['prenom'];
            $titre = $donnees['titre'];
            $date = $donnees['date'];
            $day = $donnees['DAY(date_time)'];
            $month = $donnees['MONTH(date_time)'];
            $year = $donnees['YEAR(date_time)'];
          }
        }
        ?>
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
                  <p>Espace professeur</p>
                </div>
                <nav>
                  <a href="../informations.php"  class="navlink1">Mes informations</a>
                  <a href="../../index.php" class="navlink2">Déconnexion</a>
                </nav>
              </div>
            </header>
          <main>
            <div class="content">
              <div class="main-content">
                <div class="title-with-btn">
                  <h1>Compte-rendu de <?php echo $prenom." ".$nom;?></h1>
                </div>
                <p class="description">
                  Voici le compte-rendu publié le <?php echo $day."/".$month."/".$year;?>
                </p>
                <form action="modifyJournal.php" method="post">
                  <div class="field-container">
                    <label class="without-icon" for="title">Titre</label>
                    <div class="textarea-container">
                      <input 
                        name="title" 
                        style='text-align: center;' 
                        id="title" 
                        type="text" 
                        value="<?php echo $titre; ?>" 
                        readonly 
                      />
                    </div>
                  </div>
                  <div class="field-container">
                    <label class="without-icon" for="date">Date</label>
                    <input 
                      name="date" 
                      style='text-align: center;' 
                      id="date" 
                      type="date" 
                      value="<?php echo $date; ?>" 
                      readonly 
                    />
                  </div>
                  <div class="field-container">
                    <label class="without-icon" for="journal-content">Contenu</label>
                    <div class="textarea-container">
                      <textarea
                        name="journal-content"
                        id="journal-content"
                        type="text"
                        style='resize: none; text-align: center;'
                        maxlength="2000"
                        rows="10"
                        cols="50"
                        readonly
                      ><?php echo $contenu; ?></textarea>
                    </div>
                  </div>
                <input id="id" name="id_compte_rendu" type="hidden" value="<?php echo $id; ?>" />
                </form>
              </div>
            </div>
          </main>
        <?php
      }
    }
    ?>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="../contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
