<?php
    include('./config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        if($image_name != ""){
            $path = "../images/category/" .$image_name;
            $remove = unlink($path);
            if($remove == false){
                $_SESSION['remove'] = "Failed to remove";
                header("Location:".SITEURL."admin/manage-category.php");
                die();
            }
        }
        $sql = "DELETE FROM tbl_category WHERE id= ".$id;
        $res = mysqli_query($conn,$sql);
        if($res == true){
            $_SESSION['delete'] = "Delete Category successfully";  
            header("Location:".SITEURL."admin/manage-category.php");  
        }
        else{
            $_SESSION['delete'] = "Delete Category Failed";   
            header("Location:".SITEURL."admin/manage-category.php");  
        }
    }
    else{
        header("Location:".SITEURL."admin/manage-category.php");  
    }
?>