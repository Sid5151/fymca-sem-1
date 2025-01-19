<?php
// Database connection
// include "dbconnect1.php"; // Uncomment if you want to store data in DB
//error_reporting(0);

// API Key and Endpoint
$apiKey = "fdabb44a326a44ec905c14168fb25040"; // Replace with your API key
$searchQuery = "Indian"; // Search term
$number = 1; // Number of results per page

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
    $description = $ingredientsData['summary'];

    // Limit description to 5 words
    $descriptionWords = explode(' ', $description);
    $limitedDescription = implode(' ', array_slice($descriptionWords, 0, 5)) . '...';

    $diet = isset($ingredientsData['vegetarian']) && $ingredientsData['vegetarian'] ? 'Vegetarian' : 'Non-Veg';
    $diet = isset($ingredientsData['vegan']) && $ingredientsData['vegan'] ? 'Vegan' : $diet;
    $recipeTime = isset($ingredientsData['readyInMinutes']) ? $ingredientsData['readyInMinutes'] : 'N/A';

    echo '
                <div class="col-md-12 py-3">
            <h5>Popular Recipies</h5>
            <hr />
            <div class="card-deck">
              <div class="card">
                <a href="">
                  <img
                    src="' . $image . '"
                    class="card-img-top"
                    alt=""/>
                </a>

                <div class="card-body">
                  <div class="card-title">' . $title . '</div>
                  <p class="card-text">
                    ' . $description . '
                  </p>
                </div>
              </div>
              
          ';
  }
}
