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

                
            <h1 class="page-header">
                    Blog Posts
                    <small>Read Below!</small>
                </h1>
                <!-- First Blog Post -->
                <?php 
                    $per_page = 3;
                   if(isset($_GET['page'])) {
                       $page = $_GET['page'];
                      
                   } else {
                       $page = "";
                   }

                   if($page === "" || $page == 1) {
                       $page_1 = 0;
                   } else {
                       $page_1 = ($page * $per_page) - $per_page;
                   }
                    $all_posts_query = "SELECT * FROM posts";
                    $select_all_post = mysqli_query($connection,$all_posts_query);
                    $post_count = mysqli_num_rows($select_all_post);
                    $post_count = ceil($post_count / $per_page);
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                    $result = mysqli_query($connection,$query);
                    if(!$result) die('error');
                    if(mysqli_num_rows($result) === 0) { 
                       echo "<h1 class='text-center'> No Posts Available </h1>";
                    } else {
                    while($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];
                        ?>
                
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id?>">
                <img class="img-responsive" src="<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo strlen($post_content) ? substr($post_content,0,200) . " ...": ""?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <hr>
                   <?php }} ?>
             </div>

            <!-- Blog Sidebar Widgets Column -->
      <?php include './includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>
        <div class = 'text-center'>
        <ul class = 'pagination'>
       <?php 
            for($i = 1; $i <= $post_count; $i++) {
                if($i == $page) {
                    echo "<li class='page-item active '><a href = 'index.php?page=$i'>$i</li>";
                } else {
                    echo "<li class='page-item'><a href = 'index.php?page=$i'>$i</li>";
                }
                
            }
       ?>
      
   </ul>
        </div>
  
<!-- Footer -->
    <?php include './includes/footer.php' ?>