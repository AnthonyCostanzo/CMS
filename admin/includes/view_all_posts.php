<?php include '../functions.php' ?>

<table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showAllPosts(); ?>
                            </tbody>
                        </table>
<?php 
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = $id";
    $result = mysqli_query($connection,$query);
    header('Location:posts.php');
}

?>