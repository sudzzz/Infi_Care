<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));
$place_id = "";
$name="";
if(isset($_GET['accept']))
{
  $id = $_GET['accept'];
  $result=$mysqli->query("SELECT name,place_id FROM doctor WHERE id='$id'");
  $row = $result->fetch_assoc();
  $place_id = $row['place_id'];
  $name = $row['name']."'s";
}

//echo $val;
$API_KEY = 'AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI';
$request = "https://maps.googleapis.com/maps/api/place/details/json?";

$params  = array(
  "place_id" => $place_id,
  "fields" => "opening_hours/weekday_text,formatted_phone_number",
  "key"   => $API_KEY,
);

$request .= http_build_query($params);
$json = file_get_contents($request);
$data = json_decode($json, true);
$array = $data['result'];
$arr = $array['opening_hours']['weekday_text'];

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
      <meta charset="utf-8">
      <title>Doctor's Schedule</title>
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link href="https://fonts.googleapis.com/css?family=Inter:400,800,900&display=swap" rel="stylesheet">
  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  		<!-- CSS Stylesheets -->
  		<link rel="stylesheet" href="styles.css">
  		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  		<!--Google Fonts-->
  		<link href="https://fonts.googleapis.com/css?family=Montserrat:700i,800,900|Ubuntu&display=swap" rel="stylesheet">

    </head>
  </head>
  <body>
    <nav class="navbar bg-dark navbar-expand-lg fixed-top navbar-dark">
		  <a class="navbar-brand" ><?php echo $name." Schedule";?></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		  </button>
		</nav>
    <div class="container-fluid">
        <div class="row">
					<nav class="col-md-2 d-none d-md-block bg-light sidebar">
							<div class="sidebar-sticky">
									<ul class="nav flex-column">
											<li class="nav-item">
													<a class="nav-link" href="doctor.php">
															<span data-feather="arrow-left"></span>
															Back
													</a>
											</li>
									</ul>
							</div>
					</nav>
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if((isset($array['formatted_phone_number']))): ?>
              <h3 style="margin-top: 10px">Doctor's Phone Number : <?php echo $array['formatted_phone_number']; ?></h3>
            <?php else: ?>
              <h3 style="margin-top: 10px">Doctor's Phone Number : <?php echo "Currently Not Available" ?></h3>
            <?php endif; ?>
            <?php if(isset($array['opening_hours']['weekday_text'])): ?>
              <div class="row justify-content-center">
                  <table class = "table">
                    <thead>
                      <tr>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                      </tr>
                    </thead>
                    <tr>
                      <td><?php echo explode(': ',$arr[0],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[1],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[2],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[3],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[4],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[5],2)[1]; ?></td>
                      <td><?php echo explode(': ',$arr[6],2)[1]; ?></td>
                    </tr>
                  </table>
              </div>
            <?php else: ?>
              <h3 style="margin-top: 10px">Doctor's Schedule : <?php echo "Currently Not Available" ?></h3>
            <?php endif; ?>
          </main>
        </div>
    </div>
  </body>

</html>
