<?php include '../includes/db.php' ?>

<?php 

function confirm($result) {
    global $connection;
    if(!$result) {
        die (mysqli_error($connection));
    }
}

?>


<?php 
    function addCategory(){
        global $connection;
        if(isset($_POST['submit'])) {
            $cat_title = $_POST['cat_title'];
            if($cat_title === '' || empty($cat_title)) {
                echo 'this field should not be empty';
            } else {
                $cat_title = strtolower($cat_title);
                $query = "INSERT INTO categories (cat_title) VALUES('$cat_title')";
                $add_cat = mysqli_query($connection,$query);
                if(!$add_cat) die('error adding category');
            }
        }
    }
?>

<?php 
    function showCategory() {
        global $connection;
        if(isset($_GET['edit'])) {
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE id = '$cat_id'";
            $category = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($category)) {
                $cat_title = $row['cat_title'];
            ?>
          
            <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
                                    <input value = "<?php if (isset($cat_title)) echo $cat_title; ?>" type = 'text' name = 'cat_title' class ='form-control'>
                                </div>
                                <div class="form-group">
                                    <input class = 'btn btn-primary' type='submit' name = 'update' value="Edit Category">
                                </div>
            <?php }
        }
   }     
  ?>              
   





<?php 
function deleteCategory() {
    global $connection;
    if(isset($_GET['delete'])) {
        $cat_id = $_GET['delete'];
        $query = "DELETE from categories WHERE id = '$cat_id'";
        $delete_category = mysqli_query($connection,$query);
        if(!$delete_category) die("unable to delete at this time");
        header('location:categories.php');
    }
}
?>      

<?php 
 function displayCategories() {
    global $connection;
    $query = 'SELECT * FROM categories';
    $all_categories = mysqli_query($connection,$query);
    if(!$all_categories) die('error fetching categories');
    while($row = mysqli_fetch_assoc($all_categories)) {
        $cat_id = $row['id'];
        $cat_title = $row['cat_title'];
        echo '<tr>';
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
        echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
        echo "</tr>";
 }
}
?>

<?php 
function showAllPosts() {
    global $connection;
    $query = "SELECT * FROM posts";
    $all_posts = mysqli_query($connection,$query);
    if(!$all_posts) die ('error retrieving posts');
    while($row = mysqli_fetch_assoc($all_posts)) {
        $id = $row['post_id'];
        $cat_id = $row['post_category_id'];
        $title = $row['post_title'];
        $author = $row['post_author'];
        $content = $row['post_content'];
        $image = $row['post_image'];
        $date = $row['post_date'];
        $tags = $row['post_tags'];
        $status = $row['post_status'];
        $comments = $row['comment_count'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $author ?></td>
            <td><?php echo $title ?></td>
            <?php 
                  $query = "SELECT * FROM categories WHERE id = '$cat_id'";
                  $category = mysqli_query($connection,$query);
                  while($row = mysqli_fetch_assoc($category)) {
                      $cat_title = $row['cat_title'];
                  };

            ?>
            <td><?php echo $cat_title ?></td>
            <td><?php echo $status ?></td>
            <td><img src="<?php echo $image ?>" height="50px"></td>
            <td><?php echo $tags ?></td>
            <td><?php echo $comments ?></td>
            <td><?php echo $date ?></td>
            <td><a href="posts.php?source=edit_post&id=<?php echo $id ?>">Edit</a></td>
            <td><a href="posts.php?delete=<?php echo $id ?>">Delete</a></td>
        </tr>
<?php        
    }
}
?>

<?php 
function updateCategory() {
    global $connection;
    $id = $_GET['id'];
    if(isset($_POST['update_post'])) {
        $title = $_POST['title'];
        $cat_id = $_POST['cat_id'];
        $author = $_POST['author'];
        $status = $_POST['status'];
        $image = $_POST['image'];
        $tags = $_POST['tags'];
        $content = $_POST['post_content'];
        $query = "UPDATE posts set post_title = '$title', ";
        $query.= "post_category_id='$cat_id', ";
        $query.= "post_author='$author', ";
        $query.= "post_status ='$status', ";
        $query.= "post_tags ='$tags', ";
        $query.= "post_content='$content', ";
        $query.= "post_image ='$image' ";
        $query.= "WHERE post_id = $id";
        $result = mysqli_query($connection,$query);
        confirm($result);
        header("Location:posts.php");
    }    
}
?>

<?php 
function showAllComments() {
    global $connection;
    $query = "SELECT * FROM comments";
    $all_comments = mysqli_query($connection,$query);
    if(!$all_comments) die ('error retrieving comments');
    while($row = mysqli_fetch_assoc($all_comments)) {
        $id = $row['comment_id'];
        $post_id = $row['comment_post_id'];
        $author = $row['comment_author'];
        $email = $row['comment_email'];
        $content = $row['comment_content'];
        $status = $row['comment_status'];
        $date = $row['comment_date'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $author ?></td>
            <td><?php echo $email ?></td>
            <?php 
                  $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
                  $category = mysqli_query($connection,$query);
                  while($row = mysqli_fetch_assoc($category)) {
                      $post_title = $row['post_title'];
                  };

            ?>
            <td><a href = "../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
            <td><?php echo $content ?></td>
            <td><?php echo $status ?></td>
            <td><?php echo $date ?></td>
            <td><a href="comments.php?action=approve&id=<?php echo $id ?>">Approve</a></td>
            <td><a href="comments.php?action=unapprove&id=<?php echo $id ?>">Unapprove</a></td>
            <td><a href="comments.php?delete=<?php echo $id ?>">Delete</a></td>
        </tr>
<?php        
    }
}
?>

   
    
