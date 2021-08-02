<?php
    if(isset($_GET['user_id'])) {
        $id = $_GET['user_id'];
        $query = "SELECT * FROM users WHERE user_id = $id";
        $user = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($user)) {
            $id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $password = $row['password'];
            $email = $row['email'];
            $image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }
?>
<?php 
    if(isset($_POST['update_user'])) {
        $id = $_GET['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $image = $_POST['image'];
        $user_role = $_POST['user_role'];
        $salt_query = 'SELECT randSalt from users';
        $select_randsalt = mysqli_query($connection,$salt_query);
        $row = mysqli_fetch_assoc($select_randsalt);
        $randsalt = $row['randSalt'];
        $password = crypt($password,$randsalt);
        $query = "UPDATE users set username = '$username', ";
        $query.= "password='$password', ";
        $query.= "firstname='$firstname', ";
        $query.= "lastname ='$lastname', ";
        $query.= "email ='$email', ";
        $query.= "user_image='$image', ";
        $query.= "user_role ='$user_role' ";
        $query.= "WHERE user_id = $id";
        $result = mysqli_query($connection,$query);
        header("Location:users.php");
    }    

?>



<form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'username'>Username</label>
        <input type = 'text' name = 'username' class = 'form-control' value = "<?php echo $username?>">
    </div>
    <div class="form-group">
        <label for = 'password'>Password</label>
        <input type = 'password' name = 'password' class = 'form-control' value = "<?php echo $password?>">
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
        <input type = 'text' name = 'image' class = 'form-control' value = "<?php echo $image?>">
    </div>


    <div class="form-group">
        <label for = 'user_role'>User Role
       <select name="user_role" class = 'form-control'>
        <option value = '<?php echo $user_role ?>'><?php echo $user_role?> </option>
        <?php echo $user_role === 'admin' ? "<option value = 'subscriber'>subscriber</option>" :   "<option value = 'admin'>admin</option>"; ?>
      
       </select>
    </div>

    <div class="form-group">
        <input class = 'btn btn-primary' name='update_user' type = 'submit' value = 'Update User'> 
    </div>
</form>


