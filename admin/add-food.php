<?php include('./patials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Description : </td>
                    <td><textarea name="description" col="30" row="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price : </td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>
                    <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category" id="">
                        <?php
                        $sql = "Select * from tbl_category where active = 'Yes'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                ?><option value="<?=$id?>"><?=$title?></option>
                                <?php
                            }
                        }else{
                            ?>
                            <option value="1">No Category Found</option>
                            <?php
                        }
                    ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" id="" value="Yes"> Yes
                        <input type="radio" name="featured" id="" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" id="" value="Yes"> Yes
                        <input type="radio" name="active" id="" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan = "2">
                        <input class="btn-primary" type="submit" name="submit" value="Add Food">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }
                //check image
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food-".rand(0000,9999).'.'.$ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);
                        if($upload == false){
                            $_SESSION['upload'] = "failed  to upload image";
                            header("Location:".SITEURL."admin/add-food.php");
                            die();
                        }
                    }
                }else{
                    $image_name = "";
                }
                $sql2 = "INSERT INTO tbl_food SET title = '$title', 
                description = '$description', 
                image_name = '$image_name',
                price = '$price', 
                category_id = '$category', 
                featured = '$featured', 
                active = '$active'";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true){
                    $_SESSION['add']= "Add food successfully";
                    header("Location:".SITEURL."admin/manage-food.php");
                }else{
                    $_SESSION['add']= "Add food failed";
                    header("Location:".SITEURL."admin/manage-food.php");
                }
            }
        ?>
    </div>
</div>
<?php include('./patials/footer.php'); ?>