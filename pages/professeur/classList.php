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
  $id_prof =  $_SESSION['id'];
  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT id_utilisateur, journastage_utilisateur.nom, prenom, libelle FROM journastage_utilisateur, journastage_classe, journastage_enseigner WHERE journastage_utilisateur.id_classe = journastage_enseigner.id_classe and journastage_enseigner.id_classe = journastage_classe.id_classe and id_professeur = '$id_prof';";
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
            <h1>Mes Elèves</h1>
          </div>
          <p class="description">
            Voici tous vos élèves. Vous pouvez consulter le compte-rendu de chaque éleve.
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
          // recup depuis la bdd et creation de l'objet eleve dans un dico
        $eleve = new Eleve($liste[0], $liste[1], $liste[2], $liste[3]);
        $dico[$eleve->getId()] = $eleve;
        }
      } 
      ?>
      <table class = "table-style">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Classe</th>
            <th>Consulter</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($dico as $cle => $valeur) {
            ?>
            <tr>
              <td><?php echo $valeur->getNom(); ?></td>
              <td><?php echo $valeur->getPrenom(); ?></td>
              <td><?php echo $valeur->getClasse(); ?></td>
              <td><a href="studentJournalHistory.php?id=<?= $cle?>"><button class="medium fa-solid fa-eye"></button></a></td>
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