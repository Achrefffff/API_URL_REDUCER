<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Se connecter à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reducer2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if(isset($_GET['long_url'])) {
    $long_url = $_GET['long_url'];

    // Vérifier si l'URL longue existe déjà
    $sql = "SELECT short_url FROM urls WHERE long_url = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $long_url);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $short_url = $row['short_url'];
        echo $short_url;
    } else {
        
        $short_url = generateShortURL($conn);

        $stmt = $conn->prepare("INSERT INTO urls (long_url, short_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $long_url, $short_url);

        if ($stmt->execute() === TRUE) {
            echo $short_url;
        } else {
            echo "Erreur lors de la création de l'URL courte";
        }
    }
} else {
    echo "Aucune URL longue reçue";
}

function generateShortURL($conn) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Générer  URL courte unique
    do {
        $shortURL = substr(str_shuffle($characters), 0, 10);
        $sql = "SELECT COUNT(*) AS count FROM urls WHERE short_url = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $shortURL);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
    } while ($count > 0);

    return $shortURL;
}

$conn->close();
?>
