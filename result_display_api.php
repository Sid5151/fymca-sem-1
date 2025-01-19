<?php
// Database connection
// include "dbconnect1.php"; // Uncomment if you want to store data in DB
//error_reporting(0);

$apiKey = "37231a01e7734521a12a04f47128902f"; // Your actual API key

// Get recipe_id from query parameters
$recipe_id = isset($_POST['recipe_id']) ? intval($_POST['recipe_id']) : 0;

if ($recipe_id > 0) {
    $apiUrl = "https://api.spoonacular.com/recipes/$recipe_id/information?apiKey=$apiKey";

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

    if (!empty($data)) {
        $title = $data['title'];
        $image = $data['image'];
        $description = $data['summary'];
        $recipeTime = isset($data['readyInMinutes']) ? $data['readyInMinutes'] . ' minutes' : 'N/A';
        $diet = isset($data['vegetarian']) && $data['vegetarian'] ? 'Vegetarian' : 'Non-Veg';

        // Process ingredients
        $ingredientsList = '';
        if (!empty($data['extendedIngredients'])) {
            foreach ($data['extendedIngredients'] as $ingredient) {
                $ingredientsList .= $ingredient['original'] . "<br><hr>";
            }
        } else {
            $ingredientsList = "No ingredients found.";
        }

        // Process steps
        $steps = 'No steps available';
        if (isset($data['analyzedInstructions'][0]['steps'])) {
            $stepsArray = $data['analyzedInstructions'][0]['steps'];
            $steps = '';
            foreach ($stepsArray as $step) {
                $steps .= 'Step ' . $step['number'] . ': ' . $step['step'] . "<br><hr>";
            }
        }

        echo '
        <div id="img_aur_title" class="d-flex flex-column align-items-center border shadow-lg">
            <h3 style="background-color: white; color: black; width: 30%; text-align: center; padding: 1rem; border-radius: 1rem; margin-top: 1rem;">' . $title . '</h3>
            <img class="align-self-center" src="' . $image . '" width="50%" alt="" />
            <div id="time">
                <span>' . $recipeTime . ' - </span><span><i>' . $diet . ' Dish</i> </span>
            </div>
        </div>
        <br />
        <h3>Ingredients</h3>
        <div id="ingre" class="border shadow-sm p-2 font-weight-normal">
            <p>' . $ingredientsList . '</p>
        </div>
        <br />
        <h3>Steps</h3>
        <div id="ingre" class="border shadow-sm p-2">
            <p>' . $steps . '</p>
        </div>';
    } else {
        echo "Recipe details not found.";
    }
} else {
    echo "Invalid recipe ID.";
}
