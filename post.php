<?php include './includes/header.php'?>

<?php include './includes/nav.php' ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <?php 
  if(isset($_GET['p_id'])) {
      $post_id = $_GET['p_id'];
      $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 where post_id = '$post_id'";
      $increment_views = mysqli_query($connection,$view_query);

      $query = "SELECT * FROM posts WHERE post_id = $post_id";
      $result = mysqli_query($connection,$query);
      while($row = mysqli_fetch_assoc($result)) {
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
  
 

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $title ?></h1>
                <?php 
                $query = "SELECT * FROM users WHERE user_id = '$author'";
                $post_author_query = mysqli_query($connection,$query);
                $row = mysqli_fetch_array($post_author_query);
                $post_author = $row['firstname'] . " " . $row['lastname'];
                ?>
                <!-- Author -->
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $author?>"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo $image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p>
                <?php echo $content ?>
                </p>
                <hr>

                <!-- Blog Comments -->
                <?php   
        if(isset($_POST['create_comment'])) {
            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];
            if(empty($comment_author) || empty($comment_email) || empty($comment_content)) {
                echo "<p class = 'bg-danger'> Fields must not be empty</p>";
            } else {
                $date = date('y-m-d');
                $status = 'approved';
                $p_id = $_GET['p_id'];
                $query = "INSERT INTO comments (comment_author,comment_post_id,comment_email,comment_content,comment_date,comment_status) ";
                $query.= "VALUES('$comment_author',$p_id,'$comment_email','$comment_content','$date','$status')";
                $result = mysqli_query($connection,$query);
                // $update_comment_count_query = "UPDATE posts set comment_count = comment_count + 1 WHERE post_id = $p_id";
                // $update_comment_count = mysqli_query($connection,$update_comment_count_query);
                echo "<p class = 'bg-success'> Comment Added! </p>";
            }
        }   
        ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action='' method='post' role="form">
                        <div class="form-group">
                                 <label for ='author'>Author</label>
                                <input type = 'text' class="form-control" name='comment_author'></input>
                        </div>
                        <div class="form-group">
                        <label for ='author'>Email</label>
                                <input type = 'text' class="form-control" name='comment_email'></input>
                        </div>
      
                        <div class="form-group">
                            <label for='comment'>Comment</label>
                            <textarea id = 'summernote' name = 'comment_content' class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name='create_comment' class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    $p_id = $_GET['p_id'];
                    $query = "SELECT * FROM comments WHERE comment_post_id = $p_id AND comment_status = 'approved' ORDER BY comment_id DESC";
                    $related_comments = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($related_comments)) {
                        $id = $row['comment_id'];
                        $post_id = $row['comment_post_id'];
                        $author = $row['comment_author'];
                        $email = $row['comment_email'];
                        $content = $row['comment_content'];
                        $status = $row['comment_status'];
                        $date = $row['comment_date'];
                    ?>
                <!-- Comment -->
                   <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author ?>
                            <small><?php echo $date ?></small>
                        </h4>
                       <?php echo $content?>
                    </div>
                </div>
                <?php }

?>
                <!-- Comment -->
               
                <?php }
  }
?>    
<hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include './includes/sidebar.php' ?>

        <hr>

        <!-- Footer -->
        <?php include './includes/footer.php'?>