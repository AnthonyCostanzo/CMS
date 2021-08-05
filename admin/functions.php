<?php 
function confirm($result) {
    global $connection;
    if(!$result) {
        die (mysqli_error($connection));
    }
}

?>

<?php function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection,trim(($string)));
}
?>

<?php 
    function addCategory(){
        global $connection;

        if(isset($_POST['submit'])) {
            $cat_title = escape($_POST['cat_title']);
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
        echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
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
        $image = $row['post_image'];
        $date = $row['post_date'];
        $tags = $row['post_tags'];
        $status = $row['post_status'];
        $view_count = $row['post_views_count'];
        ?>
        <tr>
        <td><input type='checkbox' class='checkboxes' name='checkboxArray[]' value="<?php echo $id ?>"></td>
        <td><?php echo $id ?></td>
        <?php 
            $query = "SELECT * FROM users WHERE user_id = '$author'";
            $post_author = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($post_author);
            $author = $row['username'];
        ?>
        <td><?php echo $author ?></td>
        <td><?php echo $title ?></a></td>
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
        <?php 
            $query = "SELECT * FROM comments WHERE comment_post_id = $id";
            $get_comment_count = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($get_comment_count);
            $comment_id = $row['comment_id'];
            $comment_count = mysqli_num_rows($get_comment_count);
        ?>
        <td><a href='./post_comments.php?p_id=<?php echo $id?>'><?php echo $comment_count ?></a></td>
        <td><?php echo $view_count ?></td>
        <td><?php echo $date ?></td>
        <td><a href="../post.php?p_id=<?php echo $id ?>">View Post</a></td>
        <td><a href="posts.php?resetviews=<?php echo $id?>">Reset View Count</a></td>
        <td><a href="posts.php?source=edit_post&id=<?php echo $id ?>">Edit</a></td>
        <td><a onClick="javascript:return confirm('Are you sure you want to delete this post?')" href="posts.php?delete=<?php echo $id ?>">Delete</a></td>
        
        </tr>
<?php        
    }
}
?>

<?php 
function updatePost() {
    global $connection;
    $id = $_GET['id'];
    if(isset($_POST['update_post'])) {
        $title = escape($_POST['title']);
        $cat_id = escape($_POST['cat_id']);
        $author = escape($_POST['author']);
        $status = escape($_POST['status']);
        $image = escape($_POST['image']);
        $tags = escape($_POST['tags']);
        $content = escape($_POST['content']);
        $query = "UPDATE posts set post_title = '$title', ";
        $query.= "post_category_id='$cat_id', ";
        $query.= "post_author='$author', ";
        $query.= "post_status ='$status', ";
        $query.= "post_tags ='$tags', ";
        $query.= "post_content='$content', ";
        $query.= "post_image ='$image' ";
        $query.= "WHERE post_id = $id";
        $result = mysqli_query($connection,$query);
        if(!$result) {
            echo "<p class = 'bg-danger'> Error Updating Post </p>";
        }
        echo "<p class = 'bg-success'>Post Successfully Updated <a href='../post.php?p_id=$id'>View Post</a> Or
        <a href='./posts.php'>Edit More Posts </a> </p>";
        
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
            <td><?php echo $content ?></td>
            <td><a href = "../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
            <td><?php echo $status ?></td>
            <td><?php echo $date ?></td>
            <td><a href="comments.php?approve=<?php echo $id ?>">Approve</a></td>
            <td><a href="comments.php?unapprove=<?php echo $id ?>">Unapprove</a></td>
            <td><a href="comments.php?delete=<?php echo $id ?>">Delete</a></td>
        </tr>
<?php        
    }
}
?>

<?php 
function showAllUsers() {
    global $connection;
    $query = "SELECT * FROM users";
    $all_users = mysqli_query($connection,$query);
    if(!$all_users) die ('error retrieving users');
    while($row = mysqli_fetch_assoc($all_users)) {
        $id = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $firstname ?></td>
            <td><?php echo $lastname ?></td>
            <td><?php echo $email ?></td>
            <td><img class='img-fluid' src="<?php echo $user_image ?>" height="75px"></td>
            <td><?php echo $user_role ?></td>
            <td><a href="users.php?changetoadmin=<?php echo $id ?>">Admin</a></td>
            <td><a href="users.php?changetosub=<?php echo $id ?>">Subscriber</a></td>
            <td><a href="users.php?source=edit_user&user_id=<?php echo $id ?>">Edit</a></td>
            <td><a href="users.php?delete=<?php echo $id ?>">Delete</a></td>
        </tr>
<?php        
    }
}
?>

<?php 
    function getCount($table) {
        global $connection;
        $query = "SELECT * FROM $table";
        $result = mysqli_query($connection,$query);
        $count = mysqli_num_rows($result);
        echo $count;
    }

?>

<?php 
    function usersOnline() {
        if(isset($_GET['onlineusers'])) {
            global $connection;
            if(!$connection) {
                session_start();
                include '../includes/db.php';
                $session = session_id();
                $time = time();
                $time_out_in_seconds = 5;
                $time_out = $time - $time_out_in_seconds;
                $query = "SELECT * FROM users_online WHERE session = '$session'";
                $send_query = mysqli_query($connection,$query);
                $count = mysqli_num_rows($send_query);
            
                if($count === 0) {
                    mysqli_query($connection,"INSERT INTO users_online (session,time) VALUES('$session','$time')");
                } else {
                mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
                }
                $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > $time_out ");
                $count_user = mysqli_num_rows($users_online_query);
                echo $count_user;
            }
           
        }
    }
  usersOnline();
?>

<?php 
function postComments() {
    global $connection;
    if(isset($_GET['p_id'])) {
        $p_id = escape($_GET['p_id']);
        $query = "SELECT * FROM comments WHERE comment_post_id = $p_id ";
        $post_comments = mysqli_query($connection,$query);
        if(!$post_comments) die ('error retrieving comments');
        while($row = mysqli_fetch_assoc($post_comments)) {
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
                <td><?php echo $content ?></td>
                <td><a href = "../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
                <td><?php echo $status ?></td>
                <td><?php echo $date ?></td>
                <td><a href="comments.php?approve=<?php echo $id ?>">Approve</a></td>
                <td><a href="comments.php?unapprove=<?php echo $id ?>">Unapprove</a></td>
                <td><a href="post_comments.php?delete=<?php echo $id ?>&p_id=<?php echo $post_id?>">Delete</a></td>
            </tr>
    <?php        
        }
    } 
   
}
?>
