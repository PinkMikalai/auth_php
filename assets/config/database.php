<?php 
// echo"hello rold";
// logique de connexion a la database

//information pour se connecter
//l'endroit ou est ma database
$host = "localhost";
//le nom de la db
$dbname = "table_users";
//identifiant de connexion
$username = "root";
//mdp de connexion
$password = "";
//port
$port = 3306;
//encodage
$charset = "utf8mb4";

//fonction qui crée et renvoi une connexion a la db
function dbConnexion() {
    //transforme mes variable en global (accessible partout)
    global $host, $dbname, $password, $table_users, $port, $charset;

    try {
        //mes param de co
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port";
        //fait mon object de co
        $pdo = new PDO($dsn, $table_users, $password);
        //comment recuperer les exception (erreurs)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //comment me renvoyer les données
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// on return l information
        var_dump($pdo);
        return $pdo; 

    } catch (PDOException $e) {
        die("et oui j ai fait de la merde". $e->getMessage());
    }
    
}

// dbConnexion();