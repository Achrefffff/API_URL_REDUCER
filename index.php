<?php
header('Content-Type: application/json');
$_POST = json_decode(file_get_contents('php://input'), true);

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reducer";

// Créer une connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Fonction pour générer un URL court aléatoire
function generateShortURL($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shortURL = '';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $shortURL .= $characters[$index];
    }
    return $shortURL;
}

// Vérifier si une URL longue a été fournie dans le corps de la requête POST
if(isset($_POST) && isset($_POST['long_url'])) {
    // Récupérer l'URL longue depuis le corps de la requête POST
    $long_url = $_POST['long_url'];

    // Générer un URL court
    $short_url = generateShortURL();

    // Vérifier si l'URL court existe déjà dans la base de données
    $sql = "SELECT * FROM urls WHERE short_url = '$short_url'";
    $result = mysqli_query($conn, $sql);

    // Si l'URL court existe déjà, générer un nouvel URL court
    if(mysqli_num_rows($result) > 0) {
        $short_url = generateShortURL();
    }

    // Insérer une nouvelle URL dans la table urls
    $sql = "INSERT INTO urls (long_url, short_url, created_at) VALUES ('$long_url', '$short_url', NOW())";

    if (mysqli_query($conn, $sql)) {
        // Répondre avec l'URL court généré
        echo json_encode(array('short_url' => $short_url));
    } else {
        echo json_encode(array('error' => 'Erreur lors de la création de l\'URL court'));
    }

} else {
    // Si aucune URL longue n'a été fournie, renvoyer un message d'erreur
    echo json_encode(array('error' => 'Aucune URL longue fournie'));
}

// Fermer la connexion à la base de données
mysqli_close($conn);

?>
