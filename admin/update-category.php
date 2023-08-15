<?php include('./patials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>
                Update Category
            </h1>
            <br><br>
        <?php
            //check id if existing
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $query = "SELECT * FROM tbl_category WHERE id = $id";
                $res = mysqli_query($conn, $query);
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no-category'] = "No category available";
                    header("Location:".SITEURL."admin/manage-category.php");
                }
            }
            else{
                header("Location:".SITEURL."admin/manage-category.php");
            }
        ?>
        <form action="" method= "post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?= $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Current img :</td>
                    <td>
                        <?php
                            if($current_image !=""){
                                echo '<img src="'.SITEURL.'images/category/'.$current_image.'" name="current-image" width="100" height="100">';
                            }
                            else{
                                echo "No image added";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New img :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio"<?php if($featured == "Yes"){echo "checked";} ?> name="featured" id="" value="Yes"> Yes
                        <input type="radio"<?php if($featured == "No"){echo "checked";} ?> name="featured" id="" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" <?php if($active == "Yes"){echo "checked";} ?> name="active" id="" value="Yes"> Yes
                        <input type="radio" <?php if($active == "No"){echo "checked";} ?> name="active" id="" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="hidden" name="current_image" value="<?=$current_image?>">
                        <input type="submit" class="btn-secondary" value="Update " name="submit">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $featured = $_POST['featured'];
                $current_image = $_POST['current_image'];
                $active = $_POST['active'];
                //update new image
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode(".",$image_name));
                        $image_name = "FoodCategory_".rand(000,999).".".$ext;
                        $source_path = $_FILES['image']['tmp_name'] ;

                        $destination_path = "../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);
                        if($upload == false){
                            $_SESSION['upload1'] = "Upload failed";
                            header("Location:".SITEURL."admin/manage-category.php");
                            die();
                        }
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            if($remove == false){
                                $_SESSION['remove1'] = "Remove failed";
                                header("Location:".SITEURL."admin/manage-category.php");
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $new_image = $current_image;
                }
                //update to database
                $sql2 = "UPDATE tbl_category SET title = '$title', featured = '$featured', active = '$active', image_name = '$image_name' where id = $id";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true){
                    $_SESSION['update'] = "Update successful";
                    header("Location:".SITEURL."admin/manage-category.php");
                }else{
                    $_SESSION['update'] = "Update failed";
                    header("Location:".SITEURL."admin/update-category.php");
                }
                // redirect to management
            }
        ?>
        </div>
    </div>

<?php include('./patials/footer.php'); ?>