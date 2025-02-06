<?php
// Database connection
include "dbconnect1.php"; // Uncomment if you want to store data in DB
//error_reporting(0);
// fdabb44a326a44ec905c14168fb25040
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

    if (!isset($data['status']) == "failure") {

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
        //Api fallback logic
        $qtd = "Select * from rinfo where recipe_id ='$recipe_id'";
        $qtd_res = mysqli_query($conn, $qtd);

        if ($qtd_res) {
            while ($row = mysqli_fetch_assoc($qtd_res)) {
                $title = $row['title'];
                $image = $row['image'];
                $description = $row['description'];
                $diet = $row['diet'];
                $recipeTime = $row['recipeTime'];
                $ingredientsList = $row['ingredients'];
                $steps = $row['steps'];
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
            }
        } else {
            echo '<div class="alert alert-warning text-center mt-4" role="alert">
            <h4 class="alert-heading">No Recipes Found!</h4>
            <p>Sorry, we could not find any recipes matching your search.</p>
            <hr>
            <p class="mb-0">Try using different keywords or ingredients.</p>
        </div>
        ';
        }
    }
} else {
    $qtd = "Select * from r_info where recipe_id ='$recipe_id'";

    $qtd_res = mysqli_query($conn, $qtd);
    if ($qtd_res) {
        while ($row = mysqli_fetch_assoc($qtd_res)) {
            $title = $row['title'];
            $image = $row['image'];
            $description = $row['description'];
            $diet = $row['diet'];
            $recipeTime = $row['recipeTime'];

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
        }
    } else {
        echo '<div class="alert alert-warning text-center mt-4" role="alert">
            <h4 class="alert-heading">No Recipes Found!</h4>
            <p>Sorry, we could not find any recipes matching your search.</p>
            <hr>
            <p class="mb-0">Try using different keywords or ingredients.</p>
        </div>
        ';
    }
}
