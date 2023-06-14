<?php

// Function to retrieve the highest score
function getHighestScore() {
    // Read the contents of the file
    $data = file_get_contents('highscore.txt');
    
    // If the file is empty or contains invalid JSON data, return an empty array
    if (empty($data) || !is_array($scores = json_decode($data, true))) {
        return array();
    }
    
    // Sort the scores in descending order based on highscore
    arsort($scores);
    
    // Get the first element (highest score)
    $highestScore = reset($scores);
    
    return $highestScore;
}

// Function to upload a new score
function uploadScore($name, $score) {
    // Create a new associative array with the name and score
    $newScore = array($name => $score);
    
    // Encode the array into JSON format
    $jsonData = json_encode($newScore);
    
    // Save the JSON data to the file
    file_put_contents('highscore.txt', $jsonData);
}









// Check if the name and score are provided
if (isset($_GET['name']) && isset($_GET['score'])) {
    $name = $_GET['name'];
    $score = $_GET['score'];
    
    // Upload the score
    uploadScore($name, $score);
}

// Retrieve the highest score
$highestScore = getHighestScore();

// Return the highest score as JSON response
header('Content-Type: application/json');
echo json_encode($highestScore);
?>
