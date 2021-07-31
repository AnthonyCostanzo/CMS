
<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM posts WHERE post_id = $id";
        $post = mysqli_query($connection,$query);
        confirm($post);
        while($row = mysqli_fetch_assoc($post)) {
            $id = $row['post_id'];
            $cat_id = $row['post_category_id'];
            $title = $row['post_title'];
            $author = $row['post_author'];
            $content = $row['post_content'];
            $image = $row['post_image'];
            $date = $row['post_date'];
            $tags = $row['post_tags'];
            $status = $row['post_status'];
            $comments = $row['comment_count'];
        }
    }


?>




<form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'title'>Post Title</label>
        <input type = 'text' name = 'title' class = 'form-control' value = "<?php echo $title?>">
    </div>

    <div class="form-group">
       <select name='cat_id'>
        <?php 
            $query = 'SELECT * from categories';
            $all_categories = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($all_categories)) {
                $cat_id = $row['id'];
                $cat_title = $row['cat_title'];
                ?>
                <option value="<?php echo $cat_id ?>"><?php echo ($cat_title) ?></option>
            <?php }

        ?>
        </select>
    </div>

    <div class="form-group">
        <label for = 'author'>Post Author</label>
        <input type = 'text' name = 'author' class = 'form-control' value = "<?php echo $author?>">
    </div>

    <div class="form-group">
        <label for = 'image'>Post Status</label>
        <input type = 'text' name = 'status' class = 'form-control' value = "<?php echo $status?>">
    </div>

    <div class="form-group">
        <label for = 'image'>Post Image</label>
        <input type = 'text' name = 'image' class = 'form-control' value = "<?php echo $image?>">
    </div>

    <div class="form-group">
        <label for = 'tags'>Post Tags</label>
        <input type = 'text' name = 'tags' class = 'form-control' value = "<?php echo $tags?>">
    </div>

    <div class="form-group">
        <label for = 'post_content'>Post Content</label>
        <textarea class = 'form-control' name='post_content' id="" rows="10" cols="30" placeholder = "<?php echo $content?>"></textarea>
    </div>
    <div class="form-group">
        <input class = 'btn btn-primary' name='update_post' type = 'submit' value = 'Update Post'> 
    </div>
</form>

<?php updateCategory(); ?>
