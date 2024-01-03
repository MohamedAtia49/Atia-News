<?php
    include('admin_includes/admin_header.php');
    include('admin_includes/admin_navbar.php');
?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <h1 class="page-header"><?=$title?> <small>/ Edit Post</small> </h1>
                <!-- Page Heading -->
            <?php if(isset($_GET['edit'])){ 

                   $id = $_GET['edit'];
                   $selectSql = "SELECT * FROM `posts` WHERE `post_id` = '$id'";
                   $post = mysqli_query($con,$selectSql);
                   $row = mysqli_fetch_assoc($post);
                   $post_title = $row['post_title'];
                   $cat_id = $row['cat_id'];
                   $post_author = $row['post_author'];
                   $post_content = $row['post_content'];
                   $post_image = $row['post_image'];
                   $post_date = $row['post_date']; 

                if(isset($_POST['update_post'])){
                        $post_title = $_POST['post_title'];
                        $cat_id = $_POST['cat_id'];
                        $post_author = $_POST['post_author'];
                        $post_image_name = $_FILES['post_image']['name'];
                        $post_image_tmp = $_FILES['post_image']['tmp_name'];                        
                        $post_content = $_POST['post_content'];

                        if($post_title == "" | empty($post_title)){
                            echo "<div class='alert alert-danger'><h1 class='text-danger text-center'>Title field should not be empty</h1></div>";
                        }
                        elseif($post_author == "" | empty($post_author)){
                            echo "<div class='alert alert-danger'><h1 class='text-danger text-center'>Author field should not be empty</h1></div>";
                        }
                        elseif($post_content == "" | empty($post_content)){
                            echo "<div class='alert alert-danger'><h1 class='text-danger text-center'>Content field should not be empty</h1></div>";
                        }
                        elseif($post_image_tmp != ""){
                            move_uploaded_file($post_image_tmp , "../images/$post_image_name");
                            $updateSql = "UPDATE `posts` SET `post_title`='$post_title',`cat_id`='$cat_id',`post_author`='$post_author',`post_image`='$post_image_name',`post_content`='$post_content' WHERE `post_id` = $id";
                            $update = mysqli_query($con,$updateSql);
                            header("Location:posts.php");
                        }else{
                            $updateSql = "UPDATE `posts` SET `post_title`='$post_title',`cat_id`='$cat_id',`post_author`='$post_author',`post_content`='$post_content' WHERE `post_id` = $id";
                            $update = mysqli_query($con,$updateSql);
                            header("Location:posts.php");
                        }
                        
                                 
                } ?>
                <div class="container text-center">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center">Title</h3>
                        <input type="text" name="post_title" value="<?=$post_title?>" class="form-control" placeholder="Title">
                        <h3 class="text-center">Category</h3>
                        <select name="cat_id" class="form-control">
                        <?php
                            $catSql = "SELECT * FROM `categories` WHERE `cat_id` = '$cat_id'";
                            $allCategories = mysqli_query($con , $catSql);
                            while ($row = mysqli_fetch_assoc($allCategories)) :
                                $cat_id = $row['cat_id'] ;
                                $cat_title = $row['cat_title'] ;
                        ?>
                            <option value="<?=$cat_id?>"><?=$cat_title?></option>
                        <?php endwhile ?>
                        </select>
                        <h3 class="text-center">Author</h3>
                        <input type="text" name="post_author" value="<?=$post_author?>" class="form-control" placeholder="Author">
                        <h3 class="text-center">Image</h3>
                        <input type="file" name="post_image" class="form-control">
                        <img src="../images/<?=$post_image?>" alt="" height="100">
                        <h3 class="text-center">Content</h3>
                        <textarea name="post_content" rows="4" class="form-control" placeholder="Content"><?php echo htmlspecialchars($post_content); ?></textarea>
                        <button type="submit" name="update_post" class="btn btn-primary btn-lg text-center" style="margin-top: 10px;">Add Post</button>
                    </form>
                </div>
                             
            <?php } ?>
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<?php include('admin_includes/admin_footer.php') ?>