<?php
file_put_contents('log.txt', "Formulaire déclenché\n", FILE_APPEND);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Adresse email où tu veux recevoir les messages
    $to = "jlotito8@gmail.com"; // <-- remplace par la tienne

    // Sujet et contenu du mail
    $subject = "Message depuis le site web de $name";
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    // Envoi du mail
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Une erreur est survenue, le message n’a pas pu être envoyé.";
    }
} else {
    // Accès direct interdit
    http_response_code(403);
    echo "Erreur : cette page ne peut être accédée directement.";
}
?>