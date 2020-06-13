<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


if(!isset($_SESSION['username']))
{
  header('location: ../../index.php');
}

if(isset($_GET['accept']))
{
  $id = $_GET['accept'];
  $status = 1;
  $mysqli->query("UPDATE expire SET status='$status' WHERE id='$id'");
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
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 style="margin-top: 10px">Collections</h1>
            <?php
            $name = $_SESSION['name'];
            $result = $mysqli->query("SELECT * from expire WHERE company_name='$name'");
            ?>
            <div class="row justify-content-center">
              <table class = "table">
                <thead>
                  <tr>
                    <th>Medicine Name</th>
                    <th>Number Of Tablets</th>
                    <th>Store Name</th>
                    <th>Store Address</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['medicine_name']; ?></td>
                    <td><?php echo $row['number_tablets']; ?></td>
                    <td><?php echo $row['store_name']; ?></td>
                    <td><?php echo $row['store_address']; ?></td>
                    <td>
                      <?php if($row['status'] == 0): ?>
                        <a href="company.php?accept=<?php echo $row['id']; ?>"
                          class = "btn btn-success" name="accept">Collect</a>
                      <?php else: ?>
                        <p style="color:green;">Collected</p>
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
