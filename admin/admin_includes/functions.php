<?php 
    function insertCategory(){
        global $con;
        if(isset($_POST['add_category'])){
            //get data from user
            $cat_title = $_POST['cat_title'];
            //validation
            if($cat_title == '' || empty($cat_title)){
                echo "<div class='alert alert-danger'><h1 class='text-danger'>This field should not be empty</h1></div>";
            }else{
                $insertSql = "INSERT INTO `categories`(`cat_title`) VALUES ('$cat_title')";
                $insertCategory = mysqli_query($con , $insertSql);
                header("Location:categories.php");
            }
        }
    }//insertCategory

    function deleteCategory(){
        global $con;
        if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $deleteSql = "DELETE FROM `categories` WHERE `cat_id` = '$id' " ;
            $deleteCategory = mysqli_query($con , $deleteSql);
            header("Location:categories.php");
        }
    }//deleteCategory
    
?>