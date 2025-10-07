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
    session_start();
    include "../../config/_config.php";
    include "../class.php";
    $id_etudiant = $_SESSION['id'];
    $id = $_GET['id_compte_rendu'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "SELECT  titre, date, contenu FROM journastage_compte_rendu WHERE id_etudiant = '$id_etudiant' AND id_compte_rendu = '$id';";
      if ($resultat = mysqli_query($connexion, $requete )) {
        $resultat = mysqli_query($connexion, $requete);
        $nbligne= mysqli_num_rows ($resultat);
        if ($resultat && $nbligne > 0) {
          while ($donnees = mysqli_fetch_assoc($resultat)) {
            $contenu = $donnees['contenu'];
            $titre = $donnees['titre'];
            $date = $donnees['date'];
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
                  <p>Espace étudiant</p>
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
                  <div class="spacer">
                    <a href="journalHistory.php">
                      <button class=" medium fa-solid fa-arrow-left" style="color: #4a536b;">
                      </button>
                    </a>
                  </div>
                  <h1>Mon compte-rendu</h1>
                </div>
                <p class="description">
                  Voici votre compte-rendu. Vous pouvez le modifier ou le supprimer en cliquant sur les boutons correspondants.
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
                    <label class="without-icon" for="title">Nouveau titre</label>
                    <div class="textarea-container">
                      <input 
                        name="newtitle" 
                        style='text-align: center;' 
                        id="newtitle" 
                        type="text"  
                        required
                      />
                    </div>
                  </div>
                  <br>
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
                    <label class="without-icon" for="date">Nouvelle date</label>
                    <input 
                      name="newdate" 
                      style='text-align: center;' 
                      id="newdate" 
                      type="date" 
                      required
                    />
                  </div>
                  <br>
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
                  <div class="field-container">
                    <label class="without-icon" for="journal-content">Nouveau contenu</label>
                    <div class="textarea-container">
                      <textarea
                        name="newjournal-content"
                        id="newjournal-content"
                        type="text"
                        style='resize: none; text-align: center;'
                        maxlength="2000"
                        rows="10"
                        cols="50"
                        required
                      ></textarea>
                    </div>
                  </div>
                  <div>
                  <a href="modifyJournal.php" class="center">
                    <button class="medium fa-solid fa-pen-to-square" style="color: #4a536b;">
                      <p>Modifier</p>
                    </button>
                  </a>
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
