<?php
$role = $_POST['role'];
$nom = $_POST['name'];
$firstname = $_POST['firstname'];
$birthDate = $_POST['birthDate'];
$email = $_POST['email'];
$destinataire = 'lucas.laulanet08@gmail.com';
$objet = 'Demande de création de compte';
$text = "role : '$role' nom : '$nom' prénom : '$firstname' date de naissance : '$birthDate' email : '$email'";

// En-têtes de l'email
if (mail($destinataire, $objet, $text, $email)) {
    echo "Email envoyé avec succès. Vous recevrez un mail lorsque votre compte sera créé.";
} else {
    echo "Échec de l'envoi de l'email.";
}
?>