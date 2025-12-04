<!DOCTYPE html>
<?php
include "../../config/_config.php";

if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT journastage_utilisateur.nom, COUNT(journastage_compte_rendu.id_compte_rendu) FROM journastage_utilisateur LEFT JOIN journastage_compte_rendu ON journastage_compte_rendu.id_etudiant = journastage_utilisateur.id_utilisateur WHERE journastage_utilisateur.type = 1 GROUP BY journastage_utilisateur.id_utilisateur, journastage_utilisateur.nom ORDER BY journastage_utilisateur.nom;";
    // requete pour récupérer le nom des étudiants et le nombre de comptes rendus associés
    $requete2 = "SELECT COUNT(*) FROM journastage_compte_rendu;"; // requete pour compter le nombre total de comptes rendus
    $resultat2 = mysqli_query($connexion, $requete2);
    if ($resultat = mysqli_query($connexion, $requete)) {
        $resultat = mysqli_query($connexion, $requete);
		$nbligne= mysqli_num_rows ($resultat);
        
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
          <table class = "table-style">
          <?php
          if ($resultat && $nbligne > 0) {
            echo  "<thead><tr><th>Nom de l'étudiant</th><th>Nombre de comptes rendus</th></tr></thead>"; //tableau qui affiche les statistiques, créer une ligne pour chaque ligne de données
          } 
          echo "<tbody>"; 
          while ($nbligne = $resultat->fetch_assoc()) {
            echo "<tr>";
            foreach ($nbligne as $cell) {
              echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
          }
          echo "<tr><td><strong>Total</strong></td><td><strong>" . mysqli_fetch_row($resultat2)[0] . "</strong></td></tr></tbody>";
        } // mysqli_fetch_row($resultat2)[0] = pour prendre la première colonne de la première ligne du résultat de la requête 2 soit le seul résultat
        mysqli_close($connexion); // fermer la connexion à la base de données
        }
          ?>
          </table>
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