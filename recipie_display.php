<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recipie Display</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Merriweather:wght@400;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="css and js/bootstrap-4.6.2-dist/css/bootstrap.css" />

  <style>
    body {
      font-family: Poppins;
    }

    /* .row {
        border: 1px solid red;
      } */
    /* #navbarhaiyeh {
        background-color: burlywood;
      } */
    #navbar {
      border-radius: 1rem;
      font-family: Poppins;
      font-size: medium;
    }

    .nav-link img {
      width: 5em;
      /* Set your desired width */
      height: 5em;
      /* Set your desired height */
      margin-right: 5px;
      /* Spacing between image and text */
      vertical-align: middle;
      /* Align image with text */
      border-radius: 1rem;
    }

    .nav-link {
      transition: color 0.3s ease, transform 0.3s ease;
      /* Smooth transition for color and scale */
    }

    .nav-link:hover {
      color: #e63946;
      /* Change to a new color on hover */
      transform: scale(1.1);
      /* Slightly increase size on hover */
    }

    .card-link {
      transition: color 0.2s ease, transform 0.2s ease;
      /* Smooth transition for color and scale */
    }

    .card:hover {
      color: #e63946;
      /* Change to a new color on hover */
      transform: scale(1.1);
      /* Slightly increase size on hover */
    }

    a {
      color: black;
    }

    .carousel-item img {
      width: 100%;
      height: 25rem;
      /* Set the height of the carousel images */
      object-fit: cover;
      /*Ensure images cover the area without distortion*/
    }

    #search img:hover {
      background-color: brown;
      /* Background color for the image */
      border-radius: 5px;
      /* Optional: Add rounded corners to the image */
    }

    #search:hover img {
      transform: scale(1.1);
      /* Add a scaling effect */
    }

    #rs-image {
      padding: 0;
      margin: 0;
    }

    #footer {
      /* background-color: black;
        background: url("images/food3.jpg") no-repeat center center;
        background-size: cover; */
      color: white;
      padding: 20px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .container-fluid,
    .row {
      padding: 0;
      margin: 0;
    }

    .carousel-inner {
      border-radius: 15px;
      /* Adjust radius as needed */
      overflow: hidden;
      /* Ensures the border radius is visible */
    }

    .navbar {
      border-radius: 1rem;
    }

    li {
      padding: 1rem;
    }

    /* for centering nav  */
    /* #navbarNav {
        display: flex;
        justify-content: center;
      } */
    #rd_image img {
      border-radius: 1rem;
    }

    #time {
      background-color: white;
      color: black;
      margin-top: 1rem;
      border-radius: 2rem;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    #img_aur_title {
      background-color: white;
      color: black;
      width: 100%;
      border-radius: 1rem;
      font-family: Poppins;
    }

    #ingre {
      border-radius: 1rem;
      background-color: rgb(239, 239, 239);
      font-size: medium;
      font-family: Poppins;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row my-3 mx-3 border shadow-sm" style="border-radius: 0.8rem">
      <div
        class="col-md-2 px-4 d-flex align-items-center justify-content-center">
        <a href="homepage.php"><img src="images/logo_sample.png" width="150em" alt="" srcset="" /></a>
      </div>
      <div class="col-md-10" id="navbarhaiyeh">
        <br />
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#"></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" id="bf" href="result.php?req='breakfast'"><img src="images/breakfast-logo.webp" /> Breakfast</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="result.php?req='starter'"><img src="images/starter-logo.webp" />Starter</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="result.php?req='lunch'"><img src="images/lunch-logo.png" />Lunch</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="result.php?req='Dinner'"><img src="images/dinner-logo.jpg" />Dinner</a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- Search Bar -->
        <br />
        <form method="get" action="result.php">
          <input
            type="search"
            class="form-control"
            name="req"
            id=""
            placeholder="Search a Recipie" />
        </form>
        <br />
      </div>
    </div>
    <!-- after navbar  -->

    <br />
    <!-- The recipie display div -->
    <?php
    $recipe_id = $_GET['recipe_id'];

    ?>
    <div class="row p-2" id="rd_image">
      <div class="col-md-9 py-2" id="recipe_d">
        <div class="d-flex justify-content-center align-items-center">
          <div class="spinner-border" role="status">
            <span class="sr-only align-items-center">Loading.....</span>
          </div>
        </div>
      </div>
      <script src="jquery-3.7.0.min.js"></script>
      <script>
        $(document).ready(function() {
          console.log("Working");
          $(".spinner-border").show();
          $.ajax({
            url: "result_display_api.php", // Ensure this path is correct
            type: "POST",
            data: {
              recipe_id: <?php echo $recipe_id; ?>
            },
            success: function(data) {
              console.log(data); // Log the returned data for debugging
              $("#recipe_d").html(data);
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error: " + status + ": " + error);
            },
            complete: function() {
              $(".spinner-border").hide();
            }
          });
        });
      </script>
      <div class="col-md-3 mt-3">
        <div class="row p-3 border shadow" style="border-radius: 0.8rem">
          <h4 class="text-center w-100">Recent Recipes</h4>
          <div
            class="col-md-8 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="images/food1.jpg"
              id="rs-image"
              width="70%"
              alt=""
              srcset="" />
          </div>
          <div
            class="col-md-4 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <span>Pav Bhaji</span>
            <h6>21st August 2024</h6>
          </div>
          <div
            class="col-md-8 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="images/food2.jpg"
              id="rs-image"
              width="70%"
              alt=""
              srcset="" />
          </div>
          <div
            class="col-md-4 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <span>Pav Bhaji</span>
            <h6>21st August 2024</h6>
          </div>
          <div
            class="col-md-8 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="images/food2.jpg"
              id="rs-image"
              width="70%"
              alt=""
              srcset="" />
          </div>
          <div
            class="col-md-4 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <span>Pav Bhaji</span>
            <h6>21st August 2024</h6>
          </div>
          <div
            class="col-md-8 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="images/food2.jpg"
              id="rs-image"
              width="70%"
              alt=""
              srcset="" />
          </div>
          <div
            class="col-md-4 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <span>Pav Bhaji</span>
            <h6>21st August 2024</h6>
          </div>
        </div>
      </div>
    </div>
    <!-- end of recipie display div  -->

    <!-- end of recent  -->
  </div>
  <br /><br />

  <div class="row" id="footer" style="background-color: black">
    <footer
      class="col-md-12 text-white px-4 text-center d-flex flex-column">
      <div class="row p-4">
        <div class="col-md-12 p-2">
          <img
            src="images/logo_sample.png"
            alt=""
            srcset=""
            style="border-radius: 1rem" />
        </div>
        <div class="col-md-12 p-2">
          **Savor Every Bite with Recipe & Taste** 🍽️✨

          At **Recipe & Taste**, we bring you a world of flavors, from timeless classics to modern culinary delights. Whether you're a home cook or a seasoned chef, our handpicked recipes, expert tips, and step-by-step guides will help you create magic in your kitchen.

          Join our food-loving community, explore new tastes, and make every meal an unforgettable experience. Stay inspired, stay hungry, and let’s cook up something amazing together!

          🔪 **Fresh Ingredients, Bold Flavors, Endless Possibilities!** 🍲💛
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-12">
          <p>&copy; 2024 Recipe Book. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
  </div>
  <!-- <script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script> -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
</body>

</html>