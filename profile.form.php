<?php
        $isSubmit = isset($_POST['registerSubmit']);
        $overrideSubmit = isset($_POST['fillInData']);

        if($isSubmit){
            $success = true;
            if(!preg_match("/^[a-zA-Z.0-9]+$/i", $_POST['username'])){
                $success = false;
            }
            
            if(!preg_match("/^.{8,}$/i", $_POST['Password'])){
                $success = false;
            }
            if(!preg_match("/^.{8,}$/i", $_POST['ConfirmPassword'])){
                $success = false;
            }
            if($_POST['ConfirmPassword'] != $_POST['Password']){
                $success = false;
            }
            if((!file_exists($_FILES['profile_image']['tmp_name']) || !is_uploaded_file($_FILES['profile_image']['tmp_name']))){
                $success = false;
            }

            $query = $db->prepare('select * from users where username = :username');
            $query->bindParam(':username', $_POST['username']);
            $query->execute();
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $users = $query->fetchAll();
    
            if(count($users) && !$overrideSubmit){
                $success = false;
            }
            
           
        }
        ?>
<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate enctype="multipart/form-data">
            <div class="mb-3">
                <label for="username" class="form-label">
                    Username
                </label>
                <input type="text"
                    class="form-control <?php echo 
                                    ($isSubmit && (count($users) ||(!preg_match("/^[a-zA-Z.0-9 ]+$/i", $_POST['username']))))?
                                    "is-invalid":
                                    (($isSubmit && (!count($users) && (preg_match("/^[a-zA-Z.0-9 ]+$/i", $_POST['username']))))?"is-valid":"") ?>"
                    id="username" name="username" placeholder="Enter Username"
                    value="<?php echo $overrideSubmit?$_SESSION['Login_User']['username']:( ($isSubmit ) ? $_POST['username']:"") ?>">
                <div class="invalid-feedback">
                    <?php
                                    if($isSubmit && (!preg_match("/^[a-zA-Z.0-9 ]+$/i", $_POST['username']))){
                                    ?>
                    Username may only contain Letters, numbers, and spaces.
                    <?php
                                    }
                                    ?>

                    <?php
                                    if($isSubmit && count($users)){
                                    ?>
                    <br />
                    Username already exists. Please use another username.
                    <?php
                                    }
                                    ?>

                </div>
            </div>

            <div class="mb-3">
                <label for="Password" class="form-label">
                    Password
                </label>
                <input type="password"
                    class="form-control <?php echo 
                                    ($isSubmit && (($_POST['Password'] != $_POST['ConfirmPassword']) || (!preg_match("/^.{8,}$/i", $_POST['Password']))))?
                                    "is-invalid":
                                    (($isSubmit && ($_POST['Password'] == $_POST['ConfirmPassword']) && (preg_match("/^.{8,}$/i", $_POST['Password'])))?"is-valid":"") ?>"
                    id="Password" name="Password" placeholder="Enter Password"
                    value="<?php echo ($isSubmit) ? $_POST['Password']:"" ?>">
                <div class="invalid-feedback">
                    <?php
                                    if(($isSubmit && (!preg_match("/^.{8,}$/i", $_POST['Password'])))){
                                        ?>
                    Passwords may contain a minimum of 8 characters.
                    <?php
                                    }
                                    ?>
                    <?php
                                    if($isSubmit && ($_POST['ConfirmPassword'] != $_POST['Password'])){
                                        ?>
                    Passwords doesn't match.
                    <?php
                                    }
                                    ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="ConfirmPassword" class="form-label">
                    Confirm Password
                </label>
                <input type="password"
                    class="form-control <?php echo 
                                    ($isSubmit && (($_POST['Password'] != $_POST['ConfirmPassword']) || (!preg_match("/^.{8,}$/i", $_POST['Password']))))?
                                    "is-invalid":
                                    (($isSubmit && ($_POST['Password'] == $_POST['ConfirmPassword']) && (preg_match("/^.{8,}$/i", $_POST['Password'])))?"is-valid":"") ?>"
                    id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm your Password"
                    value="<?php echo  ($isSubmit) ? $_POST['ConfirmPassword']:"" ?>">
                <div class="invalid-feedback">
                    <?php
                                    if(($isSubmit && (!preg_match("/^.{8,}$/i", $_POST['ConfirmPassword'])))){
                                        ?>
                    Passwords may contain a minimum of 8 characters.
                    <?php
                                    }
                                    if($isSubmit && ($_POST['ConfirmPassword'] != $_POST['Password'])){
                                        echo "Passwords doesn't match.";
                                         } ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input class="form-control <?php echo $isSubmit && (!file_exists($_FILES['profile_image']['tmp_name']) || !is_uploaded_file($_FILES['profile_image']['tmp_name'])) ? "is-invalid":
                                ($isSubmit && file_exists($_FILES['profile_image']['tmp_name']) ? "is-valid":"") ?>"
                    type="file" id="profile_image" name="profile_image" onchange="ProfileImageUploaded(event)">
                <div class="invalid-feedback">
                    Please upload your profile image
                </div>
            </div>
            <div class="mb-3">
                <div class="profile_circle pic-cover profile_pic"
                    style="<?=!$overrideSubmit?"display:none;":""?> <?=$overrideSubmit?"background-image:url('./profile_pics/".$_SESSION['Login_User']['profile_pic']."');":""?>">
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                <input type="hidden" name="registerSubmit">
                <input type="submit" onclick="onRegisterSubmit(event)" class="btn btn-primary" value="Submit"
                    name="yyy" />
            </div>
        </form>
    </div>
</div>