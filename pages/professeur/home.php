<!DOCTYPE html>
<?php
  session_start();
  $nom =  $_SESSION['nom'];
  $prenom =  $_SESSION['prenom'];
  $email =  $_SESSION['email'];
  $date = $_SESSION['date_naissance'];
  $id_prof =  $_SESSION['id'];


  include "../../config/_config.php";
  include "../class.php";
  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT count(*) FROM journastage_utilisateur, journastage_enseigner WHERE journastage_utilisateur.id_classe = journastage_enseigner.id_classe; ";
    $requete2 = "SELECT count(*) FROM journastage_compte_rendu;";
    $requete3 = "SELECT journastage_utilisateur.nom, count(*) from journastage_utilisateur, journastage_compte_rendu, journastage_enseigner where journastage_utilisateur.id_utilisateur = journastage_compte_rendu.id_etudiant and journastage_utilisateur.id_classe = journastage_enseigner.id_classe  group by  journastage_utilisateur.nom ;";
    if ($resultat = mysqli_query($connexion, $requete)) {
      $resultat = mysqli_query($connexion, $requete);
      $nbligne = mysqli_num_rows ($resultat);
      if ($resultat && $nbligne > 0) {
          while ($donnees = mysqli_fetch_assoc($resultat)) {
            $nb_eleves = $donnees['count(*)'];
          }
        }
      }
    if ($resultat2 = mysqli_query($connexion, $requete2 )) {
      $resultat2 = mysqli_query($connexion, $requete2);
      $nbligne2= mysqli_num_rows ($resultat2);
      if ($resultat2 && $nbligne2 > 0) {
          while ($donnees = mysqli_fetch_assoc($resultat2)) {
            $nb_CR = $donnees['count(*)'];
          }
        }
      }
?>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Accueil</title>
  </head>
  <body>
    <header>
      <div class="content header-content">
        <div class="navlogo-container">
          <a href="#" class="navlogo">
            <img src="../../assets/img/logo.png" alt="logo" />
            <span>JournaStage</span>
          </a>
        </div>
        <div class="navlink-centre">
          <p>Espace professeur</p>
        </div>
        <nav>
          <a href="../informations.php" class="navlink1">Mes informations</a>
          <a href="../../index.php" class="navlink2">Déconnexion</a>
        </nav>
      </div>
    </header>
    <main>
      <div class="content">
        <div class="main-content">
          <h1>Bonjour <?php echo $prenom; ?> !</h1>
          <p class="description">
            Bienvenue sur JournaStage, votre espace dédié pour suivre et encadrer le parcours de vos élèves en
            entreprise.
          </p>
          <h2>Que souhaitez-vous voir ?</h2>
          <a href="classList.php" class="selection-item">
            <button class="medium">
              <i class="fa-solid fa-users"></i>
              <p>Elèves</p>
            </button>
          </a>
          <a href="consultStudentJournal.php" class="selection-item">
            <button class="medium">
              <i class="fa-solid fa-inbox"></i>
              <p>Compte-rendus</p>
            </button>
          </a>
        </div>
      </div>
      <br>
      <table class = "table-style" style="margin-top: 30px;">
        <tr>
          <th>Nombre d'élèves</th>
          <th>Total des comptes-rendus</th>
        </tr>
        <tr>
          <td><?php echo $nb_eleves ; ?></td>
          <td><?php echo $nb_CR ; ?></td>
        </tr>
      </table>
      <br>
      <?php
      if ($resultat = mysqli_query($connexion, $requete3)) {
        $resultat = mysqli_query($connexion, $requete3);
		    $nbligne= mysqli_num_rows ($resultat); 
      ?>
      <table class = "table-style" style="margin-top: 30px;">
        <tr>
          <td>Nom élève</td>
          <td>Nombre de compte rendu</td>
        </tr>
        <tbody>
        <?php
        // Affichage des résultats (depuis requete sql) dans un tableau HTML
          while ($nbligne = $resultat->fetch_assoc()) {
            echo "<tr>";
            foreach ($nbligne as $cell) {
              echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
          }
          echo "</tbody></table>";
          ?>
        </tbody>
      </table>
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="../contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
<?php
      }
  mysqli_close($connexion);
    }
?>
  </body>
</html>