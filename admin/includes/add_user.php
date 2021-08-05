<?php
    if(isset($_POST['create_user'])) {
        $username = escape($_POST['username']);
        $password = escape($_POST['password']);
        $firstname =escape($_POST['firstname']);
        $lastname = escape($_POST['lastname']);
        $email = escape($_POST['email']);
        $image = escape($_POST['user_image']);
        $user_role = escape($_POST['user_role']);
        $query = "INSERT INTO users(username,password,firstname,lastname,email,user_image,user_role) ";
        $query.= "VALUES('$username','$password','$firstname','$lastname','$email','$image','$user_role')";
        $add_user = mysqli_query($connection,$query);
        if(!$add_user) die('Error Adding User ');
        echo "User Created: " . "<a href='users.php'>View Users</a>";
    }


?>




<form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'username'>Username</label>
        <input type = 'text' name = 'username' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'firstname'>Password</label>
        <input type = 'text' name = 'password' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'firstname'>First Name</label>
        <input type = 'text' name = 'firstname' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'lastname'>Last Name</label>
        <input type = 'text' name = 'lastname' class = 'form-control'>
    </div>
    <div class="form-group">
        <label for = 'email'>Email</label>
        <input type = 'text' name = 'email' class = 'form-control'>
    </div>


    <div class="form-group">
        <label for = 'user_image'>User Image</label>
        <input type = 'text' name = 'user_image' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'user_role'>User Role</label>
        <select name = 'user_role' class='form-control'>
        <option value = "">Select Options </option>
        <option value = 'subscriber'>Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input class = 'btn btn-primary' name='create_user' type = 'submit' value='Add User'> 
    </div>
       

</form>