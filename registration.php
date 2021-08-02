<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    <?php 
        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $image = $_POST['image'];
            $username = mysqli_real_escape_string($connection,$username);
            $firstname = mysqli_real_escape_string($connection,$firstname);
            $lastname = mysqli_real_escape_string($connection,$lastname);
            $email = mysqli_real_escape_string($connection,$email);
            $password = mysqli_real_escape_string($connection,$password);
            $image = mysqli_real_escape_string($connection,$image);
            if(empty($image)) $image = "";
            if(empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
              echo "<h6 class='bg-danger text-center'>Fields Must Not Be Empty</h6>" ;
            } else {
                $query = 'SELECT randSalt from users';
                $select_randsalt = mysqli_query($connection,$query);
                $row = mysqli_fetch_assoc($select_randsalt);
                $randsalt = $row['randSalt'];
                $password = crypt($password,$randsalt);
                $register_user_query = "INSERT INTO users (username,email, firstname,lastname, password, user_image, user_role) ";
                $register_user_query.= "VALUES('$username','$email', '$firstname','$lastname','$password','$image','subscriber')";
                $register_user = mysqli_query($connection,$register_user_query);
                if($register_user) {
                    echo "<h6 class = 'bg-success text-center'> User Successfully Created <a href='./admin/users.php'>View Here</a></h6>";
                } else {
                    echo "<h6 class='bg-danger text-center'>Registration Failed</h6>" ;
                }
            }
        }
    ?>

    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="sr-only">User Image</label>
                            <input type="text" name="image" id="image" class="form-control" placeholder="Enter Desired Image">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
