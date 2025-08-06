<?php

$erreurs = []; //  Initialise bien le tableau

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage
    $name = trim(htmlspecialchars($_POST["name"] ?? ''));
    $email = trim(htmlspecialchars($_POST["email"] ?? ''));
    $password = $_POST["password"] ?? '';
    $confirmPassword = $_POST["confirmPassword"] ?? '';
    
// strlen - le nombre des caracteres
    //  Vérification du nom
    if (empty($name)) {
        $erreurs[] = "Le nom n'est pas rempli.";
    } elseif (strlen($name) < 3) {
        $erreurs[] = "Ton nom doit avoir plus de 3 caractères.";
    } elseif (strlen($name) > 55) {
        $erreurs[] = "Ton nom doit avoir moins de 55 caractères.";
    }

    //  Vérification de l'email
    if (empty($email)) {
        $erreurs[] = "L'email n'est pas rempli.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }

    //  Vérification des mots de passe
    if (empty($password) || empty($confirmPassword)) {
        $erreurs[] = "Le mot de passe et la confirmation sont requis.";
    } elseif ($password !== $confirmPassword) {
        $erreurs[] = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) {
        $erreurs[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <form action="" method="POST">
            <div>
                <label for="name">Name</label>
                <input id="name" type="text" required>
            </div>
             <div>
                <label for="passworld">Email :</label>
                <input id="email "type="email" required>
            </div>
             <div>
                <label for="passworld">mott de passe</label>
                <input id="passworld" type="passworld" required>
            </div>
            <div>
                <label for="confirmPassworld">confirmation de mot de passe</label>
                <input id="confirmPassworld" type="passworld" required>
            </div>
             <div>
                <input type="submit" value="inscription">
            </div>
        </form>
    </section>
</body>
</html>