<?php include('./patials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>ADD ADMIN</h1>
            <br>
            <form action="" method= "post">
                <table class ="tbl-30">
                    <tr>
                        <td>Full Name :</td>
                        <td><input type="text" placeholder="Enter Your Name" name = "full_name"></td>
                    </tr>
                    <tr>
                        <td>UserName :</td>
                        <td><input type="text" placeholder="Enter Your UserName" name = "username"></td>
                    </tr>
                    <tr>
                        <td>Full Name :</td>
                        <td><input type="password" placeholder="Enter Your Password" name = "password"></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Add" name="submit" class = "btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        //sql query to save data to database
        $sql =  "insert into tbl_admin set 
        full_name = '$full_name',
        username = '$username',
        password = '$password'";
        //excute sql query
        
        $res = mysqli_query($conn, $sql) or die(mysql_error($conn));
        //check
        if($res== true){
            //create session
            $_SESSION['add']= "Admin added successfully";
            header("Location:".SITEURL.'admin/manager-admin.php');
        }
        else{
            $_SESSION['add']= "Admin added failed";
            header("Location:".SITEURL.'admin/manager-admin.php');
        }
    }
?>
<?php include('./patials/footer.php'); ?>
<!-- lấy dữ liệu từ form lưu vào database -->
