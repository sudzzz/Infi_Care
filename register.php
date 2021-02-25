<?php
SESSION_START();

$conn = mysqli_connect("localhost","root","","recmeds");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn,'recmeds');


//When Submit button is clicked
if(isset($_POST["submit"]))
{
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $usertype = $_POST['usertype'];

  $q = "SELECT * FROM register where username = '$username' or email = '$email' ";   //Check if email or username exists or not.
  $result = mysqli_query($conn,$q);
  $num = mysqli_num_rows($result);

  if($num==1)   // If entered email or username exists
  {
    echo "<script> alert('User Already exists!!'); window.location = 'register.php'</script>";
  }

  elseif ($password1 != $password2)
  {
    echo "<script> alert('The two passwords do not match!!'); window.location = 'register.php'</script>";
  }
  else
  {
    $sql = "INSERT INTO register(name,address,phone,username,email,password,usertype) VALUES('$name','$address','$phone','$username','$email','$password1','$usertype')";
    mysqli_query($conn,$sql);

    if($usertype == "customer")
    {
      $query = "INSERT INTO coustomer(username,address) VALUES('$username','$address')";
      mysqli_query($conn,$query);
    }

    if($usertype == "pharmacy")
    {
      $query = "INSERT INTO stores(username,name,address) VALUES('$username','$name','$address')";
      mysqli_query($conn,$query);
    }

    if($usertype == "ngo")
    {
      $query = "INSERT INTO ngo(username,address) VALUES('$username','$address')";
      mysqli_query($conn,$query);
    }

    if($usertype == "hospital")
    {
      $query = "INSERT INTO hospital(username,address) VALUES('$username','$address')";
      mysqli_query($conn,$query);
    }

    echo "<script> alert('You are registered successfully!!'); window.location = 'login.php'</script>";
  }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
  <style type="text/css">
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .error{
      width: 92%;
      margin: 0px,auto;
      padding: 10px;
      border: 1px solid #a94442;
      color: #a94442;
      background: #f2dede;
      border-radius: 5px;
      text-align: left;
    }
  </style>

    <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:700i,800,900|Ubuntu&display=swap" rel="stylesheet">
      <!-- Font Awsome -->
      <script src="https://kit.fontawesome.com/bfd4febf56.js" crossorigin="anonymous"></script>
      <!-- Bootstrap -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <title>Register</title>
    </head>
    <body class="text-center">
      <form action="register.php" class="form-signin" method="post">
        <!--Display Validation Error Here-->

         <div class="d-flex flex-column pb-3">
           <img class="img-fluid mx-auto d-block" src="images/login.png"  width="72" height="72">
         </div>
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
          <input class="form-control" type="text" name="name" id="input" placeholder="Your name/Store's name/Hospital's name" required autofocus>
          <input class="form-control" type="text" name="address" placeholder="Address" required>
          <input class="form-control" type="text" name="phone" placeholder="Phone No." required>
          <input class="form-control" type="text" name="username" placeholder="Username" required>
          <input class="form-control" type="email" name="email" placeholder="Email address" required>
          <input class="form-control" type="password" name="password1" placeholder="Password" required>
          <input class="form-control" type="password" name="password2" placeholder="Confirm Password" required>
          <label>Register as : </label>
          <select id="selectType" name="usertype">
            <option value="customer">Customer</option>
            <option value="company">Company</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="ngo">NGO</option>
            <option value="hospital">Hospital</option>
          </select>
    </body>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
    <p>Already a User?<a href="login.php"><b>login Here</b></a></p>
</html>
