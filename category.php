
<?php include './includes/header.php'?>

<?php include './includes/nav.php' ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <?php 
if(isset($_GET['category'])) {
    $cat_id = $_GET['category'];
    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id";
    $related_posts = mysqli_query($connection,$query);
    if(mysqli_num_rows($related_posts) === 0) {
        echo "<h1 class = 'text-center'> No Posts At This Time</h1>";
    } else {
    while($row = mysqli_fetch_assoc($related_posts)) {
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
                    $query = "SELECT * FROM users WHERE user_id = $author";
                    $get_user = mysqli_query($connection,$query);
                    $row = mysqli_fetch_array($get_user);
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

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                       
                        <!-- End Nested Comment -->
                    </div>
                </div>
                <?php }
    }
  }
?>    
<hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include './includes/sidebar.php' ?>

        <hr>

        <!-- Footer -->
        <?php include './includes/footer.php'?>