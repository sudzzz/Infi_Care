<?php
SESSION_START();

$medicine_name = '';
$number_tablets = '';
$company_name = '';
$expiry_date = 'dd-mm-yyyy';
$update = false;
$id = 0;


$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


//When Submit button is clicked
if(isset($_POST["submit"]))
{
  $username       = $_SESSION['username'];
  $name           = $_SESSION['name'];
  $address        = $_SESSION['address'];
  $medicine_name  = $_POST['medicine_name'];
  $number_tablets = $_POST['number_tablets'];
  $company_name   = $_POST['company_name'];
  $expiry_date    = $_POST['expiry_date'];

  $result = $mysqli->query("SELECT lat,lng FROM stores WHERE name='$name'");
  $row = $result->fetch_assoc();
  $lat = $row['lat'];
  $lng = $row['lng'];


  $date1 = date("Y-m-d");
  $date = strtotime($date1);


  if((strtotime($expiry_date)-$date)<0)
  {
    $status = 0;
    $res = $mysqli->query("SELECT * FROM expire WHERE store_name='$name'");
    $n=0;
    while($r = $res->fetch_assoc())
    {
      if($r['medicine_name']==$medicine_name and $r['status']==0)
      {
        $n = $n+1;
        $number = $r['number_tablets'];
        $number = $number + $number_tablets;
        $mysqli->query("UPDATE expire SET number_tablets='$number' WHERE medicine_name='$medicine_name'") or die($mysqli->error);
      }
      echo "<script> alert('Data is updated and stored in expired section successfully!!'); window.location = 'pharmacy.php'</script>";
    }
    if($n==0)
    {
      $mysqli->query("INSERT INTO expire(medicine_name,company_name,number_tablets,store_name,store_address,status) VALUES('$medicine_name','$company_name','$number_tablets','$name','$address','$status')") or die($mysqli->error);
      echo "<script> alert('Data is updated and stored in expired section successfully!!'); window.location = 'pharmacy.php'</script>";
    }

  }
  else
  {
    $mysqli->query("INSERT INTO pharmacy(username,name,medicine_name,number_tablets,company_name,expiry_date,lat,lng) VALUES('$username','$name','$medicine_name','$number_tablets','$company_name','$expiry_date','$lat','$lng')") or die($mysqli->error);
    echo "<script> alert('Data has been updated successfully!!'); window.location = 'pharmacy.php'</script>";
  }

}

if(isset($_GET['edit']))
{
  $id = $_GET['edit'];
  $update = true;
  $query = "SELECT * FROM pharmacy WHERE id='$id'";
  $result = mysqli_query($mysqli,$query);
  $num = mysqli_num_rows($result);

  if($num==1)
  {
    $row = mysqli_fetch_assoc($result);
    $medicine_name = $row['medicine_name'];
    $number_tablets = $row['number_tablets'];
    $company_name = $row['company_name'];
    $expiry_date = $row['expiry_date'];
  }

}


if(isset($_POST['update']))
{
  $id = $_POST['id'];
  $medicine_name = $_POST['medicine_name'];
  $company_name = $_POST['company_name'];
  $number_tablets = $_POST['number_tablets'];
  $expiry_date = $_POST['expiry_date'];

  $mysqli->query("UPDATE pharmacy SET medicine_name='$medicine_name',company_name='$company_name',number_tablets='$number_tablets',expiry_date='$expiry_date' WHERE id='$id'") or die($mysqli->error);
  echo "<script> alert('Data has been updated successfully!!'); window.location = 'pharmacy.php'</script>";
}


?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
              <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                  <div class="sidebar-sticky">
                      <ul class="nav flex-column">
                          <li class="nav-item">
                              <a class="nav-link" href="pharmacy.php">
                                  <span data-feather="arrow-left"></span>
                                  Back
                              </a>
                          </li>
                      </ul>
                  </div>
              </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Add / Edit the Records</h1>
                  <p>Required fields are in (*)</p>
                  <div class="container">
                    <form action="form.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <div class="form-group">
                          <label>Medicine Name *</label>
                          <input  class="form-control" type="text" name="medicine_name" value="<?php echo $medicine_name; ?>" placeholder="Name of the medicine" value="" required>
                      </div>
                      <div class="form-group">
                          <label>No. of Tablets *</label>
                          <input  class="form-control" type="text" name="number_tablets" value="<?php echo $number_tablets; ?>" placeholder="Number of Tablets" value="" required>
                      </div>
                      <div class="form-group">
                          <label>Company Name *</label>
                          <input  class="form-control" type="text" name="company_name" value="<?php echo $company_name; ?>" placeholder="Company's name of that medicine" value="" required>
                      </div>
                      <div class="form-group">
                          <label>Expiry Date *</label>
                          <input  class="form-control" type="date" name="expiry_date" value="<?php echo $expiry_date; ?>" required>
                      </div>
                      <div class="form-group">
                        <?php if($update == true): ?>
                          <button class="btn btn-info mb-2" type="submit" name="update">Update</button>
                        <?php else: ?>
                          <button class="btn btn-primary mb-2" type="submit" name="submit">Save</button>
                        <?php endif; ?>
                      </div>
                    </form>
                  </div>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>
