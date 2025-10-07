// Connexion à la base de données et gestion de la session

<?php
include "config/_config.php";
session_start();
if (isset($_POST["btn_connexion"])) 
{
	$login = $_POST['login']; 
	$mdp = md5($_POST['password']); 

  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){

    $requete = "Select * from journastage_utilisateur where email = '$login' and mot_de_passe = '$mdp' ";
    if ($resultat = mysqli_query($connexion, $requete)) {

      $resultat = mysqli_query($connexion, $requete);
			$nbligne= mysqli_num_rows ($resultat);
      if ($resultat && $nbligne > 0) {
        
        while ($donnees = mysqli_fetch_assoc($resultat)) {
					$_SESSION['type'] = $donnees['type'];
          $_SESSION['email'] = $donnees['email'];
          $_SESSION['nom'] = $donnees['nom'];
          $_SESSION['prenom'] = $donnees['prenom'];
          $_SESSION['date_naissance'] = $donnees['date-naissance'];
          $_SESSION['id'] = $donnees['id_utilisateur'];
        }
        // Redirection en fonction du type d'utilisateur
        // 0 = admin, 1 = etudiant, 2 = professeur
        if($_SESSION['type'] == 1){
          header("Location: pages/etudiant/home.php");
          exit();
        }else if($_SESSION['type'] == 2){
          header("Location: pages/professeur/home.php");
          exit();
        }else if($_SESSION['type'] == 0){
          header("Location: pages/admin/homeAdmin.php");
          exit();
        }
        
    }
    mysqli_close($connexion);
  }
}
  else{
   echo 'Erreur de connexion à la base de donnée';
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Connexion</title>
  </head>
  <body>
    <header>
      <div class="content header-content">
        <a href="#" class="navlogo">
          <img src="assets/img/logo.png" alt="logo" />
          <span>JournaStage</span>
        </a>
        <nav>
          <a href="pages/accountRequest.html" class="navlink1">Vous n'avez pas de compte ?</a>
        </nav>
      </div>
    </header>
    <main>
      <div class="content">
        <div class="main-content">
          <h1>Bienvenue !</h1>
          <h2>Veuillez vous connecter</h2>
          <form action="#" method="post" class="login">
            <div class="field-container">
              <div class="field medium center">
                <label class="with-icon" for="login"><i class="fa-solid fa-user"></i></label>
                <input name="login" id="login" type="text" placeholder="Nom d'utilisateur" required />
              </div>
            </div>
            <div class="field-container">
              <div class="field medium center">
                <label class="with-icon" for="password"><i class="fa-solid fa-lock"></i></label>
                <input name="password" id="password" type="password" placeholder="Mot de passe" required />
              </div>
            </div>
            <button class="medium" type="submit" name="btn_connexion">Se connecter</button>
          </form>
          <p>
           <a href="pages/lostPassword.php" class="link">Mot de passe oublié ?</a>
          </p>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p><a href="pages/contact.html">Besoin d'aide ?</a></p>
        <p>JournaStage © 2025. Tous droits réservés.</p>
      </div>
    </footer>
  </body>
</html>