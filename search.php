 <?php include 'db.php' ?>

<!-- Header -->
<?php include './includes/header.php'; ?>

<!-- Navigation -->
<?php include './includes/nav.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php 
            global $connection;
            if(isset($_POST['submit'])) {
                $search_string = strtolower($_POST['search']);
                $query = "SELECT * FROM posts where post_tags LIKE '%$search_string%'";
                $result = mysqli_query($connection,$query);
                if(!$result) {
                    die('error');
                }
                $count = mysqli_num_rows($result);
                if($count === 0) {
                    echo "<h3> No results </h3> ";
                }
                while($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
        
            
            ?>
               
               
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a>
                </h2>
                <?php 
                $query = "SELECT * FROM users WHERE user_id = $post_author";
                $post_author_query = mysqli_query($connection,$query);
                $row = mysqli_fetch_array($post_author_query);
                $author = $row['firstname'] . " " . $row['lastname'];
                ?>
                <p class="lead">
                    by <a href="index.php"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                   <?php }} ?>
             </div>

            <!-- Blog Sidebar Widgets Column -->
      <?php include './includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>
<!-- Footer -->
    <?php include './includes/footer.php' ?>



