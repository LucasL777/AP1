<?php
$name = $_POST['name'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$objet = $_POST['title'];
$message = $_POST['journal-content'];
$to = 'lucas.laulanet08@gmail.com';
$headers = 'From: '.$email . "\r\n" .
           'Reply-To: lucas.laulanet08@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if(mail($to, $objet, $message, $headers)){
    echo "<script>alert('Votre message a bien été envoyé !');</script>";
    echo "<script>window.location.href = '../index.php';</script>";
} else {
    echo "<script>alert('Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.');</script>";
    echo "<script>window.location.href = 'contact.html';</script>";
}

?>