<?php include './includes/header.php'?>
<div id="wrapper">
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

                        <table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th> Comment </th>
                                    <th>In Response To</th>
                                    <th> Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php postComments(); ?>
                            </tbody>
                        </table>

<?php 
    if(isset($_GET['approve'])) {
        $id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $id";
        $approve_comment = mysqli_query($connection,$query);
        header('location:comments.php');

    }

    if(isset($_GET['unapprove'])) {
        $id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $id";
        $approve_comment = mysqli_query($connection,$query);
        header('location:comments.php');

    }


?>
<?php 
if(isset($_GET['delete'])) {
    $p_id = $_GET['p_id']; 
    $id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = $id";
    $result = mysqli_query($connection,$query);
    header("location: post_comments.php?p_id=$post_id");
}

?>

            </div>
        </div>
                <!-- /.row -->
     </div>
            <!-- /.container-fluid -->
    </div>
<?php include './includes/footer.php' ?> 