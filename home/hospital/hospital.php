<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));

$address = $_SESSION['address'];
$url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$responseJson = curl_exec($ch);
curl_close($ch);

$response = json_decode($responseJson);

if ($response->status == 'OK') {
  $latitude = $response->results[0]->geometry->location->lat;
  $longitude = $response->results[0]->geometry->location->lng;

  $mysqli->query("UPDATE hospital SET lat='$latitude',lng='$longitude' WHERE username='{$_SESSION['username']}'") or die($mysqli->error);
} else {
  echo $response->status;
  var_dump($response);
}

$searchKey = "";
$user = $_SESSION['username'];
$hospital = $_SESSION['name'];
$words = str_word_count($hospital,1);
$hos = strtolower($words[0]);
$result = $mysqli->query("SELECT lat,lng FROM hospital WHERE username='$user'");
$row = $result->fetch_assoc();
$lat = $row['lat'];
$lng = $row['lng'];

$API_KEY = 'AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI';

$request = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?";

$params  = array(
  "location" => $lat.",".$lng,
  "radius" => 8000,
  "type" => "hospital",
  "key"   => $API_KEY,
);

$request .= http_build_query($params);

$json = file_get_contents($request);
$data = json_decode($json, true);
$array = $data['results'];
foreach ($array as $arr) {
  // code...
  $name = $arr['name'];
  $name = strtolower($name);
  $latitude =  $arr['geometry']['location']['lat'];
  $longitude = $arr['geometry']['location']['lng'];
  $address = $arr['vicinity'];
  if(strpos($name, $hos) !== false)
  {
      continue;
  }
  else {
    $name = ucwords($name);
    $res =  $mysqli->query("SELECT * FROM nearby WHERE name='$name'");
    $r = $res->fetch_assoc();
    if(empty($r)){
      $mysqli->query("INSERT INTO nearby(name,address,lat,lng) VALUES('$name','$address','$latitude','$longitude')") or die($mysqli->error);
    }
    else {
      break;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Head metas, css, and title -->
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body>
    <!-- Header banner -->
    <?php require_once 'includes/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar menu -->
            <?php require_once 'includes/sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <h1 style="margin-top: 10px">Nearby Hospitals</h1>
              <?php
               $result = $mysqli->query("SELECT * from nearby");
               if(isset($_POST['search']))
               {
                 $searchKey = $_POST['search'];
                 $result = $mysqli->query("SELECT * from nearby WHERE name LIKE '%$searchKey%'");
               }
              ?>
              <!-- Search form -->
              <form action="" method="POST">
                 <div class="col-md-6">
                 <input type="text" name="search" class='form-control' placeholder="Search By Hospital Name" value="<?php echo $searchKey; ?>" >
                 <button class="btn btn-info justify-content-center" style="margin-top:10px; margin-bottom:10px;">Search</button>
                 </div>
             </form>
             <div class="row justify-content-center">
               <table class = "table">
                 <thead>
                   <tr>
                     <th>Hospital Name</th>
                     <th>Address</th>
                     <th>Request Blood</th>
                     <th>Request Medicine</th>
                   </tr>
                 </thead>
                 <?php while ($row = $result->fetch_assoc()): ?>
                   <tr>
                     <td><?php echo $row['name']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td>
                        <a href="blood.php?request=<?php echo $row['id']; ?>"
                         class = "btn btn-info" name="blood">Request Blood</a>
                     </td>
                     <td>
                        <a href="medicine.php?request=<?php echo $row['id']; ?>"
                         class = "btn btn-info" name="medicine">Request Meds</a>
                     </td>
                   </tr>
                 <?php endwhile; ?>
               </table>
             </div>
            </main>
        </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>
  </body>
</html>
