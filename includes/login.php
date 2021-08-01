<?php include "db.php" ?>
<?php session_start() ?>

<?php
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = mysqli_real_escape_string($connection,$username);
        $password = mysqli_real_escape_string($connection,$password);
        $user_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $user = mysqli_query($connection,$user_query);
        if(mysqli_num_rows($user) === 0) header("Location:../index.php");
        else {
            while($row = mysqli_fetch_assoc($user)) {
                $id = $row['user_id'];
                $username = $row['username'];
                $password = $row['password'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_role'] = $user_role;

            header('Location:../admin');
        }

    }


?>