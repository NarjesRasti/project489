<?php
include "db_connection.php";
checkSession();
?>

<html>
<?php include "head.php"; ?>

<body>
    <div class="MainContainer">
        <?php include "topnav.php" ?>



        <div class="ContentBody">

            <div class="d-flex justify-content-center align-items-center h-100 flex-column">

                <h1 class="mb-3">
                    Profile Update
                </h1>
                <?php
                // We did this for re-useability for the profile.php, for updating the profile later on..
                $_POST['fillInData'] = true;
                // $_POST['Password'] = $_SESSION['Login_User']['password'];
                // $_POST['ConfirmPassword'] = $_SESSION['Login_User']['password'];
                require "profile.form.php";
                // $success will be defined and properly set from the profile.form.php, as all of the validation will happen inside..
                // Likewise for $isSubmit..
                if($isSubmit && $success){
                    // print_r($_POST);
                    // die();
                    $db->beginTransaction();

                    $time = time();
                    $filename = $time.basename($_FILES['profile_image']['name']);
                    $destination_path = getcwd().DIRECTORY_SEPARATOR."/profile_pics/";
                    move_uploaded_file($_FILES['profile_image']['tmp_name'], $destination_path.basename($filename));
                    unlink($destination_path .$_SESSION['Login_User']['profile_pic']);

                    $query = $db->prepare("UPDATE `users` SET
                    `username` =:username
                    ,`password` = :password
                    ,`profile_pic` = :profile_pic
                    WHERE id = :id");

                    $passwordHash = password_hash($_POST['Password'], PASSWORD_DEFAULT);

                    $query->bindParam(':username',$_POST['username']);
                    $query->bindParam(':password',$passwordHash);
                    $query->bindParam(':profile_pic',$filename);
                    $query->bindParam(':id',$_SESSION['Login_User']['id']);

                    $query->execute();
                    $db->commit();
                    // Refreshing session with latest code..
                    $query = $db->prepare('select * from users where id = :id');
                    $query->bindParam(':id', $_SESSION['Login_User']['id']);
                    $query->execute();
                    $query->setFetchMode(PDO::FETCH_ASSOC);
                    $user = $query->fetch();

                    $_SESSION['Login_User'] = $user;
                    ?>
                <script>
                window.location.href = 'view-questions.php';
                </script>
                <?php
                }
                ?>

            </div>

        </div>
        <?php include "footer.php"; ?>
    </div>

</body>

<script src="register.js"></script>

</html>