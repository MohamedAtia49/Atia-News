<?php
    include('admin_includes/admin_header.php');
    include('admin_includes/admin_navbar.php');
?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <h1 class="page-header"><?=$title?> <small>/ Create Post</small> </h1>
                <!-- Page Heading -->
            <?php            
                if(isset($_POST['add_post'])){
                    $post_title = $_POST['post_title'];
                    $cat_id = $_POST['cat_id'];
                    $post_author = $_POST['post_author'];
                    $post_content = $_POST['post_content'];
                    $post_date = date('d-m-Y');

                    $post_image_name = $_FILES['post_image']['name'];
                    $post_image_tmp = $_FILES['post_image']['tmp_name'];
                    move_uploaded_file($post_image_tmp , "../images/$post_image_name");

                    $insertSql = "INSERT INTO `posts`(`cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`) VALUES ('$cat_id','$post_title','$post_author', now() ,'$post_image_name','$post_content')" ;
                    $insertPost = mysqli_query($con,$insertSql);
                    header("Location:posts.php");
                }
            ?>
                <div class="container text-center">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3 class="text-center">Title</h3>
                        <input type="text" name="post_title" class="form-control" placeholder="Title">
                        <h3 class="text-center">Category</h3>
                        <select name="cat_id" class="form-control">
                        <?php
                            $catSql = "SELECT * FROM `categories`";
                            $allCategories = mysqli_query($con , $catSql);
                            while ($row = mysqli_fetch_assoc($allCategories)) :
                                $cat_id = $row['cat_id'] ;
                                $cat_title = $row['cat_title'] ;
                        ?>
                            <option value="<?=$cat_id?>"><?=$cat_title?></option>
                        <?php endwhile ?>
                        </select>
                        <h3 class="text-center">Author</h3>
                        <input type="text" name="post_author" class="form-control" placeholder="Author">
                        <h3 class="text-center">Image</h3>
                        <input type="file" name="post_image" class="form-control">
                        <h3 class="text-center">Content</h3>
                        <textarea name="post_content" rows="4" class="form-control" placeholder="Content"></textarea>
                        <button type="submit" name="add_post" class="btn btn-primary btn-lg text-center" style="margin-top: 10px;">Add Post</button>
                    </form>
                </div>
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<?php include('admin_includes/admin_footer.php') ?>