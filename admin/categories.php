<?php include './includes/header.php' ?>
    <div id="wrapper">

        <!-- Navigation -->
      <?php include './includes/nav.php' ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Welcome to the Admin Dashboard
                          <small>Anthony</small>
                        </h1>
                        <?php 
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
                        ?>
                        <?php 
                            if(isset($_GET['delete'])) {
                                $cat_id = $_GET['delete'];
                                $query = "DELETE from categories WHERE id = '$cat_id'";
                                $delete_category = mysqli_query($connection,$query);
                                if(!$delete_category) die("unable to delete at this time");
                                header('location:categories.php');
                            }
                        ?>
                    

                        <?php 
                         
                                if(isset($_POST['update'])) {
                                    $cat_title = $_POST['cat_title'];
                                    if($cat_title === '' || empty($cat_title)) {
                                        echo 'this field should not be empty';
                                    } else {
                                        $cat_title = strtolower($cat_title);
                                        $query = "Update categories set cat_title = '$cat_title' WHERE id = '$cat_id";
                                            $edit_cat = mysqli_query($connection,$query);
                                            if(!$edit_cat) die('error adding category');
                                        }
                                 }
                            
                           
                        ?>

                      <div class="col-xs-6">
                            <form action="" method = 'POST'>
                                <div class="form-group">
                                    <label for="cat_title">Add Category:</label>
                                    <input class='form-control' type="text" name = 'cat_title' placeholder="title">
                                </div>
                                <div class="form-group">
                                    <input class = 'btn btn-primary' type='submit' name = 'submit' value="Add Category">
                                </div>
                            </form>

                            <form action="" method = 'POST'>
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>
                                    <?php 
                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];
                                $query = "SELECT * FROM categories WHERE id = '$cat_id'";
                                $category = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($category)) {
                                ?>
                                <input value = "<?php if (isset($cat_title)) echo $cat_title; ?>" type = 'text' name = 'cat_title' class ='form-control'>

                                <?php }
                            }
                        ?>
                                </div>
                                <div class="form-group">
                                    <input class = 'btn btn-primary' type='submit' name = 'update' value="Edit Category">
                                </div>
                            </form>
                        </div>

                        

                        <div class="col-xs-6">
                            <table class = 'table table-bordered table-hover'>
                                <thead>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </thead>
                                <tbody>
                                    <?php 
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
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include './includes/footer.php' ?> 