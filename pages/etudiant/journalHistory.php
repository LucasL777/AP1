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
  $id_etudiant = $_SESSION['id'];
  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT id_compte_rendu, titre, date FROM journastage_compte_rendu WHERE id_etudiant = '$id_etudiant' ORDER BY date DESC;";
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
                <a href="home.php" class="center">
                  <button class="medium fa-solid fa-arrow-left" style="color: #4a536b;">
                  </button>
                </a>
              </div>
            <h1>Mes comptes rendus</h1>
          </div>
          <p class="description">
            Voici l'historique de vos comptes rendus. Vous pouvez consulter ou modifier vos comptes rendus.
          </p>
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
          // créer les objets compte_rendu et les stocker dans un dictionnaire avec l'id comme clé
        $compte_rendu = new Compte_rendu($liste[0], $liste[1], $liste[2], $id_etudiant, null, null);
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
          foreach ($dico as $cle => $compte_rendu) {
            ?>
            <tr>
              <td><?php echo $compte_rendu->getDate(); ?></td>
              <td><?php echo $compte_rendu->getTitre(); ?></td>
              <td><a href="consultJournal.php?id_compte_rendu=<?= $cle?>"><button class="medium fa-solid fa-eye"></button></a></td>
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
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="../contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
