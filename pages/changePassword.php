<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../assets/style.css" />
        <script src="https://kit.fontawesome.com/b0d8e23d7e.js" crossorigin="anonymous" defer></script>
        <title>AP1 - Mot de passe</title>
    </head>

<?php
    session_start();
    include "../config/_config.php";
    $nom =  $_SESSION['nom'];
    $prenom =  $_SESSION['prenom'];
    $email =  $_SESSION['email'];

    if (isset($_POST['btn_mdp'])){
        $old_mdp = md5($_POST['ancien_mdp']);
        $newmdp = md5($_POST['password']);
        $newmdp2 = md5($_POST['repeat_password']);

        if($connexion = mysqli_connect($serveur, $user, $bdd_password, $BDD_name)){
            $requete = "Select mot_de_passe from journastage_utilisateur where nom = '$nom' and prenom = '$prenom' and email = '$email';";
            $requete2 = "Update journastage_utilisateur set mot_de_passe = '$newmdp2' Where nom = '$nom' and prenom = '$prenom' and email = '$email';";

            if ($resultat = mysqli_query($connexion,$requete)){
                $resultat = mysqli_query($connexion, $requete);
	            $nbligne= mysqli_num_rows ($resultat);
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $var1 = $donnees['mot_de_passe'];
                }
                //Vérification que l'ancien mot de passe est correct et que les deux nouveaux mot de passe sont identiques (pour changer son mdp)
		        if ( $newmdp == $newmdp2 && $var1 == $old_mdp) {
                    
                    if ($resultat = mysqli_query($connexion,$requete2)){
                    ?>

    <main>
        <div class="content">
            <div class="main-content">
                <div class="title-with-btn">
                    <h1>Mot de passe modifié</h1>
                </div>
                <p class="description">Le mot de passe a été changé avec succès !</p>
                <button class="medium"><a href="../index.php" style="color: white;" >Retour au menu de connexion </a></button>
            </div>
        </div>
    </main>

                    <?php
                    } // Si l'ancien mdp n'est pas correct ou que les deux nouveaux mdp ne sont pas identiques (changement de mdp impossible)
                }else{
                ?>
    
    <main>
        <div class="content">
            <div class="main-content">
                <div class="title-with-btn">
                    <h1>Mot de passe incorrect</h1>
                </div>
                <p class="description">Il se peut que l'un de vos mot de passe ne correspond pas</p>
                <button class="medium"><a href="informations.php" style="color: white;" >Retour</a></button>
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

    <body>
        <header>
            <div class="content header-content">
                <a href="#" class="navlogo">
                    <img src="../assets/img/logo.png" alt="logo" />
                    <span>JournaStage</span>
                </a>
                <nav>
                    <a href="../index.php" class="navlink1">Déconnexion</a>
                </nav>
            </div>
        </header>
        <main>
            <div class="content">
                <div class="main-content">
                    <h1>Changer votre mot de passe !</h1>
                    <form action="#" method="post" class="login">
                        <div class="field-container">
                            <div class="field medium center">
                                <label class="with-icon" for="ancien_mdp"><i class="fa-solid fa-lock-open"></i></label>
                                <input 
                                    name="ancien_mdp" 
                                    id="ancien_mdp" 
                                    type="password" 
                                    placeholder="Ancien mot de passe" 
                                    required 
                                />
                            </div>
                        </div>
                        <div class="field-container">
                            <div class="field medium center">
                                <label class="with-icon" for="password"><i class="fa-solid fa-lock"></i></label>
                                <input 
                                    name="password" 
                                    id="password" 
                                    type="password" 
                                    placeholder="Nouveau mot de passe" 
                                    required 
                                />
                            </div>
                        </div>
                        <div class="field-container">
                            <div class="field medium center">
                                <label class="with-icon" for="repeat_password"><i class="fa-solid fa-lock"></i></label>
                                <input 
                                    name="repeat_password" 
                                    id="repeat_password" 
                                    type="password" 
                                    placeholder="Répeter le nouveau mot de passe" 
                                    required 
                                />
                            </div>
                        </div>
                        <button class="medium" style="color: #4a536b;" type="submit" name="btn_mdp">Changer de mot de passe</button>
                    </form>
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

    <?php
    }
    ?>