<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reducer2";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if(isset($_GET['short_url'])) {
    $short_url = $_GET['short_url'];

    
    $sql = "SELECT long_url FROM urls WHERE short_url = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $short_url);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $long_url = $row['long_url'];
        header("Location: " . $long_url);
    } else {
        
        echo "URL courte non trouvée";
    }
} else {
    echo "Aucune URL courte reçue";
}

$conn->close();
?>
