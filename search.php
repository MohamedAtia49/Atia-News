<?php
    $page = "Home Page" ;
    include("includes/header.php");
    include("includes/navbar.php");
?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <?php 
                include("includes/search_results.php");
                include("includes/sidebar.php");
             ?>

        </div><!-- /.row -->

<?php include("includes/footer.php") ?>