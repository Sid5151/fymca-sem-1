<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spoonacular.com/recipes/complexSearch?apiKey=fdabb44a326a44ec905c14168fb25040&sort=healthiness");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$respose = curl_exec($ch);
$data = json_decode($respose, true);
if (curl_error($ch)) {
  echo curl_error($ch);
} else {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
  echo $data['results'][0]['title'];
}
