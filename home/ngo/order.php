<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


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
  </head>
  <body>
    <!-- Header banner -->
    <?php require_once 'includes/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="ngo.php">
                            <span data-feather="arrow-left"></span>
                            Back
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 style="margin-top: 10px">Your Orders</h1>
            <?php
              $ngo = $_SESSION['name'];
              $result = $mysqli->query("SELECT * from orders WHERE ngo='$ngo'");
            ?>
            <div class="row justify-content-center">
              <table class = "table">
                <thead>
                  <tr>
                    <th>Store Name</th>
                    <th>Medicine Name</th>
                    <th>No. Of Tablets</th>
                    <th>Expected Date Of Delivery</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['store']; ?></td>
                    <td><?php echo $row['medicine_name']; ?></td>
                    <td><?php echo $row['number_tablets']; ?></td>
                    <td><?php echo $row['dod']; ?></td>
                    <td>
                      <?php if($row['status'] == 1): ?>
                        <p style="color:green;">Delivered</p>
                      <?php else: ?>
                        <p style="color:orange;">On The Way</p>
                      <?php endif; ?>
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
