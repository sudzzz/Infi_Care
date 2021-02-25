<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


$searchKey = "";

$val = $_SESSION['doctype'];

$lat = $_SESSION['lat'];
$lng = $_SESSION['lng'];

$API_KEY = 'AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI';



	$request = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?";
	$params  = array(
    "location" => $lat.",".$lng,
    "radius" => 5000,
    "type" => "doctor",
    "keyword" => $val,
		"key"   => $API_KEY,
	);

	$request .= http_build_query($params);

	$json = file_get_contents($request);
	$data = json_decode($json, true);
  $array = $data['results'];
  foreach ($array as $arr) {
    // code...

    $name = $arr['name'];
    $latitude =  $arr['geometry']['location']['lat'];
    $longitude = $arr['geometry']['location']['lng'];
    $address = $arr['vicinity'];
    $place_id = $arr['place_id'];

    $res =  $mysqli->query("SELECT * FROM doctor WHERE name='$name' AND place_id='$place_id'");
    $r = $res->fetch_assoc();
    if(empty($r)){
      $mysqli->query("INSERT INTO doctor(name,address,lat,lng,place_id) VALUES('$name','$address','$latitude','$longitude','$place_id')") or die($mysqli->error);
    }
    else {
      break;
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Doctors</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Inter:400,800,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- CSS Stylesheets -->
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<!--Google Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:700i,800,900|Ubuntu&display=swap" rel="stylesheet">

  </head>
  <body>
		<nav class="navbar bg-dark navbar-expand-lg fixed-top navbar-dark">
		  <a class="navbar-brand" ><?php echo $_SESSION['name'];?></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item">
		        <a href="../../logout.php" class="btn btn-info" role="button">Logout</a>
		      </li>
		    </ul>
		  </div>
		</nav>
    <div class="container-fluid">
        <div class="row">
					<nav class="col-md-2 d-none d-md-block bg-light sidebar">
							<div class="sidebar-sticky">
									<ul class="nav flex-column">
											<li class="nav-item">
													<a class="nav-link" href="doctor_inquiry.php">
															<span data-feather="arrow-left"></span>
															Back
													</a>
											</li>
									</ul>
							</div>
					</nav>
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <h1 style="margin-top: 10px">Doctor's List</h1>
              <?php
                $result = $mysqli->query("SELECT * from doctor");
								if(isset($_POST['search']))
                {
                  $searchKey = $_POST['search'];
                  $result = $mysqli->query("SELECT * from doctor WHERE name LIKE '%$searchKey%'");
                }
              ?>
							<!-- Search form -->
							<form action="" method="POST">
								 <div class="col-md-6">
								 <input type="text" name="search" class='form-control' placeholder="Search By Doctor Name" value="<?php echo $searchKey; ?>" >
								 <button class="btn btn-info justify-content-center" style="margin-top:10px; margin-bottom:10px;">Search</button>
								 </div>
						 </form>
              <div class="row justify-content-center">
                <table class = "table">
                  <thead>
                    <tr>
                      <th>Doctor's Name</th>
                      <th>Doctor's Address</th>
                      <th>Schedule</th>
                    </tr>
                  </thead>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td>
                        <a href="schedule.php?accept=<?php echo $row['id']; ?>" class = "btn btn-info" role="button">Schedule</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </table>
              </div>
          </main>
        </div>
    </div>
  </body>
</html>
