<?php
// Database connection
include "dbconnect1.php";

// API Key and Endpoint
$apiKey = "fdabb44a326a44ec905c14168fb25040"; // Replace with your API key
$searchQuery1 = $_POST['req'];
$number = 5; // Number of results per page
$searchQuery = str_replace(" ", "_", $searchQuery1);
$ingredients = isset($_POST['ingredients']) ? $_POST['ingredients'] : '';
//$dishType = isset($_POST['dishType']) ? $_POST['dishType'] : '';
$maxCookingTime = isset($_POST['maxCookingTime']) ? intval($_POST['maxCookingTime']) : 0;

// Construct the API URL
$apiUrl = "https://api.spoonacular.com/recipes/complexSearch?apiKey=$apiKey";

if (!empty($ingredients)) {
  $apiUrl .= "&includeIngredients=" . urlencode($ingredients);
}
if (!empty($dishType)) {
  $apiUrl .= "&type=" . urlencode($dishType);
}
if ($maxCookingTime > 0) {
  $apiUrl .= "&maxReadyTime=" . $maxCookingTime;
}

$page1 = isset($_POST['page']) ? intval($_POST['page']) : 1;
$offset = ($page1 - 1) * $number;

$apiUrl .= "&query=" . urlencode($searchQuery) . "&number=$number&offset=$offset";

// Check if the recipe already exists in the database
$checkQuery = "SELECT recipe_id FROM rinfo";
$existingRecipes = [];
$result = $conn->query($checkQuery);

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $existingRecipes[] = $row['recipe_id'];
  }
}

// Initialize cURL to fetch data
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
  exit;
}
curl_close($ch);

$data = json_decode($response, true);

if (!empty($data['results'])) {
  foreach ($data['results'] as $recipe) {
    $recipe_id = $recipe['id'];

    if (!in_array($recipe_id, $existingRecipes)) {
      // Fetch additional recipe information
      $ingredientsApiUrl = "https://api.spoonacular.com/recipes/$recipe_id/information?apiKey=$apiKey";
      $ingredientsCh = curl_init($ingredientsApiUrl);
      curl_setopt($ingredientsCh, CURLOPT_RETURNTRANSFER, true);
      $ingredientsResponse = curl_exec($ingredientsCh);

      if (curl_errno($ingredientsCh)) {
        echo 'Error:' . curl_error($ingredientsCh);
        exit;
      }

      curl_close($ingredientsCh);

      $ingredientsData = json_decode($ingredientsResponse, true);

      $title = $conn->real_escape_string($recipe['title']);
      $image = $conn->real_escape_string($recipe['image']);
      $description = $conn->real_escape_string($ingredientsData['summary']);
      $diet = isset($ingredientsData['vegetarian']) && $ingredientsData['vegetarian'] ? 'Vegetarian' : 'Non-Veg';
      $diet = isset($ingredientsData['vegan']) && $ingredientsData['vegan'] ? 'Vegan' : $diet;
      $recipeTime = isset($ingredientsData['readyInMinutes']) ? intval($ingredientsData['readyInMinutes']) : 'N/A';

      // Insert recipe into database
      $insertQuery = "INSERT INTO rinfo (recipe_id, image, recipeTime, diet, title, description) 
                      VALUES ('$recipe_id', '$image', '$recipeTime', '$diet', '$title', '$description')";
      $conn->query($insertQuery);
    } else {
      // Fetch from database if already exists
      $fetchQuery = "SELECT * FROM rinfo WHERE recipe_id = '$recipe_id'";
      $dbResult = $conn->query($fetchQuery);
      if ($dbResult && $dbResult->num_rows > 0) {
        $row = $dbResult->fetch_assoc();
        $title = $row['title'];
        $image = $row['image'];
        $description = $row['description'];
        $diet = $row['diet'];
        $recipeTime = $row['recipeTime'];
      }
    }

    echo '
        <div id="results" class="p-4 mt-1 border shadow d-flex flex-column" style="border-radius: 0.5rem">
                <div class="row">
                    <div class="col-md-12 p-0 m-0 d-flex align-items-center">
                        <img src="' . $image . '" alt="Recipe Image" width="200">
                        <div id="time" class="ml-md-5">
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

  // Pagination logic
  $totalResults = min($data['totalResults'], 10);
  $totalPages = ceil($totalResults / $number);

  echo '<div class="pagination d-flex justify-content-center mt-4">';
  if ($page1 > 1) {
    echo "<a href='result.php?page=" . ($page1 - 1) . "&req=" . urlencode($searchQuery) . "'>
      <button class='btn btn-primary ml-2'>Previous</button>
    </a>";
  }

  for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page1 ? 'btn-secondary' : 'btn-primary';
    echo "<a href='result.php?page=$i&req=" . urlencode($searchQuery) . "'>
      <button class='btn $active ml-2'>$i</button>
    </a>";
  }

  if ($page1 < $totalPages) {
    echo "<a href='result.php?page=" . ($page1 + 1) . "&req=" . urlencode($searchQuery) . "'>
      <button class='btn btn-primary ml-2'>Next</button>
    </a>";
  }
  echo '</div>';
} else {
  echo '<p>No results found.</p>';
}
