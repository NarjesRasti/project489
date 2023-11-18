<?php
// we create register page because we want to creat admin and user
    if(isset($_POST['sb'])){
      $Name = trim($_POST['uName']);
      $Username = trim($_POST['name']);
      $Address = trim($_POST['Address']);
      $DOB = trim($_POST['DOB']);
      $CreditCardInfo = trim($_POST['CreditCardInfo']);
      $Email = trim($_POST['Email']);
      $PhoneNo = trim($_POST['PhoneNo']);
      $Password = trim($_POST['Password']);
      


      $errors = array(); // to collect errors
      // check inputs

      if (!preg_match("/^(?=[a-zA-Z0-9._]{3,9}$)(?!.*[_.]{2})[^_.].*[^_.]$/", $Username)) {
          array_push($errors, "must be username form 3 to 9 character");
      }
      if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
          array_push($errors, "email is not valid");
      }
      if (!preg_match("/^[\d]{8}$/", $PhoneNo)) {
          array_push($errors, "must be tel 8 digits");
      }
      if (!preg_match("/^[\w\!\@\#\$\%\^\&\*\(\)\[\]]{6,10}$/", $Password)) {
          array_push($errors, "must be password form 6 to 10 character");
      }
//md5($password)
      if (count($errors) <= 0) { // if don't have error
          require_once "connection.php"; // connect database
          try {
              $sql = $db->prepare("INSERT INTO users (Username,Password,Email,Type)
                                  VALUES (?, ?, ?,?)");
              $sql->execute([$Username, $Password, $Email,$Customer]); // add data
              $sql = "SELECT * FROM users  WHERE  Username LIKE '%$Username%' "; // to search for the keyword that the user typed
              $r = $db->query($sql);
              $idused=0;
              while ($row = $r->fetch()) {
                  $idused= $row[0];
              }

              $sql = $db->prepare("INSERT INTO Customer (customerCPR,name, PhoneNo,Email,Address,DOB,CreditCardInfo,ShippingInfo,UserID,gender)
                                  VALUES (?, ?, ?, ?, ?, ?,?,?,?)");
              $sql->execute([$Fname, $Lname, $PhoneNo,$Email,$Address,$DOB,$CreditCardInfo,$ShippingInfo,$idused]); // add data

             // $_SESSION['login'] = true; // create session
            //  $_SESSION['Username'] = $Username;

              header("location:login.php");
          } catch (PDOException $ex) {
              die($ex);
          }
      } else {
          echo "<ul>";
          foreach ($errors as $error) { // show errors
              echo "<li>" . $error . "</li>";
          }
          echo "</ul>";
      }
  }
  ?>
 ?>




















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
      body {
        background-color: #f2f2f2;
      }
      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
        width: 400px;
        margin: auto;
        margin-top: 150px;
      }
      input[type=text], input[type=password] ,input[type=number] ,input[type=email],input[type=date] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;}
        input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      input[type=submit]:hover {
        background-color: #45a049;
      }


      h1,p {
margin: auto;
justify-content: center;
text-align: center;

      }



      </style>
</head>
<body>
<form method="post" enctype="multipart/form-data" >
<h1>Register</h1><br><br>
        Name: <input type="text" name="uName" required><br><br>
        UserName: <input type="text" name="name" required><br><br>
        Password: <input type="password" name="Password" required><br><br>
        Confirm Password: <input type="password" name="password"><br><br>
        Phone Number: <input type="number" name="PhoneNo" required><br><br>
        Email: <input type="email" name="Email" required><br><br>
        Address: <input type="text" name="Address" required><br><br>
        Date Of Birth: <input type="date" name="DOB" required><br><br>
        CreditCard Info: <input type="number" name="CreditCardInfo" required><br><br>
       
      <input type="hidden" value="Patient" name="Patient">
        <input type="submit" value="Register" name="register"><br><br>
        <p>already have an account? <a href="home.html" >login now!</a></p>
    </form>
</body>
</html>