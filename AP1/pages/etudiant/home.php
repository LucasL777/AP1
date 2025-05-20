<!DOCTYPE html>
<?php
  session_start();
  $nom =  $_SESSION['nom'];
  $prenom =  $_SESSION['prenom'];
  $email =  $_SESSION['email'];
  $date = $_SESSION['date_naissance'];
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
            <h1>Bonjour <?php echo $prenom; ?> !</h1>
            <p class="description">
              Bienvenue sur JournaStage, votre carnet quotidien pour suivre votre expérience en entreprise.
            </p>
            <h2>Que souhaitez-vous faire ?</h2>
            <a href="newJournal.php" class="selection-item">
              <button style="color: #4a536b;" class="medium">
                <i class="medium fa-solid fa-add"></i>
                <p>Saisir un nouveau compte rendu</p>
              </button>
            </a>
            <a href="journalHistory.php" class="selection-item">
              <button style="color: #4a536b;" class="medium">
                <i class="medium fa-solid fa-newspaper"></i>
                <p>Consulter mes comptes rendus</p>
              </button>
            </a>
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
