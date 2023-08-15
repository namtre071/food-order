<?php include('./patials/menu.php'); ?>
    <!-- end header -->

    <!-- content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>
                <br>
                <a href="./add-food.php"class="btn-primary">Add Food</a>
                <br>
                <br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_food";
                        $result = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($result);
                        if ($count>0){
                            while ($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $description = $row['description'];
                                $image = $row['image_name'];
                                $active = $row['active'];
                                $featured = $row['featured'];?>
                            
                            <tr>
                                <td><?=$id?></td>
                                <td><?=$title?></td>
                                <td><?=$price?></td>
                                <td><?=$description?></td>
                                <td>
                                    <?php
                                        if($image == ""){
                                            echo "Image not found";
                                        }else{?>
                                            <img src="../images/food/<?=$image?>" width="200" alt="">
                                      <?php  }
                                    ?>
                                </td>
                                <td><?=$active?></td>
                                <td><?=$featured?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Edit</a>
                                    <a href="#"class="btn-danger">Delete</a>
                                </td>
                            </tr>
                       <?php }  }else{

                        }
                    ?>
                    
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
    <!-- end content -->
    <!-- footer -->
        <?php include('./patials/footer.php'); ?>