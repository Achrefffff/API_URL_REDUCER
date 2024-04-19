<?php

// Récupérer le contenu du corps de la requête
$json_input = file_get_contents('php://input');

// Convertir le JSON en tableau associatif
$data = json_decode($json_input, true);

// Vérifier si une URL longue a été fournie
if(isset($data['long_url'])) {
    // Récupérer l'URL longue depuis les données
    $long_url = $data['long_url'];

    // Répondre avec l'URL raccourcie (temporairement renvoyée comme l'URL longue pour le moment)
    echo json_encode(array('short_url' => $long_url));
} else {
    // Si aucune URL longue n'a été fournie, renvoyer un message d'erreur
    echo json_encode(array('error' => 'Aucune URL longue fournie'));
}

?>
