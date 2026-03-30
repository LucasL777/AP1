<!DOCTYPE html>
<?php
  include "../config/_config.php";
  session_start();
  $id = $_SESSION['id'];
  $nom =  $_SESSION['nom'];
  $prenom =  $_SESSION['prenom'];
  $email =  $_SESSION['email'];
  $date = $_SESSION['date_naissance'];
  $type = $_SESSION['type'];
  $tel = $_SESSION['tel'];
  $entreprise = $_SESSION['entreprise'];
  $tuteur = $_SESSION['tuteur'];


  // Redirection en fonction du type d'utilisateur
  if ($type==1){
    $type = "etudiant/home.php";
  }else if ($type == 2){
    $type = "professeur/home.php";
  }

  if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
    $requete = "SELECT name, rue, ville, cp FROM journastage_entreprise WHERE id = '$entreprise';";
    if ($resultat = mysqli_query($connexion, $requete)) {
      while ($donnees = mysqli_fetch_assoc($resultat)) {
        $entreprise_nom = $donnees['name'];
        $entreprise_rue = $donnees['rue'];
        $entreprise_ville = $donnees['ville'];
        $entreprise_cp = $donnees['cp'];
      }

  }
  }

  if(isset($_POST['modifier_tel'])){
    $new_tel = $_POST['tel'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "UPDATE journastage_utilisateur SET tel = '$new_tel' WHERE id_utilisateur = '".$_SESSION['id']."';";
      if ($resultat = mysqli_query($connexion, $requete)) {
        $_SESSION['tel'] = $new_tel;
        header("Location: informations.php");
        exit();
      }
    }
  }

  if(isset($_POST['modifier_tuteur'])){
    $new_tuteur = $_POST['tuteur'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "UPDATE journastage_utilisateur SET tuteur = '$new_tuteur' WHERE id_utilisateur = '".$_SESSION['id']."';";
      if ($resultat = mysqli_query($connexion, $requete)) {
        $_SESSION['tuteur'] = $new_tuteur;
        header("Location: informations.php");
        exit();
      }
    }
  }

  if(isset($_POST['modifier_entreprise'])){
    $entreprise_nom = $_POST['entreprise_nom'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "UPDATE journastage_entreprise SET nom = '$entreprise_nom' WHERE id = '".$_SESSION['entreprise']."';";
      if ($resultat = mysqli_query($connexion, $requete)) {
        $_SESSION['entreprise_nom'] = $entreprise_nom;
        header("Location: informations.php");
        exit();
      }
    }
  }

  if(isset($_POST['modifier_lieux'])){
    $entreprise_rue = $_POST['entreprise_rue'];
    $entreprise_ville = $_POST['entreprise_ville'];
    $entreprise_cp = $_POST['entreprise_cp'];
    if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
      $requete = "UPDATE journastage_entreprise SET rue = '$entreprise_rue', ville = '$entreprise_ville', cp = '$entreprise_cp' WHERE id = '".$_SESSION['entreprise']."';";
      if ($resultat = mysqli_query($connexion, $requete)) {
        $_SESSION['entreprise_rue'] = $entreprise_rue;
        $_SESSION['entreprise_ville'] = $entreprise_ville;
        $_SESSION['entreprise_cp'] = $entreprise_cp;
        header("Location: informations.php");
        exit();
      }
    }
  }
  ?>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/style.css" />
    <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
    <title>AP1 - Mes informations</title>
  </head>
  <body>
    <header>
      <div class="content header-content">
        <div class="navlogo-container">
          <a href="<?php echo"$type"; ?>" class="navlogo">
            <img src="../assets/img/logo.png" alt="logo" />
            <span>JournaStage</span>
          </a>
        </div>
        <div class="navlink-centre">
          <p>Mes informations</p>
        </div>
        <nav>
          <a href="<?php echo"$type"; ?>" class="navlink1 active">Mon espace</a>
          <a href="../index.php" class="navlink2">Déconnexion</a>
        </nav>
      </div>
    </header>
    <main>
      <div class="content">
        <div class="main-content">
          <h1>Mon profil</h1>
          <div class="profil-container">
            <h2><?php echo $prenom." ".$nom;  ?></h2>
            <form method="POST"><p><strong>Tél : </strong><input type="text" name="tel" value="<?php echo $tel;  ?>"><button type="submit" name="modifier_tel">Modifier</button></p></form>
            <br>
            <form method="POST"><p><strong>Entreprise : </strong><input type="text" name="entreprise_nom" value="<?php echo $entreprise_nom;  ?>"><button type="submit" name="modifier_entreprise">Modifier</button></p></form>
            <form method="POST"><p><strong>Adresse de l'entreprise : </strong><input type="text" name="entreprise_rue" value="<?php echo $entreprise_rue;  ?>"><input type="text" name="entreprise_ville" value="<?php echo $entreprise_ville;  ?>"><input type="text" name="entreprise_cp" value="<?php echo $entreprise_cp;  ?>"><button type="submit" name="modifier_lieux">Modifier</button></p></form>
            <br>
            <form method="POST"><p><strong>Tuteur : </strong><input type="text" name="tuteur" value="<?php echo $tuteur;  ?>"><button type="submit" name="modifier_tuteur">Modifier</button></p></form>
            <a href="changePassword.php"  class="center">
            <button class="medium" style="color: #4a536b;">Changer mon mot de passe</button>
            </a>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <div class="content footer-content">
        <p>JournaStage © 2025. Tous droits réservés.</p>
        <p><a href="contact.html">Besoin d'aide ?</a></p>
      </div>
    </footer>
  </body>
</html>
