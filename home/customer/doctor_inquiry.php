
<?php
SESSION_START();

$mysqli = new mysqli("localhost","root","","recmeds") or die(mysqli_error($mysqli));


//When Submit button is clicked
if(isset($_POST["submit"]))
{
  $_SESSION['doctype'] = $_POST['doctype'];
  $address = $_POST['address'].$_POST['city'].$_POST['state'];


  $url = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&key=AIzaSyB1H3RZBpWVgwGNrtxiI1rCjFrLaM4LweI";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $responseJson = curl_exec($ch);
  curl_close($ch);

  $response = json_decode($responseJson);

  if ($response->status == 'OK') {
    $_SESSION['lat'] = $response->results[0]->geometry->location->lat;
    $_SESSION['lng'] = $response->results[0]->geometry->location->lng;
  }
  echo "<script> window.location = 'doctor.php'</script>";
}
$mysqli->query("TRUNCATE TABLE doctor")or die($mysqli->error);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Know Your Doctor</title>
</head>

<style type="text/css">

	 *{
  margin:0;
  padding:0;
  }
 body{

    background-image: url(image.jpg);
    margin-top:70px;
    margin-left: 100px;
    background-position:center;
   background-size:cover;
   font-family:sans-serif;
    }

   .regform{

    width:500px;
    background-color:rgb(0,0,0,0.6);
    margin:auto;
    margin-right: 100px;
    color:#FFFFFF;
    padding:10px 0px 10px 0px;
    text-align:center;
    border-radius:15px 15px 0px 0px ;
    }
  .main{
      background-color:rgb(0,0,0,0.5);
   width:800px;

   margin:auto;
   margin-right: 100px;
}

  form{
      padding:10px;
      margin-right: 100px;

  }

  #name{
       width:100%;
    height:100px;

    }
  .name{
            margin-left:25px;
   margin-top:30px;
   width: 125px;
   margin-right: 100px;
            color: white;
            font-size: 18px;
            font-weight: 700;}
.state{
       position: relative;
       left:200px;
       right:150;
       top:-37px;
       line-height: 40px;
       border-radius: 6px;
       padding: 0 22px;
       font-size: 16px;

       }
.city{

             position: relative;

       left:411px;
       top:-80px;
       line-height: 40px;
       border-radius: 6px;
       padding: 0 22px;
       font-size: 16px;
       color:#555;
                  }
 .statelabel{
            position:relative;
            color:#E5E5E5;
      text-transform: capitalize;
   font-size: 14px;
   left:203px;
   top:-45px;
   }
.citylabel{
            position:relative;
   color:#E5E5E5;
   text-transform:capitalize;
   font-size:14px;
   left:492px;
   top:-76px;
     }
.landmark{
           position:relative;
     left:200px;
     top:-37px;
     line-height: 40px;
     width:480px;
        border-radius: 6px;
     padding: 0 22px;
     font-size: 16px;
     color: #555;  }

 .option{
         position:relative;
  left:200px;
     top:-37px;
     line-height: 40px;
     width:532px;
     height:40px;
        border-radius: 6px;
     padding: 0 22px;
     font-size: 16px;
     color: #555;
     outline:none;
     overflow:hidden;
  }
     .option option{
                 font-size:20px;
       }
   #coustomer{
                margin-left:25px;
    color:white;
    font-size:18px;

      }
    button{
        background-color:#3BAF9F;
     display:block;
     margin:20px 0px 0px 20px;
     text-align:center;
     border-radius:12px;
     border:2px solid #366473;
     padding:14px 110px;
     outline:none;
     color:white;
     cursor:pointer;
     transition:0.25px;
    }
   button:hover{
                background-color:#5390F5;
      }
</style>
<body>
    <div class="regform">
        <h1>
          Doctor Availability Form</h1>
    </div>
    <div class="main">
      <form action="doctor_inquiry.php" method="POST">
          <h2 class="name">Address </h2><input class="landmark" type="text" name="address" required>
          <div id="name">
            <h2 class="name">Location </h2>
					  <input class="state" type="text" name="state" required><br>
					  <label class="statelabel">State</label>
					  <input class="city" type="text" name="city" required><br>
					  <label class="citylabel">City</label>
          </div>
          <h2 class="name">Doctor-Type</h2>
          <select class="option" name="doctype">
            <option disabled="disabled" selected="selected">--Choose option--</option>
            <option value="Cardiologist">Cardiologist</option>
            <option value="Diabetologist">Diabetologist</option>
            <option value="ENT">ENT</option>
            <option>General Physician</option>
            <option value="Gynecologist">Gynecologist</option>
            <option value="Dermatologist">Dermatologist</option>
            <option value="Orthopedician">Orthopedician</option>
            <option value="Psychiatrist">Psychiatrist</option>
            <option value="Neurologist">Neurologist</option>
            <option value="Dentist">Dentist</option>

          </select>
          <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
