<?php include './includes/header.php'?>

<?php include './includes/nav.php' ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
            <h1 class="page-header">
                   <?php if(isset($_GET['author'])) {
                       $author = $_GET['author'] ;
                       echo $author."'s Posts";
                   }?>
                   
                    <small>Read Below!</small>
                </h1>
            <?php 
  if(isset($_GET['p_id'])) {
      $post_id = $_GET['p_id'];
      $author = $_GET['author'];
      $query = "SELECT * FROM posts WHERE post_author = '$author'";
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

                <!-- Author -->
                <p class="lead">
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
      <?php }} ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include './includes/sidebar.php' ?>

        <hr>

        <!-- Footer -->
        <?php include './includes/footer.php'?>