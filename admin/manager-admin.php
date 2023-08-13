<?php include('./patials/menu.php'); ?>
    <!-- end header -->

    <!-- content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASBOARD</h1>
                <br>
                <a href="add-admin.php"class="btn-primary">Add Admin</a>
                <br>
                <br>
                <br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['change_password'])){
                        echo $_SESSION['change_password'];
                        unset($_SESSION['change_password']);
                    }
                    if(isset($_SESSION['unmatch-password'])){
                        echo $_SESSION['unmatch-password'];
                        unset($_SESSION['unmatch-password']);
                    }
                ?>
                <br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $result = mysqli_query($conn,$sql);
                        if($result == TRUE){
                            $count = mysqli_num_rows($result);
                            if($count > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $id= $row['id'];
                                    $full_name = $row['full_name'];
                                    $username = $row['username'];?>
                                    
                                    <tr>
                                    <td><?=$id?></td>
                                    <td><?=$full_name?></td>
                                    <td><?=$username?></td>
                                    <td>
                                        <a href="<?php echo SITEURL?>admin/update-password.php?id=<?=$id?>" class="btn-primary">Change pass</a>
                                        <a href="<?php echo SITEURL?>admin/update-admin.php?id=<?=$id?>" class="btn-secondary">Edit</a>
                                        <a href="<?php echo SITEURL?>admin/delete-admin.php?id=<?=$id?>"class="btn-danger">Delete</a>
                                    </td>
                                </tr>
                               <?php }}}  ?>
                            
                            
                        
                    
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    <!-- end content -->
    <!-- footer -->
        <?php include('./patials/footer.php'); ?>