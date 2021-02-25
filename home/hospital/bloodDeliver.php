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
  $mysqli->query("UPDATE blood SET status='$status' WHERE id='$id'");
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
                         <a class="nav-link" href="hospital.php">
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
               $hospital = $_SESSION['name'];
               $result = $mysqli->query("SELECT * from blood WHERE sender='$hospital'");
             ?>
             <div class="row justify-content-center">
               <table class = "table">
                 <thead>
                   <tr>
                     <th>Hospital Name</th>
                     <th>Hospital Address</th>
                     <th>Blood Type</th>
                     <th>No.Of units</th>
                     <th>Priority</th>
                     <th>Date Of Delivery</th>
                     <th colspan="2">Action</th>
                   </tr>
                 </thead>
                 <?php while ($row = $result->fetch_assoc()): ?>
                   <tr>
                     <td><?php echo $row['receiver']; ?></td>
                     <td><?php echo $row['address']; ?></td>
                     <td><?php echo $row['blood']; ?></td>
                     <td><?php echo $row['units']; ?></td>
                     <td><?php echo $row['priority']; ?></td>
                     <td><?php echo $row['dod']; ?></td>
                     <td>
                       <?php if($row['status'] == 0): ?>
                         <a href="bloodDeliver.php?accept=<?php echo $row['id']; ?>"
                           class = "btn btn-success" name="accept">Deliver</a>
                       <?php else: ?>
                         <p style="color:green;">Delivered</p>
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
