<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));
$number_tablets = 0;
$id = 0;
if(isset($_GET['order']))
{
  $GLOBALS['id']  = $_GET['order'];
  $query = "SELECT * FROM pharmacy WHERE id='{$GLOBALS['id']}'";
  $result = mysqli_query($mysqli,$query);
  $num = mysqli_num_rows($result);

  if($num==1)
  {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $medicine_name = $row['medicine_name'];
    $GLOBALS['number_tablets'] = $row['number_tablets'];
    $company_name = $row['company_name'];

  }

}


if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $result = $mysqli->query("SELECT * FROM pharmacy WHERE id='$id'");
    $r = $result->fetch_assoc();
    $number_tablets = $r['number_tablets'];
    $number = $_POST['number_tablets'];
  if($number<=$number_tablets)
  {
    $hospital = $_SESSION['name'];
    $store = $_POST['store'];
    $medicine_name = $_POST['medicine_name'];
    $dod = $_POST['dod'];
    $hospital_address = $_POST['address'];
    $status = 0;

    $mysqli->query("INSERT INTO orders(ngo,ngo_address,store,medicine_name,number_tablets,dod,status) VALUES('$hospital','$hospital_address','$store','$medicine_name','$number','$dod',$status)") or die($mysqli->error);
    echo "<script> alert('Your Order has been placed successfully!!'); window.location = 'ngo.php'</script>";

    $number_tablets = $number_tablets - $number;
    $mysqli->query("UPDATE pharmacy SET number_tablets='$number_tablets' WHERE id='$id'") or die($mysqli->error);
    if($number_tablets==0)
    {
        $mysqli->query("DELETE FROM pharmacy WHERE id='$id'") or die($mysqli->error);
    }

  }
  else {
    echo "<script> alert('No. of tabletets selected is more than availabe stock. Select another store!!'); window.location = 'hospital.php'</script>";
  }
}




 ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Head metas, css, and title -->
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body class="bg-light">
    <!-- Header banner -->
    <?php //require_once 'includes/header.php'; ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Your Order</h4>
          <form action="checkout.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="MedicineName">Medicine Name</label>
                <input type="text" class="form-control" id="MedicineName" name="medicine_name" placeholder="" value="<?php echo $medicine_name.'-'.$company_name; ?>" required>
                <input type="hidden" name="id" value="<?php echo $GLOBALS['id']; ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label for="number_tablets">Number Of Tablets</label>
                <input type="text" class="form-control" id="number_tablets" name="number_tablets" placeholder="<?php echo "Available ".$GLOBALS['number_tablets']; ?>"  required>
                <div class="invalid-feedback">
                  No. Of Tablets is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="storename">Name Of Store</label>
              <input type="text" class="form-control" id="storename" name="store" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Store Name is required.
                </div>
            </div>

            <div class="mb-3">
              <label for="hospital">Hospital Name</label>
              <input type="text" class="form-control" id="hospital" placeholder="Name Of Your Hospital" value="<?php echo $_SESSION['name']; ?>" required>
              <div class="invalid-feedback">
                Please enter Your Hospital Name.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address Of Delivery</label>
              <input type="text" class="form-control" id="address" placeholder="Your address" name="address" value="<?php echo $_SESSION['address']; ?>" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="date">Required till Date: </label>
              <input type="date" class="form-control" id="date" name="dod" required>
            </div>

            <hr class="mb-4">
              <button class="btn btn-primary mb-2" type="submit" name="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>
  </body>
</html>
