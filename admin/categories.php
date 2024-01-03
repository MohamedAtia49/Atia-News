<?php
    include('admin_includes/admin_header.php');
    include('admin_includes/admin_navbar.php');
?>
        <div id="page-wrapper">

            <div class="container-fluid">
                <h1 class="page-header"><?=$title?> <small>/ Categories</small> </h1>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped table-responsive table-bordered table-hover">
                            <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                    $categoriesSql = 'SELECT * FROM `categories`';
                                    $allCategories = mysqli_query($con , $categoriesSql);
                                    while($row = mysqli_fetch_assoc($allCategories)):
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                ?>
                                    <tr>
                                        <td><?=$row['cat_id']?></td>
                                        <td><?=$row['cat_title']?></td>
                                        <td><a href="categories.php?edit=<?=$cat_id?>" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
                                        <td><a href="categories.php?delete=<?=$cat_id?>" class="btn btn-danger"><i class="fa fa-trash"></a></td>
                                    </tr>
                               <?php endwhile ; ?>
                            </tbody>
                            <?php deleteCategory(); ?>
                        </table>
                    </div> <!-- col-md-6 -->


                    <div class="col-md-6 text-center">
                        <?php insertCategory(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Create Category Title</label>
                                <input type="text" class="form-control" style="margin-bottom: 10px;" name="cat_title">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add_category" class="btn btn-primary btn-block">Add Category</button>
                            </div>
                        </form>
                        <!-- End Insert Form -->

                        <!-- Edit Form -->
                       <?php 
                             if(isset($_GET['edit'])){
                                $id = $_GET['edit']; 
                                $catSql = "SELECT `cat_title` FROM `categories` WHERE `cat_id` = '$id' " ;
                                $selectCategory = mysqli_query($con,$catSql);
                                $row = mysqli_fetch_assoc($selectCategory);
                                $cat_title = $row['cat_title'];       
                        ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="">Update Category Title</label>
                                        <input type="text" class="form-control" name="cat_title" value="<?=$cat_title?>" style="margin-bottom: 10px;">
                                    </div>
                                    <div class="form-group">
                                        <?php 
                                            if(isset($_POST['update_category'])){
                                                //get data from user
                                                $cat_title = $_POST['cat_title'];
                                                //validation
                                                if($cat_title == '' || empty($cat_title)){
                                                    echo "<div class='alert alert-danger'><h1 class='text-danger'>This field should not be empty</h1></div>";
                                                }else{
                                                    $updateSql = "UPDATE `categories` SET `cat_title` ='$cat_title' WHERE `cat_id` = $id";
                                                    $updateCategory = mysqli_query($con , $updateSql);
                                                    header("Location:categories.php");
                                                }
                                            }                       
                                        ?>
                                        <button type="submit" name="update_category" class="btn btn-primary btn-block">Update Category</button>
                                    </div>
                                </form>

                        <?php } ?>
                             
                    </div> <!-- col-md-6 -->      
                </div> <!-- /.row -->   
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

<?php include('admin_includes/admin_footer.php') ?>