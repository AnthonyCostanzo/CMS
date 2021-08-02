<?php include 'db.php' ?>
<?php session_start() ?>
<?php 
if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = mysqli_real_escape_string($connection,$username);
	$password = mysqli_real_escape_string($connection,$password);
	$query = "Select * FROM users WHERE username = '$username'";
	$row = mysqli_fetch_array($salt);
	$login_user = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($login_user)) {
		$id = $row['user_id'];
		$db_username = $row['username'];
		$db_firstname = $row['firstname'];
		$db_lastname = $row['lastname'];
		$db_password = $row['password'];
		$user_role = $row['user_role'];
	}
	$password = crypt($password,$db_password);
	if($username === $db_username && $password === $db_password) {
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['lastname'] = $db_lastname;
		$_SESSION['user_role'] = $user_role;
		header('Location:../admin');
	} else {
		header("Location:../index.php");
	}

}

?>