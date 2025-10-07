<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Contact</title>
  </head>
  <body>

  <?php 
  if (isset($_POST['email'])){
    $lemail=$_POST['email'];
    $newmdp = mt_rand(100000,999999);
    $newmdp2 = md5($newmdp);
    include "../config/_config.php";
  
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "Select email from journastage_utilisateur where email = '$lemail'";
      $requete2 = "Update journastage_utilisateur set mot_de_passe = '$newmdp2' Where email = '$lemail'";

      if ($resultat = mysqli_query($connexion,$requete)){
        $resultat = mysqli_query($connexion, $requete);
			  $nbligne= mysqli_num_rows ($resultat);
		
			  if ($resultat && $nbligne > 0) {

				  while ($donnees = mysqli_fetch_assoc($resultat)) {
					  $var1 = $donnees['email'];
				  }
          ?>

    <main>
      <div class="content">
        <div class="main-content">
          <div class="title-with-btn">
            <h1>Email envoyé</h1>
          </div>
          <p class="description">Le formulaire a été envoyé avec comme email : <?php echo "$var1";?></p>
          <button class="medium"><a href="../index.php" style="color: white;" >Retour au menu de connexion</a></button>
        </div>
      </div>
    </main>

          <?php
          // Envoie d'un mail avec le nouveau mot de 
          // Mets à jour le mot de passe dans la base de donnée
          if ($resultat = mysqli_query($connexion,$requete2)){
          }
          $objet = "Mot de passe oublié";
          $text = "Voici votre mot de passe : " .$newmdp. ". Changer votre mot de passe une fois connecté.";
          if (mail($var1, $objet, $text)) {
          }else {
            echo "Échec de l'envoi de l'email.";
          } 
        }else{
        ?>

    <main>
      <div class="content">
        <div class="main-content">
          <div class="title-with-btn">
            <h1>Email inconnu</h1>
            <div class="spacer"></div>
          </div>
          <p class="description">Il n'y a pas de compte associé à l'email : <?php echo "$lemail";?></p>
          <button class="medium"><a href="lostPassword.php" style="color: white;" >Retour</a></button>
        </div>
      </div>
    </main>

        <?php
        }
        mysqli_close($connexion);
      }
      else{
        echo 'Erreur de connexion à la base de donnée';
      }
    }
  }
  else{
  ?>

    <header>
      <div class="content header-content">
        <div class="navlogo-container">
          <a href="../index.php" class="navlogo">
            <img src="../assets/img/logo.png" alt="logo" />
            <span>JournaStage</span>
          </a>
        </div>
      </div>
    </header>
    <main>
      <div class="content">
        <div class="main-content">
          <div class="title-with-btn">
            <h1>Mot de passe oublié</h1>
            <div class="spacer"></div>
          </div>
          <p class="description">Veuillez saisir votre adresse email ci-dessous. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
          <form action="lostPassword.php" method="post" class="newJournal">
            <div class="field-container">
              <label class="without-icon" for="email">Adresse email</label>
              <input
                name="email"
                class="field large"
                id="email"
                type="email"
                placeholder="Saisissez ici votre adresse email"
                required
              />
            </div>
            <button class="medium" type="submit">Envoyer</button>
          </form>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p><a href="contact.html">Besoin d'aide ?</a></p>
        <p>JournaStage © 2025. Tous droits réservés.</p>
      </div>
    </footer>
  </body>
</html>

<?php
}
?>