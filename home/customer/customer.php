<?php
SESSION_START();

if(!isset($_SESSION['username']))
{
  header('location: ../../index.php');
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Head metas, css, and title -->
    <?php require_once 'includes/head.php'; ?>
    <style type="text/css">
      #data, #allData, #loc, #all, #hos{
        display: none;
      }
    </style>
  </head>
  <body>
    <!-- Header banner -->
    <?php require_once 'includes/header.php'; ?>
    <div role = "main" class="container">
      <center><h1>Locate Pharmacies Near You</h1></center>
      <?php
        require 'stores.php';
        $st = new stores;                           // Creating an object st of stores class in stores.php

        $location = $st->getCoustomerBlankLatLng(); //Storing the value retured in $location from st->getCoustomerBlankLatLng()
        $location = json_encode($location,true);    //Converting the value in JSON format
        echo '<div id="loc">'.$location.'</div>';   //Go to googlemap.js and parse data with id="loc"

        $get = $st->getCoustomer();
        $get = json_encode($get,true);
        echo '<div id="all">'.$get.'</div>';

        

        $store = $st->getStoresBlankLatLng();       //Storing the value retured in $store from st->getStoresBlankLatLng()
        $store = json_encode($store,true);          //Converting the value in JSON format
        echo '<div id="data">'.$store.'</div>';     //Go to googlemap.js and parse data with id="data"

        $allData = $st->getAllStores();             //Storing the value retured in $allData from st->getAllStores()
        $allData = json_encode($allData,true);      //Converting the value in JSON format
        echo '<div id="allData">'.$allData.'</div>';//Go to googlemap.js and parse data with id="allData"

       ?>
      <div id="map">

      </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>
  </body>
  <!--Google Maps Api-->
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?&libraries=places&key=AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI&callback=loadMap">
  </script>

</html>
