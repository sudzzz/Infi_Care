<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


if (isset($_GET['delete']))
{
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM pharmacy WHERE id='$id'") or die($mysqli->error);
  echo "<script> alert('Record has been deleted successfully!!'); window.location = 'pharmacy.php'</script>";
}

if(!isset($_SESSION['username']))
{
  header('location: ../../index.php');
}

$user = $_SESSION['username'];
$address = $_SESSION['address'];
$name = $_SESSION['name'];
$result = $mysqli->query("SELECT * from pharmacy where username = '$user'");

$date1 = date("Y-m-d");
$date = strtotime($date1);

/*while ($r = $result->fetch_assoc())
{
  $expiry_date = $r['expiry_date'];
  if((strtotime($expiry_date)-$date)<0)
  {
    $status = 0;
    $medicine_name = $r['medicine_name'];
    $number_tablets = $r['number_tablets'];
    $company_name = $r['company_name'];
    $res = $mysqli->query("SELECT * FROM expire WHERE store_name='$name'");
    $n=0;
    while($rows = $res->fetch_assoc())
    {
      if($rows['medicine_name']==$medicine_name and $rows['status']==0)
      {
        $n = $n+1;
        $number = $rows['number_tablets'];
        $number = $number + $number_tablets;
        $mysqli->query("UPDATE expire SET number_tablets='$number' WHERE medicine_name='$medicine_name'") or die($mysqli->error);
      }
      if($n==0)
      {
        $mysqli->query("INSERT INTO expire(medicine_name,company_name,number_tablets,store_name,store_address,status) VALUES('$medicine_name','$company_name','$number_tablets','$name','$address','$status')") or die($mysqli->error);
      }

      // $mysqli->query("DELETE FROM pharmacy WHERE medicine_name='$medicine_name',company_name='$company_name',expiry_date='$expiry_date'") or die($mysqli->error);

    }
  }
}*/

/*if((strtotime($expiry_date)-$date)<0)
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


*/
?>


 <!DOCTYPE html>

<html lang="en">
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
                    <h1 style="margin-top: 10px">Medicine Records (Unexpired)</h1>
                    <div class="row justify-content-center">
                      <table class = "table">
                        <thead>
                          <tr>
                            <th>Medicine Name</th>
                            <th>No. Of Tablets</th>
                            <th>Company Name</th>
                            <th>Expiry Date</th>
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <?php while ($row = $result->fetch_assoc()): ?>
                          <tr>
                            <?php if((strtotime($row['expiry_date'])-$date)>0): ?>
                            <td><?php echo $row['medicine_name']; ?></td>
                            <td><?php echo $row['number_tablets']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['expiry_date']; ?></td>
                            <td>
                              <a href="form.php?edit=<?php echo $row['id']; ?>"
                                class = "btn btn-info" name="edit"><i class="fa fa-edit" style="font-size:24px"></i></a>
                                <a href="pharmacy.php?delete=<?php echo $row['id']; ?>"
                                  class = "btn btn-danger" name="delete"><i class="fa fa-trash-o" style="font-size:24px"></i></a>
                            </td>
                            <?php endif; ?>

                          </tr>
                        <?php endwhile; ?>
                      </table>
                    </div>
                    <?php
                      function pre_r($array)
                      {
                        echo '<pre>';
                        print_r($array);
                        '</pre>';
                      }
                    ?>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>


    </body>
</html>
