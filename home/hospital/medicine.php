<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


$address=$_SESSION['address'];
$hospital = $_SESSION['name'];
$status = 0;
if(isset($_GET['request']))
{
  $id = $_GET['request'];
  $result=$mysqli->query("SELECT name FROM nearby WHERE id='$id'");
  $row = $result->fetch_assoc();
  $_SESSION['sender'] = $row['name'];
}

//When Submit button is clicked
if(isset($_POST["submit"]))
{
  $name           = $_SESSION['sender'];
  $medicine_name  = $_POST['medicine_name'];
  $number_tablets = $_POST['number_tablets'];
  $company_name   = $_POST['company_name'];
  $priority       = $_POST['priority'];
  $date           = $_POST['dod'];

  $mysqli->query("INSERT INTO medicine(receiver,address,sender,medicine,company,dozes,priority,dod,status) VALUES('$hospital','$address','$name','$medicine_name','$company_name','$number_tablets','$priority','$date','$status')") or die($mysqli->error);
  echo "<script> alert('Request placed successfully!!'); window.location = 'hospital.php'</script>";
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
                              <a class="nav-link" href="hospital.php">
                                  <span data-feather="arrow-left"></span>
                                  Back
                              </a>
                          </li>
                      </ul>
                  </div>
              </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Request For Medicine</h1>
                  <p>Required fields are in (*)</p>
                  <div class="container">
                    <form action="medicine.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <div class="form-group">
                          <label>Medicine Name *</label>
                          <input  class="form-control" type="text" name="medicine_name" placeholder="Name of the medicine" value="" required>
                      </div>
                      <div class="form-group">
                          <label>No. of Dozes *</label>
                          <input  class="form-control" type="text" name="number_tablets" placeholder="Number of Tablets/Vials" value="" required>
                      </div>
                      <div class="form-group">
                          <label>Company Name *</label>
                          <input  class="form-control" type="text" name="company_name"  placeholder="Company's name of that medicine" value="" required>
                      </div>
                      <div class="form-group">
                          <label>Priority *</label>
                            <select class="form-control" id="selectType" name="priority">
                              <option value="">Select Priority</option>
                              <option value="high">High</option>
                              <option value="medium">Medium</option>
                              <option value="low">Low</option>
                            </select>
                      </div>
                      <div class="form-group">
                          <label>Expected Date Of Delivery *</label>
                          <input  class="form-control" type="date" name="dod" required>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary mb-2" type="submit" name="submit">Request</button>
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
