<?php
    $page = "Post" ;
    include("includes/header.php");
    include("includes/navbar.php");
    $pid = $_GET['p_id'];
    $postSql = "SELECT * FROM `posts` WHERE post_id = $pid " ;
    $postDetails = mysqli_query($con , $postSql);

     while($row = mysqli_fetch_assoc($postDetails)):
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
     endwhile;
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <?php
                 include("includes/post_details.php");
                 include("includes/sidebar.php");
             ?>

        </div>
        <!-- /.row -->

<?php include("includes/footer.php"); ?>