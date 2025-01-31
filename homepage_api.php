<?php
// Database connection
// include "dbconnect1.php"; // Uncomment if you want to store data in DB
//error_reporting(0);

// API Key and Endpoint
$apiKey = "fdabb44a326a44ec905c14168fb25040"; // Replace with your API key
$searchQuery = "India"; // Search term
$number = 6; // Number of results per page

// Ensure 'page' exists in $_GET and is a valid value
$apiUrl = "https://api.spoonacular.com/recipes/complexSearch?query=$searchQuery&number=$number&apiKey=$apiKey&timestamp=" . time();

// Initialize cURL
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute and decode the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
  exit;
}

curl_close($ch);

$data = json_decode($response, true);

// Check and process API response
if (!empty($data['results'])) {
  echo '<div class="row">';
  foreach ($data['results'] as $recipe) {
    $title = $recipe['title'];
    $image = $recipe['image'];
    $recipe_id = $recipe['id'];

    // Fetch the ingredients, time, and instructions for the recipe
    $ingredientsApiUrl = "https://api.spoonacular.com/recipes/$recipe_id/information?apiKey=$apiKey";
    $ingredientsCh = curl_init($ingredientsApiUrl);
    curl_setopt($ingredientsCh, CURLOPT_RETURNTRANSFER, true);
    $ingredientsResponse = curl_exec($ingredientsCh);

    // Check for cURL errors for ingredients request
    if (curl_errno($ingredientsCh)) {
      echo 'Error:' . curl_error($ingredientsCh);
      exit;
    }

    curl_close($ingredientsCh);

    $ingredientsData = json_decode($ingredientsResponse, true);
    $description = strip_tags($ingredientsData['summary']);

    // Limit description to 50 words
    $descriptionWords = explode(' ', $description);
    $limitedDescription = implode(' ', array_slice($descriptionWords, 0, 50)) . '...';

    echo '
            <div class="col-md-4 py-3">
                <div class="card">
                    <a href="recipie_display.php?recipe_id=' . $recipe_id . '">
                        <img src="' . $image . '" class="card-img-top" alt="' . $title . '" />
                    </a>
                    <div class="card-body">
                        <div class="card-title">' . $title . '</div>
                        <p class="card-text">' . $limitedDescription . '</p>
                    </div>
                </div>
            </div>
        ';
  }
  echo '</div>';
}
