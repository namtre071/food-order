<?php include('patials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br>
            <?php
                //get id
                $id = $_GET['id'];
                $query = "SELECT * FROM tbl_admin WHERE id = '$id'";
                $res = mysqli_query($conn, $query);
                if($res == true)
                {
                    $count =mysqli_num_rows($res);
                    if($count == 1){
                        $row = mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else
                    {
                        header("Location:".SITEURL."/admin/manager-admin.php");
                    }
                }
            ?>
            <form action="" method= "post">
                <table class="tbl-30">
                    <tr>
                        <td>Full name</td>
                        <td>
                            <input type="text" name="full_name" value="<?=$full_name?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" value="<?=$username?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan = "2">
                            <input type="hidden" name="id" value = <?=$id?>>
                            <input type="submit" name="submit" value="Update">
                        </td>
                    </tr>
                </table>

            </form>
        </div>
    </div>

<?php
    // check if buttons clicked or not
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "update tbl_admin set username='$username' , full_name='$full_name' where id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == true){
            $_SESSION['update']= "Update successful";
            header("Location:".SITEURL."/admin/manager-admin.php");
        }
        else{
            $_SESSION['update']= "Update failed";
            header("Location:".SITEURL."/admin/manager-admin.php");
        }
    }
?>

<?php include('patials/footer.php') ?>