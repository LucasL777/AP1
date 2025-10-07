<!DOCTYPE html>
  <html lang="fr">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="../../assets/style.css" />
      <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
      <title>AP1 - Création de compte</title>
    </head>
    <?php
    if (isset($_POST['btn_creation'])){
        $nom = $_POST['name']; 
        $prenom = $_POST['firstname'];
        $email = $_POST['email']; 
        $mdp = md5($_POST['mdp']); 
        $date = $_POST['date']; 
        $type = $_POST['role']; 
  include "../../config/_config.php";
  
  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){

    $requete = "INSERT INTO journastage_utilisateur(nom, prenom, email, mot_de_passe, type, date_naissance) VALUES('$nom', '$prenom', '$email', '$mdp', '$type', '$date');";
    $requete2 = "Select id_utilisateur from journastage_utilisateur where email = '$email';";

    if ($resultat = mysqli_query($connexion,$requete2)){
      $resultat = mysqli_query($connexion, $requete2);
		  $nbligne= mysqli_num_rows ($resultat);
		  if ($resultat && $nbligne > 0) {
            ?>
            <main>
            <div class="content">
                <div class="main-content">
                    <div class="title-with-btn">
                        <h1>Compte non créer</h1>
                        <div class="spacer"></div>
                    </div>
                <p class="description">
                Un compte existe déja avec l'email : <?php echo "$email";?>
                </p>
                <button class="medium"><a href="accountCreate.php" style="color: white;" >Retour</a></button>
                </div>
            </div>
            </main>
            <?php
            
        }else{
            if ($resultat = mysqli_query($connexion,$requete)){
            ?>
            <main>
                <div class="content">
                    <div class="main-content">
                        <div class="title-with-btn">
                            <h1>Compte créé !</h1>
                        <div class="spacer"></div>
                        </div>
                    <p class="description">
                    Le compte a été créé avec comme email : <?php echo "$email";?>
                    </p>
                        <button class="medium"><a href="homeAdmin.php" style="color: white;" >Retour au menu administrateur</a></button>
                    </div>
                </div>
            </main>
            <?php
            }
        }
    }
    mysqli_close($connexion);
    }
    else{
      echo 'Erreur de connexion à la base de donnée';
    }
  }else{    
?>
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
            <h1>Création de compte</h1>
            <form action="#" method="post" class="newJournal">
            <div class="field-container">
              <label class="without-icon" for="name">Nom</label>
              <input
                name="name"
                class="field large"
                id="name"
                type="text"
                placeholder="Saisir le nom"
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon" for="firstname">Prénom</label>
              <input
                name="firstname"
                class="field large"
                id="firstname"
                type="text"
                placeholder="Saisir le prénom"
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon" for="email">Adresse email</label>
              <input
                name="email"
                class="field large"
                id="email"
                type="email"
                placeholder="Saisir l'adresse email"
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon" for="password">Mot de passe</label>
              <?php
              $mdp_ran = mt_rand(100000,999999);
              ?>
              <input
                name="mdp"
                class="field large"
                id="mdp"
                type="text"
                value="<?php echo $mdp_ran; ?> "
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon" for="date">Date de naissance</label>
              <input
                name="date"
                class="field large"
                id="date"
                type="date"
                placeholder="Saisir la date de naissance"
                required
              />
            </div>
            <div class="field-container">
              <label class="without-icon">Statut :</label>
              <div class="radio-group">
                <label for="student">
                  <input type="radio" name="role" id="student" value="1" required />
                  Étudiant
                </label>
                <label for="teacher">
                  <input type="radio" name="role" id="teacher" value="2" />
                  Professeur
                </label>
              </div>
            </div>
            <button class="medium" type="submit" name="btn_creation">Créer le nouveau compte</button>
          </form>
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
<?php
}
?>