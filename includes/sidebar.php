<?php include 'db.php' ?>

<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method = 'POST'>
        <div class="input-group">
            <input name = "search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name = "submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
    </form>
    <!-- /.input-group -->
</div>



<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php 
    global $connection;
    $query = 'SELECT * FROM categories LIMIT 3';
    $result = mysqli_query($connection,$query);
    if(!$result) {
        die('error fetching categories');
    }
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $cat_title = $row['cat_title'];
        ?>
         <li><a href="category.php?category=<?php echo $id ?>"><?php echo $cat_title ?></a></li>
    <?php } ?>
               
               
            </ul>
        </div>
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php 
    global $connection;
    $query = 'SELECT * FROM categories ORDER BY id DESC LIMIT 3';
    $result = mysqli_query($connection,$query);
    if(!$result) {
        die('error fetching categories');
    }
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $cat_title = $row['cat_title'];
        ?>
         <li><a href="category.php?category=<?php echo $id ?>"><?php echo $cat_title ?></a></li>
    <?php } ?>
               
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>