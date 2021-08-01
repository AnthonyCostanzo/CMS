<?php include './includes/header.php' ?>
<?php 
        if(isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $query = "SELECT * FROM users WHERE user_id = '$user_id'";
            $retrieve_user = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($retrieve_user)) {
                $id = $row['user_id'];
                $username = $row['username'];
                $password = $row['password'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
        } else {
            echo 'No User Logged In';
        }
?>

    <div id="wrapper">

        <!-- Navigation -->
      <?php include './includes/nav.php' ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    <h1 class="page-header">
                          Welcome to the Admin Dashboard
                          <small><?php echo $_SESSION['firstname'] ?></small>
                        </h1>
                        <form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'username'>Username</label>
        <input type = 'text' name = 'username' class = 'form-control' value = "<?php echo $username?>">
    </div>
    <div class="form-group">
        <label for = 'password'>Password</label>
        <input type = 'text' name = 'password' class = 'form-control' value = "<?php echo $password?>">
    </div>

     <div class="form-group">
        <label for = 'firstname'>First Name</label>
        <input type = 'text' name = 'firstname' class = 'form-control' value = "<?php echo $firstname?>">
    </div>

    <div class="form-group">
        <label for = 'lastname'>Last Name</label>
        <input type = 'text' name = 'lastname' class = 'form-control' value = "<?php echo $lastname?>">
    </div>

    <div class="form-group">
        <label for = 'email'>Email</label>
        <input type = 'text' name = 'email' class = 'form-control' value = "<?php echo $email?>">
    </div>

    <div class="form-group">
        <label for = 'image'>User Image</label>
        <input type = 'text' name = 'image' class = 'form-control' value = "<?php echo $user_image?>">
    </div>


    <div class="form-group">
        <label for = 'user_role'>User Role
       <select name="user_role" class = 'form-control'>
        <option value = '<?php echo $user_role ?>'><?php echo $user_role?> </option>
        <?php echo $user_role === 'admin' ? "<option value = 'subscriber'>subscriber</option>" :   "<option value = 'admin'>admin</option>"; ?>
      
       </select>
    </div>

    <div class="form-group">
        <input class = 'btn btn-primary' name='update_profile' type = 'submit' value = 'Update Profile'> 
    </div>
</form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    if(isset($_POST['update_profile'])) {
        $id = $_SESSION['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $image = $_POST['image'];
        $user_role = $_POST['user_role'];
    
        $query = "UPDATE users set username = '$username', ";
        $query.= "password='$password', ";
        $query.= "firstname='$firstname', ";
        $query.= "lastname ='$lastname', ";
        $query.= "email ='$email', ";
        $query.= "user_image='$image', ";
        $query.= "user_role ='$user_role' ";
        $query.= "WHERE user_id = $id";
        $result = mysqli_query($connection,$query);
        header("Location:profile.php");
    }

?>
<?php include './includes/footer.php' ?> 