<?php include '../functions.php' ?>
<?php 
    if(isset($_POST['submit'])) {
        if(isset($_POST['checkboxArray'])) {
            $posts = $_POST['checkboxArray'];
            foreach($posts as $id) {
                if($_POST['options'] === 'publish') {
                    $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $id";
                    $publish_posts = mysqli_query($connection,$query);
                    header('location:posts.php');
                } else if($_POST['options'] === 'draft') {
                    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $id";
                    $draft_posts = mysqli_query($connection,$query);
                    header('location:posts.php');
                } else if($_POST['options'] === 'delete') {
                    $query = "DELETE FROM posts WHERE post_id = $id";
                    $delete_posts = mysqli_query($connection,$query);
                    header('location:posts.php');
                }
            }
        } 
    }
   


?>


<form action = "" method = 'POST'>
    <table class = 'table table-hover table-bordered'>
        <div id = "bulkOptionsContainer" class = 'col-xs-4' style='padding:0px'>
            <select class='form-control' name="options" id="">
                <option value ="">Select Options</option>
                <option value ="publish">Publish</option>
                <option value ="draft">Draft</option>
                <option value ="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name='submit' class='btn btn-success' value='Apply'> 
            <a class = 'btn btn-primary' href='posts.php?source=add_post'>Add New</a>
        </div>
        <thead>
            <tr>
                <th><input type='checkbox' id='selectAllBoxes'></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Reset Views</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
         <tbody>
        <?php showAllPosts(); ?>
         </tbody>
</table>
</form>
<?php 
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = $id";
    $result = mysqli_query($connection,$query);
    header('Location:posts.php');
}
if(isset($_GET['resetviews'])) {
    $id = $_GET['resetviews'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $id";
    $result = mysqli_query($connection,$query);
    header('Location:posts.php');
}
?>