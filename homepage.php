<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home Page</title>
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
      font-family: Poopins;
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

    #recent_img {
      border-radius: 0.5rem;
    }

    /* for centering nav  */
    /* #navbarNav {
        display: flex;
        justify-content: center;
      } */
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row my-3 mx-3 border shadow-sm">
      <div
        class="col-md-2 px-4 d-flex align-items-center justify-content-center">
        <img src="images/logo_sample.png" width="150em" alt="" srcset="" />
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
    <?php
    include "dbconnect1.php";
    //queries written for carousel display
    //1. Paneer
    $squery = "Select * from rinfo where recipe_id = 654534";
    $result = mysqli_query($conn, $squery);
    $row = mysqli_fetch_assoc($result);

    //2. Butter Chicken
    $squery2 = "Select * from rinfo where recipe_id = 647799";
    $result2 = mysqli_query($conn, $squery2);
    $row2 = mysqli_fetch_assoc($result2);

    //3. Vegetable Biryani
    $squery3 = "Select * from rinfo where recipe_id = 660913";
    $result3 = mysqli_query($conn, $squery3);
    $row3 = mysqli_fetch_assoc($result3);
    ?>
    <div class="row">
      <div class="col-md-12">
        <div
          id="carouselExampleCaptions"
          class="carousel slide"
          data-ride="carousel">
          <ol class="carousel-indicators">
            <li
              data-target="#carouselExampleCaptions"
              data-slide-to="0"
              class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="images/pm1.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="recipie_display.php?recipe_id='654534'"><?php echo $row['title'];  ?></a></h5>
                <p>
                  Butter Paneer Masala, a quintessential North Indian dish, is a rich and creamy delicacy that tantalizes the taste buds with its robust flavors.
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images/butterchicken.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="recipie_display.php?recipe_id='647799'"><?php echo $row2['title'];  ?></a></h5>
                <p>
                  "Creamy, dreamy, and packed with spice—Butter Chicken is pure indulgence on a plate!" 🍛🔥
                </p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images/vegbiryani2.jpg" class="d-block w-100" alt="..." />
              <div class="carousel-caption d-none d-md-block">
                <h5><a href="recipie_display.php?recipe_id='660913'"><?php echo $row3['title'];  ?></a></h5>
                <p>
                  "Layered with love, packed with flavor—one spoonful of Vegetable Biryani is pure bliss!" 😍🔥
                </p>
              </div>
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-target="#carouselExampleCaptions"
            data-slide="prev">
            <span
              class="carousel-control-prev-icon"
              aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-target="#carouselExampleCaptions"
            data-slide="next">
            <span
              class="carousel-control-next-icon"
              aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </button>
        </div>
      </div>
    </div>
    <br />
    <!-- adv search  -->
    <div class="row p-3">
      <div class="col-md-12">
        <form action="result.php" class="d-flex justify-content-between align-items-center">
          <input
            type="text"
            name="req"
            id=""
            placeholder="Search for Ingredients"
            class="form-control mx-2" />

          <select name="maxCookingTime" id="" class="form-control mx-2">
            <option value="" disabled selected>Cooking Time</option>
            <option value="10">10 mins</option>
            <option value="30">30 mins</option>
            <option value="60">1 hour</option>

          </select>
          <button type="submit">
            <img
              id="search"
              src="/FYMCA SEM-I mini project/images/search.png"
              alt=""
              srcset="" />
          </button>
        </form>
      </div>
    </div>

    <br />
    <div class="row p-2">
      <div class="col-md-9 p-3 border shadow" style="border-radius: 0.8rem">

        <div class="row" id="popular">
          <div class="d-flex justify-content-center align-items-center">
            <div class="spinner-border" role="status">
              <span class="sr-only align-items-center">Loading.....</span>
            </div>
          </div>
        </div>
        <script src=" jquery-3.7.0.min.js"></script>
        <script>
          $(document).ready(function() {
            $('.spinner-border').show();
            console.log("Working");
            $.ajax({
              url: "homepage_api.php", // Ensure this path is correct
              type: "POST",
              success: function(data) {
                console.log(data); // Log the returned data for debugging
                $("#popular").html(data);
              },
              error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
              },
              complete: function() {
                $('.spinner-border').hide();
              }
            });
          });
        </script>
        <!-- <script>
          const maxLength = 50; // Set the maximum number of characters
          const textElement = document.getElementById("text");
          const textContent = textElement.innerText;

          if (textContent.length > maxLength) {
            textElement.innerText = textContent.slice(0, maxLength) + "..."; // Truncate and add ellipsis
          }
        </script> -->
        <!-- <div class="col-md-4"><img src="images/food2.jpg" alt="" /></div>
            <div class="col-md-4"><img src="images/food3.jpg" alt="" /></div> -->

      </div>
      <!-- code for curl -->
      <?php
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://api.spoonacular.com/recipes/complexSearch?apiKey=fdabb44a326a44ec905c14168fb25040&sort=healthiness");

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $respose = curl_exec($ch);
      $data = json_decode($respose, true);
      if (curl_error($ch)) {
        echo curl_error($ch);
      }
      ?>
      <div class="col-md-3 mt-3">
        <div class="row p-3 border shadow" style="border-radius: 0.8rem">
          <h4 class="text-center w-100">Top Healthy Recipes</h4>

          <div
            class="col-md-12 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="<?php echo $data['results'][0]['image'] ?>"
              id="rs-image"
              alt=""
              srcset=""
              style="max-width: 100%; margin-bottom:0.3rem" />
            <span><a href="recipie_display.php?recipe_id=<?php echo $data['results'][0]['id'] ?>"><i><?php echo "<br>" . $data['results'][0]['title'] ?></i></a></span>
          </div>

          <div
            class="col-md-12 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="<?php echo $data['results'][1]['image'] ?>"
              id="rs-image"
              alt=""
              srcset=""
              style="max-width: 100%; margin-bottom:0.3rem"" />
            <span><a href=" recipie_display.php?recipe_id=<?php echo $data['results'][1]['id'] ?>"><i><?php echo "<br>" . $data['results'][1]['title'] ?></i></a></span>
          </div>

          <div
            class="col-md-12 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="<?php echo $data['results'][2]['image'] ?>"
              id="rs-image"
              alt=""
              srcset=""
              style="max-width: 100%; margin-bottom:0.3rem"" />

            <span><a href=" recipie_display.php?recipe_id=<?php echo $data['results'][2]['id'] ?>"><i><?php echo "<br>" . $data['results'][2]['title'] ?></i></a></span>
          </div>

          <div
            class="col-md-12 p-2 d-flex flex-column align-items-center justify-content-center center-md d-md-block">
            <img
              src="<?php echo $data['results'][3]['image'] ?>"
              id="rs-image"
              alt=""
              srcset=""
              style="max-width: 100%; margin-bottom:0.3rem"" />

            <span><a href=" recipie_display.php?recipe_id=<?php echo $data['results'][3]['id'] ?>"><i><?php echo "<br>" . $data['results'][3]['title'] ?></i></a></span>
          </div>

        </div>
      </div>
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