<!DOCTYPE html>
<?php
include "../../config/_config.php";

if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT id_utilisateur, nom, prenom, email, date_naissance, type FROM journastage_utilisateur;";
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
            <a href="#" class="navlogo">
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
            <h1>Bonjour, bienvenue sur le menu administrateur !</h1>
            <h2>Que souhaitez-vous faire ?</h2>
            <br>
            <a href="accountCreate.php" class="selection-item">
            <button class="medium">
                <i class="medium fa-solid fa-add"></i>
                <p>Créer un nouveau compte</p>
            </button>
            </a>
            <a href="accountDelete.php" class="selection-item">
            <button class="medium">
                <i class="medium fa-solid fa-minus"></i>
                <p>Supprimer un compte existant</p>
            </button>
            </a>
            <br>
            <br>
          <table class = "table-style">
          <?php
          if ($resultat && $nbligne > 0) {
            echo  "<thead><tr>";
            while ($fieldinfo = $resultat->fetch_field()) {
                echo "<th>".$fieldinfo->name. "</th>" ;
            }
            echo "</tr></thead>";
          } 
          echo "<tbody>"; 
          while ($nbligne = $resultat->fetch_assoc()) {
            echo "<tr>";
            foreach ($nbligne as $cell) {
              echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
          }
          echo "</tbody>";
        }
        mysqli_close($connexion);
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