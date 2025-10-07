<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Comptes-rendus</title>
  </head>
  <?php
          include "../../config/_config.php";
          include "../class.php";
          session_start();
          $id_prof = $_SESSION['id'];
          $day = 365;
            if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
              $requete = "SELECT id_compte_rendu, titre, date, id_etudiant, journastage_utilisateur.nom, prenom FROM journastage_compte_rendu, journastage_utilisateur, journastage_classe, journastage_enseigner WHERE journastage_compte_rendu.id_etudiant = journastage_utilisateur.id_utilisateur and journastage_utilisateur.id_classe = journastage_enseigner.id_classe and id_professeur = '$id_prof' and date >= NOW() - INTERVAL '$day' DAY ;";
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
                <a href="home.php" class="center">
                  <button class="medium fa-solid fa-arrow-left" style="color: #4a536b;">
                  </button>
                </a>
              </div>
            <h1> Comptes-rendus des élèves</h1>
          </div>
          <p class="description">
            Voici l'historique du mois des comptes-rendus de tous vos élèves.
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
          // créer un objet compte_rendu
        $compte_rendu = new Compte_rendu($liste[0], $liste[1], $liste[2], $liste[3], $liste[4], $liste[5]);
        $dico[$compte_rendu->getId()] = $compte_rendu;
        }
      }
      ?>
      <table class = "table-style">
        <thead>
          <tr>
            <th>Date</th>
            <th>Titre</th>
            <th>Elève</th>
            <th>Consulter</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($dico as $cle => $compte_rendu) { //pour afficher chaque objet compte_rendu
            ?>
            <tr>
              <td><?php echo $compte_rendu->getDate(); ?></td>
              <td><?php echo $compte_rendu->getTitre(); ?></td>
              <td><?php echo $compte_rendu->getNom_etudiant() . " " . $compte_rendu->getPrenom(); ?></td>
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
