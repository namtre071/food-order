<?php include('./patials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add category</h1>
            <br><br>
            <?php
                if(isset($_SESSION['add1'])){
                    echo $_SESSION['add1'];
                    unset($_SESSION['add1']);
                }
                if(isset($_SESSION['upload1'])){
                    echo $_SESSION['upload1'];
                    unset($_SESSION['upload1']);
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured :</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="no">No

                        </td>
                    </tr>
                    <tr>
                        <td>Image :</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Active :</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn-secondary" name="submit" value="Submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['submit']) ){
            $title = $_POST['title'];
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else{
                $featured = "No";
            }
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = "No";
            }
            //check if image is already
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];
                //autoramame
                if($image_name != ""){
                    $ext = end(explode(".",$image_name));
                    $image_name = "FoodCategory_".rand(000,999).".".$ext;
                    $source_path = $_FILES['image']['tmp_name'] ;

                    $destination_path = "../images/category/".$image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);
                    if($upload == false){
                        $_SESSION['upload1'] = "Upload failed";
                        header("Location:".SITEURL."admin/add-category.php");
                        die();
                    }
                }

            }
            else{
                $image_name = "";
            }
            $sql = "insert into tbl_category set title='$title',featured='$featured',active='$active',image_name='$image_name'";
            $res = mysqli_query($conn, $sql);
            if($res== true){
                $_SESSION['add1']= "Added successfully"; 
                header("location:".SITEURL."admin/manage-category.php");
            }
            else{
                $_SESSION['add1']= "Something went wrong"; 
                header("location:".SITEURL."admin/add-category.php");
            }
        }
    ?>
<?php include('./patials/footer.php'); ?>