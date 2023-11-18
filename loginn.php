<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
      body {
        background-color: #f2f2f2;
      }
      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
        width: 300px;
        margin: auto;
        margin-top: 150px;
      }
      input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }
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
      h1, p{
margin: auto;
justify-content: center;
text-align: center;

      }
    </style>
  </head>
  <body>
 
    <!--  session       يتاكدان اسم اليوز والباسورد صح او لا وان موجودين فب داتابيس او لا ونسوي verifypage لين تسوين سبميت يروح الى ---->
    <form action="verify.php" method="post">
    <h1>Login</h1><br><br>
      Username: <input type="text" name="username" required><br><br>
      Password: <input type="password" name="password" required><br><br>
      <input type="submit" name="sb" value="Login"><br><br>
      <p>don't have an account? <a href="register.php" > register now!</a></p>
    </form>
  </body>
</html>