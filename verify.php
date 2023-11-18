<?php
    session_start();
    //           login   باخذ داتا من  
    $username = $_POST['username'];
    $password = $_POST['password'];
    $Email = $_POST['Email'];
    try {
        require('connection.php');
        //   coloums   بختار كل   
    
            // search user from database
            $sql = $db->prepare("SELECT ID, Username, Password ,Type FROM users WHERE Username=? AND Password=?");
            $sql->execute([$Username, $Password]);
            if ($sql->rowCount() > 0) { // if found user
                // make session
                $_SESSION['login'] = true;
                $_SESSION['Username'] = $Username;
                // get id user
                $uid = $sql->fetchAll()[0]['ID'];

                $_SESSION['b'] = $uid; //make a session for id of user
                $sql = "SELECT * FROM users  WHERE  Username LIKE '%$Username%' "; // to search for the keyword that the user typed
                $r = $db->query($sql);
                $idused=0;
                $type="";
                while ($row = $r->fetch()) {
                    $idused= $row[0];
                     $type= $row[4];

                if($type=="cutomer"){
                    header("location:home.php"); // redirection to index
                }
                else if($type=="Staff"){
                    header("location:home.php"); // redirection to index
                }
               
                else if($type=="admin"){
                    header("location:home.php"); // redirection to index
                }}


            } else { // if username or password wrong
                echo "username or password is wrong, please try again";
            }
            $db = null;
        } catch (PDOException $ex) {
            die($ex);
        }
?>