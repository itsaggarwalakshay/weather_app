<?php
if (array_key_exists('submit', $_GET)) {
  if (!$_GET['city']) {
    $error = "Sorry, Your Input is empty";
  }
  if ($_GET['city']) {
    $city = $_GET['city'];
    $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=84df1b08135eb2e82285d4e47ebb8a77");
    $weatherarray = json_decode($apiData,true);

    $tempcelsius = $weatherarray['main']['temp'] - 273;

    $weather = "<b>".$weatherarray['name'].",".$weatherarray['sys']['country']."<br>".$tempcelsius."&deg;C</b> <br>";
    $weather .= "<b> weather Condition : </b>".$weatherarray['weather']['0']['description']."<br>";
    $weather .= "<b> Atmosperic pressure : </b>".$weatherarray['main']['pressure']."hpa <br>";
    $weather .= "<b> Wind Speed : </b>".$weatherarray['wind']['speed']."meter/sec <br>";
    $weather .= "<b> Cloudness : </b>".$weatherarray['clouds']['all']."%<br>";
    date_default_timezone_set('Asia/Calcutta');
    $sunrise = $weatherarray['sys']['sunrise'];
    $weather .= "<b> sunrise : </b>" .date("g:i a",$sunrise);

    // echo "<pre>";
    // print_r($weatherarray);
    // echo "<pre>";
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>weather app</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<style>
body{
  /*background: black;*/
}
.card1{
  background: rgba( 255, 255, 255, 0.25 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 4px );
  -webkit-backdrop-filter: blur( 4px );
  border-radius: 10px;
  border: 1px solid rgba( 255, 255, 255, 0.18 );
  /*color: white;*/
  height:500px; 
  margin-top: 10rem;
  padding: 45px 30px;
}
</style>
<body>
<div class="container d-flex justify-content-center" style="height: 100vh;">
    <div class="col-md-5 card1">
      <h3 class="text-center">Search Any City Weather</h3>
      <form action="" method="get">
        <div class="form-group">
          <b><label for="city">Enter City</label></b>
          <input type="text" class="form-control" id="city" name="city">
        </div>
        <input type="submit" name="submit" class="btn btn-success mt-2">
      </form>
      <div class="output">
        <?php 
        if ($weather) {
          echo '<div class="alert alert-success mt-4" role="alert">
         '.$weather.'</div>';
        }else{
          echo '<div class="alert alert-danger" role="alert">
         '.$error.'</div>';
        }
        ?>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
</body>
</html>