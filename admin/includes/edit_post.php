<?php updatePost(); ?>
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
        $query = "SELECT * FROM categories WHERE id = $cat_id";
        $get_cat_title = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($get_cat_title)) {
            $cat_id = $row['id'];
            $current_cat_title = $row['cat_title'];
        }
    }


?>




<form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'title'>Post Title</label>
        <input type = 'text' name = 'title' class = 'form-control' value = "<?php echo $title?>">
    </div>

    <div class="form-group">
        <label for = 'category'>Category</label>
        <select name='cat_id' class = 'form-control'>
        <option value='<?php echo $cat_id?>'><?php echo $current_cat_title?></option>
        <?php 
            $query = "SELECT * from categories WHERE cat_title != '$current_cat_title'";
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
        <select name='author' class = 'form-control'>

        <?php 
            $query = "SELECT * from users WHERE user_id = '$author'";
            $author_query = mysqli_query($connection,$query);
            $row = mysqli_fetch_array($author_query);
            $username = $row['username'];
        ?>
        <option value='<?php echo $author?>'><?php echo $username?></option>
        <?php 
            $query = "SELECT * from users WHERE user_id != $author ";
            $all_users = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($all_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                ?>
                <option value="<?php echo $user_id ?>"><?php echo ($username) ?></option>
            <?php }

        ?>
        </select>
    </div>


    <div class="form-group">
        <label for = 'status'>Post Status</label>
        <select name = 'status' class='form-control'>
        <option value = '<?php echo $status ?>'><?php  echo $status ?></option>
        <?php if($status === 'draft') {
            echo "<option value ='published'> published </option>";
            } else echo "<option value = 'draft'> draft </option>";

        ?>
        
     

        </select>
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
        <textarea id='summernote' class = 'form-control' name='post_content' id="" rows="10" cols="30" ><?php echo $content?></textarea>
    </div>
    <div class="form-group">
        <input class = 'btn btn-primary' name='update_post' type = 'submit' value = 'Update Post'> 
    </div>
</form>


