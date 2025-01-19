<?php
// Database connection
// include "dbconnect1.php"; // Uncomment if you want to store data in DB
//error_reporting(0);

// API Key and Endpoint
$apiKey = "37231a01e7734521a12a04f47128902f"; // Replace with your API key
$searchQuery = $_POST['req'];
$number = 5; // Number of results per page

// Ensure 'page' exists in $_GET and is a valid value
$page1 = $_POST['page'];

$offset = ($page1 - 1) * $number; // Calculate offset

$apiUrl = "https://api.spoonacular.com/recipes/complexSearch?query=$searchQuery&number=$number&offset=$offset&apiKey=$apiKey&timestamp=" . time();

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

// Debugging: Uncomment below to see full response
// echo '<pre>';
// print_r($data); 
// echo '</pre>';

//echo 'Current page: ' . $page1; // Display current page

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
    $diet = isset($ingredientsData['vegetarian']) && $ingredientsData['vegetarian'] ? 'Vegetarian' : 'Non-Veg';
    $diet = isset($ingredientsData['vegan']) && $ingredientsData['vegan'] ? 'Vegan' : $diet;
    $recipeTime = isset($ingredientsData['readyInMinutes']) ? $ingredientsData['readyInMinutes'] : 'N/A';

    echo '
            <div id="results" class="p-4 mt-1 border shadow d-flex flex-column" style="border-radius: 0.5rem">
                <div class="row">
                    <div class="col-md-12 p-0 m-0 d-flex align-items-center">
                        <img src="' . $image . '" alt="Recipe Image" width="200">
                        <div id="time" style="margin-left: 5rem">
                            <span>' . $recipeTime . ' - minutes</span><span><i> ' . $diet . ' Dish</i></span>
                        </div>
                    </div>
                </div>
                <a href="recipie_display.php?recipe_id=' . $recipe_id . '">
                    <h4 class="mt-3"> ' . $title . ' </h4>
                </a>
                <p>' . $description . '</p>
            </div>';
  }

  // Pagination links
  $totalResults = min($data['totalResults'], 10);
  $totalPages = ceil($totalResults / $number);

  echo '<div class="pagination d-flex justify-content-center mt-4">';
  if ($page1 > 1) {
    echo "<a href='result.php?page=" . ($page1 - 1) . "&req=" . $searchQuery . "'>
          <button class='btn btn-primary ml-2'>&laquo; Previous</button>
        </a>";
  }
  for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='result.php?page=" . $i . "&req= " . $searchQuery . "'>
          <button class='btn btn-light mx-1'>" . $i . "</button>
        </a>";
  }
  if ($page1 < $totalPages) {
    echo "<a href='?page=" . ($page1 + 1) . "&req=" . $searchQuery . "'>
          <button class='btn btn-primary ml-2'>Next &raquo;</button>
        </a>";
  }
  echo '</div>';
} else {
  echo "<p class='text-center'>No recipes found.</p>";
}
