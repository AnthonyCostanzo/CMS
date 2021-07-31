<?php include '../functions.php' ?>

<table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>User Image</th>
                                    <th>User Role</th>
                                    <th>Make Admin</th>
                                    <th>Make Subscriber</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showAllUsers(); ?>
                            </tbody>
                        </table>
<?php 
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = $id";
    $delete_user = mysqli_query($connection,$query);
    header('Location:users.php');
}
?>

<?php 
if(isset($_GET['changetoadmin'])) {
    $user_id = $_GET['changetoadmin'];
    $query = "UPDATE users set user_role='admin' WHERE user_id = $user_id";
    $make_admin = mysqli_query($connection,$query);
    header('Location:users.php');
}
?>

<?php 
if(isset($_GET['changetosub'])) {
    $user_id = $_GET['changetosub'];
    $query = "UPDATE users set user_role='subscriber' WHERE user_id = $user_id";
    $make_admin = mysqli_query($connection,$query);
    header('Location:users.php');
}
?>