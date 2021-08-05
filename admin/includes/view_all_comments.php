<?php include '../functions.php' ?>

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
                                <?php showAllComments(); ?>
                            </tbody>
                        </table>

<?php 
    if(isset($_GET['approve'])) {
        $id = escape($_GET['approve']);
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $id";
        $approve_comment = mysqli_query($connection,$query);
        header('location:comments.php');

    }

    if(isset($_GET['unapprove'])) {
        $id = escape($_GET['unapprove']);
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $id";
        $approve_comment = mysqli_query($connection,$query);
        header('location:comments.php');

    }


?>
<?php 
if(isset($_GET['delete'])) {
    $id = escape($_GET['delete']);
    $query = "DELETE FROM comments WHERE comment_id = $id";
    $result = mysqli_query($connection,$query);
    header('location: comments.php');
}

?>