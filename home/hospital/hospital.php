<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


if(!isset($_SESSION['username']))
{
  header('location: ../../index.php');
}

$searchKey = "";

$date1 = date("Y-m-d");
$date = strtotime($date1);

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

    <div  class="container-fluid">
      <?php
      //To get latitude and longitude of the hospital.
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
       ?>
       <div class="row">
           <!-- Sidebar menu -->
           <?php require_once 'includes/sidebar.php'; ?>
           <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
               <h1 style="margin-top: 10px">Medicine Records</h1>
               <?php
                $result = $mysqli->query("SELECT * from pharmacy");
                if(isset($_POST['search']))
                {
                  $searchKey = $_POST['search'];
                  $result = $mysqli->query("SELECT * from pharmacy WHERE medicine_name LIKE '%$searchKey%'");
                }
               ?>
               <!-- Search form -->
               <form action="" method="POST">
    					    <div class="col-md-6">
    						  <input type="text" name="search" class='form-control' placeholder="Search By Medicine Name" value="<?php echo $searchKey; ?>" >
                  <button class="btn btn-info justify-content-center" style="margin-top:10px; margin-bottom:10px;">Search</button>
                  </div>
      				</form>
               <div class="row justify-content-center">
                 <table class = "table">
                   <thead>
                     <tr>
                       <th>Store Name</th>
                       <th>Medicine Name</th>
                       <th>No. Of Tablets</th>
                       <th>Expiry Date</th>
                       <th>Order</th>
                     </tr>
                   </thead>
                   <?php while ($row = $result->fetch_assoc()): ?>
                     <tr>
                       <?php if((strtotime($row['expiry_date'])-$date)>0): ?>
                       <td><?php echo $row['name']; ?></td>
                       <td><?php echo $row['medicine_name'].'-'.$row['company_name']; ?></td>
                       <td><?php echo $row['number_tablets']; ?></td>
                       <td><?php echo $row['expiry_date']; ?></td>
                       <td>
                          <a href="checkout.php?order=<?php echo $row['id']; ?>"
                           class = "btn btn-info" name="order">Order Now</a>
                       </td>
                       <?php endif; ?>
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
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?&libraries=places&key=AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI&callback=loadMap">
  </script>
</html>
