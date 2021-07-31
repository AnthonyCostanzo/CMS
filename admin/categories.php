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
                    

                

                      <div class="col-xs-6">
                          <?php addCategory(); ?>
                            <form action="" method = 'POST'>
                                <div class="form-group">
                                    <label for="cat_title">Add Category:</label>
                                    <input class='form-control' type="text" name = 'cat_title' placeholder="title">
                                </div>
                                <div class="form-group">
                                    <input class = 'btn btn-primary' type='submit' name = 'submit' value="Add Category">
                                </div>
                            </form>
                            
                            <?php 
                            global $connection;
                            if(isset($_POST['update'])) {
                                $cat_title = $_POST['cat_title'];
                                $cat_id = $_GET['edit'];
                                if($cat_title === '' || empty($cat_title)) {
                                    echo 'this field should not be empty';
                                } else {
                                    $cat_title = strtolower($cat_title);
                                    $query = "Update categories set cat_title = '$cat_title' WHERE id = '$cat_id'";
                                        $edit_cat = mysqli_query($connection,$query);
                                        if(!$edit_cat) die('error adding category');
                                        header('location:categories.php');
                                    }
                            }


                            ?>
                           
                            <form action="" method = 'POST'>
                            <?php showCategory(); ?>
                            </form>
                        </div>

                        

                        <div class="col-xs-6">
                            <table class = 'table table-bordered table-hover'>
                                <thead>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </thead>
                                <tbody>
                                  <?php displayCategories() ?>
                                  <?php deleteCategory();?>
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