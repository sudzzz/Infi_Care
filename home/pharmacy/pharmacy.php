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
                    <?php
                      $user = $_SESSION['username'];
                      $result = $mysqli->query("SELECT * from pharmacy where username = '$user'");
                      //pre_r($result);
                      //pre_r($result->fetch_assoc());
                    ?>
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
