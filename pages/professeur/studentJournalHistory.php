<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Mes comptes rendus</title>
  </head>
  <?php
  include "../../config/_config.php";
  include "../class.php";
  session_start();
  $id_prof = $_SESSION['id'];
  $id = $_GET['id'];
  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT id_compte_rendu, titre, date, id_etudiant FROM journastage_compte_rendu, journastage_utilisateur WHERE journastage_compte_rendu.id_etudiant = '$id' ORDER BY date DESC;";
    $requete2 = "SELECT nom, prenom FROM journastage_utilisateur WHERE id_utilisateur = '$id';";
    if ($resultat = mysqli_query($connexion, $requete2 )) {
      $resultat = mysqli_query($connexion, $requete2);
      $nbligne= mysqli_num_rows ($resultat);
      if ($resultat && $nbligne > 0) {
          while ($donnees = mysqli_fetch_assoc($resultat)) {
            $nom = $donnees['nom'];
            $prenom = $donnees['prenom'];
          }
        }
      }
    if ($resultat = mysqli_query($connexion, $requete )) {
      $resultat = mysqli_query($connexion, $requete);
		  $nbligne= mysqli_num_rows ($resultat);
      $dico = array();
      
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
            <div class="spacer">
                <a href="classList.php" class="center">
                  <button class="medium fa-solid fa-arrow-left" style="color: #4a536b;">
                  </button>
                </a>
              </div>
            <h1>Comptes rendus de <?php echo $prenom." ".$nom; ?></h1>
          </div>
          <p class="description">
            Voici l'historique des comptes rendus.
          </p>
          <?php
            if($nbligne == 0){
              echo "Aucun compte-rendu enregistré";
            }
          ?>
          <div class="journalItems">
            <div class="journalItem">
              <?php
      while ($nbligne > 0) {
        $nbligne--;
        while ($nbligne = $resultat->fetch_assoc()) {
          $liste = array();
          foreach ($nbligne as $valeur) {
            $liste[] = htmlspecialchars($valeur);
          }
          // creation des objets CR
          $compte_rendu = new Compte_rendu($liste[0], $liste[1], $liste[2], $liste[3], null, null);
          $dico[$compte_rendu->getId()] = $compte_rendu;
        }
      }
      ?>
      <table class = "table-style">
        <thead>
          <tr>
            <th>Date</th>
            <th>Titre</th>
            <th>Consulter</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($dico as $cle => $compte_rendu) { // les objets CR sont recup depuis bdd dans un dico pour afficher date et titre
            ?>
            <tr>
              <td><?php echo $compte_rendu->getDate(); ?></td> 
              <td><?php echo $compte_rendu->getTitre(); ?></td>
              <td><a target="_blank" href="consultJournal.php?id_compte_rendu=<?= $cle?>"><button class="medium fa-solid fa-eye"></button></a></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <?php
    }
    mysqli_close($connexion);
  }
  ?>
              </table>      
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="../contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
