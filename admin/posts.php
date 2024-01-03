<?php
    include('admin_includes/admin_header.php');
    include('admin_includes/admin_navbar.php');
?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <h1 class="page-header"><?=$title?> <small>/ All Posts</small> </h1>
                <!-- Page Heading -->

                <table class="table table-striped table-responsive table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Image</th>
                            <!-- <th>Content</th> -->
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $postsSql = "SELECT * FROM `posts`";
                            $allPosts = mysqli_query($con , $postsSql);
                            while ($row = mysqli_fetch_assoc($allPosts)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $cat_id = $row['cat_id'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];                                
                        ?>
                        <tr>
                            <td><?=$post_id?></td>
                            <td><?=$post_title?></td> 

                            <?php
                                $postCategorySql = "SELECT * FROM `categories` WHERE `cat_id` = '$cat_id'";
                                $category = mysqli_query($con , $postCategorySql);
                                $row = mysqli_fetch_assoc($category);
                                $cat_title = $row['cat_title'];
                            ?> 

                            <td><?=$cat_title?></td>
                            <td><?=$post_author?></td>
                            <td><?=$post_date?></td>
                            <td><div class="text-center"><img src="../images/<?=$post_image?>" height="50" alt=""></div></td>
                            <!-- <td><?=substr($post_content , 0 , 300)?></td> -->
                            <td><a href="edit_post.php?edit=<?=$post_id?>" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                            <td><a href="posts.php?delete=<?=$post_id?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php
                        if(isset($_GET['delete'])){
                            $id = $_GET['delete'];
                            $deleteSql = "DELETE FROM `posts` WHERE `post_id` = '$id' ";
                            $deletePost = mysqli_query($con , $deleteSql);
                            header("Location:posts.php");
                        }
                    ?>
                </table>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<?php include('admin_includes/admin_footer.php') ?>