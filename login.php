<?php
require_once 'assets/config/database.php';
session_start(); // Nécessaire pour utiliser $_SESSION

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim(htmlspecialchars($_POST["email"] ?? ''));
    $password = $_POST["password"] ?? '';

    // Vérification de l'email
    if (empty($email)) {
        $errors[] = "T'as pas mis ton email.";
    }

    // Vérification du mot de passe
    if (empty($password)) {
        $errors[] = "T'as oublié ton mot de passe.";
    }

    // Si pas d'erreurs, on continue avec la vérification en base
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifie le mot de passe avec password_verify()
            if (password_verify($password, $user['password'])) {
                // Authentification réussie
                $_SESSION['user_id'] = $user['id'];
                header("Location: dashboard.php"); // redirige vers une page sécurisée
                exit;
            } else {
                $errors[] = "Mot de passe incorrect.";
            }
        } else {
            $errors[] = "Aucun compte trouvé avec cet email.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="assets/style/style.css">
</head>
<body>
    <section>
        <form action="" method="POST">
            <?php
                foreach ($errors as $error) {
                    echo $error;
                }
                if(!empty($message)) {
                    echo $message;
                }
            ?>
             <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Entrez votre email">
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" name="password" id="password" required placeholder="entrer votre mdp">
            </div>
            <div>
                <input type="submit" value="enter">
            </div>
        </form>
    </section>
</body>
</html>