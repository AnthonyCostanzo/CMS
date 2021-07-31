<?php include '../functions.php' ?>

<table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>In Response To</th>
                                    <th> Content</th>
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
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = $id";
    $result = mysqli_query($connection,$query);
    header('location: comments.php');
}

?>