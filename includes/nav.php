<?php include 'db.php' ?>
<?php session_start() ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
             <?php 
                $query = 'SELECT * FROM categories LIMIT 4';
                $result = mysqli_query($connection,$query);
                if(!$result) {
                    die('error fetching categories');
                }
                while($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $cat_title = $row['cat_title'];
                    ?>
                    <li><a href="category.php?category=<?php echo $id?>"><?php echo $cat_title ?></a></li>
                <?php } ?>
                    <li>
                        <a href="admin"> Admin</a>
                    </li>
                    <?php if(!isset($_SESSION['id'])) {
                        ?>
                     <li>
                        <a href="registration.php">Register</a>
                    </li>
                    <?php } ?>
                        <?php 
                            if(isset($_SESSION['id'])) {
                               if(isset($_GET['p_id'])) {
                                $p_id = $_GET['p_id'];
                     
                                echo "<li> <a href='./admin/posts.php?source=edit_post&id=$p_id'>Edit Post</a></li>";
                               }
                            }
                        ?>
               <?php if (isset($_SESSION['id'])) { ?>
                <li>
                        <a href="./includes/logout.php">Logout</a>
                </li>
                <?php } ?>
                </ul>
               
  
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
