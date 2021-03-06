<?php
    if(isset($_POST['create_post'])) {
        $title = escape($_POST['title']);
        $cat_id = escape($_POST['cat_id']);
        $author = escape($_POST['author']);
        $status = escape($_POST['status']);
        $image = escape($_POST['image']);
        $date = date('y-m-d');
        $tags = escape($_POST['tags']);
        $content = escape($_POST['post_content']);
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_status,post_tags) ";
        $query.= "VALUES('$cat_id','$title',$author,now(),'$image','$content','$status','$tags')";
        $add_post = mysqli_query($connection,$query);
        $id = mysqli_insert_id($connection);
        if(!$add_post) {
            echo "<p class ='bg-danger'> Error Adding Post </p>";
        } else {
            echo "<p class = 'bg-success'>Post Successfully Created <a href='../post.php?p_id=$id'>View Post</a> Or
            <a href='./posts.php'>View All Posts </a> </p>";
        }
       
    }


?>




<form action="" method = 'POST' enctype="multipart/form-data">
    <div class="form-group">
        <label for = 'title'>Post Title</label>
        <input type = 'text' name = 'title' class = 'form-control' required>
    </div>

    <div class="form-group">
        <label for='cat_id'>Category</label>
       <select name='cat_id' class = 'form-control'>
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
        <label for='author'>Post Author</label>
       <select name='author' class = 'form-control'>
        <?php 
            $query = "SELECT * from users";
            $users = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                ?>
                <option value="<?php echo $user_id ?>"><?php echo $username ?></option>
            <?php }

        ?>
        </select>
    </div>

    <div class="form-group">
        <label for = 'status'>Post Status</label>
        <select name = 'status' class = 'form-control'>
            <option value='draft'>Draft</option>
            <option value='published'>Published</option>
        </select>

    </div>

    <div class="form-group">
        <label for = 'image'>Post Image</label>
        <input type = 'text' name = 'image' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'tags'>Post Tags</label>
        <input type = 'text' name = 'tags' class = 'form-control'>
    </div>

    <div class="form-group">
        <label for = 'post_content'>Post Content</label>
        <textarea id='summernote' class = 'form-control' name='post_content' id="" rows="10" cols="30"></textarea>
    </div>
    <div class="form-group">
        <input class = 'btn btn-primary' name='create_post' type = 'submit' value='Add Post'> 
    </div>
       

</form>