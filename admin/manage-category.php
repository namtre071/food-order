<?php include('./patials/menu.php'); ?>
    <!-- end header -->

    <!-- content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>
                <br>
                <a href="add-category.php"class="btn-primary">Add Category</a>
                <br><br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                ?>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_category ";
                        $res = mysqli_query($conn, $sql);
                        $count  = mysqli_num_rows($res);
                        if($count >0 )
                        {
                            while($row = mysqli_fetch_array($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $image = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];?>
                            <tr>
                                <td><?=$id ?></td>
                                <td><?=$title ?></td>
                                <td>
                                    <?php
                                        if($image != ""){?>
                                            <img src="<?php echo SITEURL;?>images/category/<?=$image?>" width="200" >
                                        <?php }
                                       else{
                                            echo "Image not found";
                                         }
                                    ?>
                                </td>
                                <td><?=$featured ?></td>
                                <td><?=$active ?></td>
                                <td>
                                    <a href="<?php echo SITEURL?>admin/update-admin.php?id=<?=$id?>" class="btn-secondary">Edit</a>
                                    <a href="<?php echo SITEURL?>admin/delete-category.php?id=<?=$id?>&image_name=<?=$image?>"class="btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php }
                        }
                    ?>
                    
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
    <!-- end content -->
    <!-- footer -->
        <?php include('./patials/footer.php'); ?>