
<nav class="navbar bg-dark navbar-expand-lg fixed-top navbar-dark">
  <a class="navbar-brand" ><?php echo "Welcome ".$_SESSION['name'];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="../../logout.php" class="btn btn-info" role="button">Logout</a>
        <a href="doctor_inquiry.php" class="btn btn-info" role="button">Doctor Inquiry</a>
      </li>
    </ul>
  </div>
</nav>
