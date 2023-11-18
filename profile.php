<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Profile</title>
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
      input[type=text], input[type=password], input[type=number]{
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


      h1{
margin: auto;
justify-content: center;
text-align: center;

      






      }
      </style>
</head>
<body>
<form action="verify.php" method="post">
    <h1>Profile Update</h1><br><br>
      Username: <input type="text" name="username" required><br><br>
      Password: <input type="password" name="password" required><br><br>
      Confirm Password: <input type="password" name="password" required><br><br>
      Phone Number: <input type="number" name="PhoneNo" required><br><br>
      <input type="submit" name="sb" value="submit">
    </form>   
</body>
</html>