<?php
    include('./config/constants.php');
    // 1 lấy id admin cần xoá
    $id = $_GET['id'];

    // 2 create a new sql to delete admin
    $sql = "delete from tbl_admin where id = $id";
    // excute the sql
    $res = mysqli_query($conn, $sql);
    //check if the
    if($res == true){
        //echo "Xóa thành công";
        //create a new session 
        $_SESSION['delete']= "Admin deleted successfully";
        header('location: '.SITEURL.'/admin/manager-admin.php');

    }
    else{
        //echo "Xóa thất bại";
        $_SESSION['delete']= "Admin not deleted";
        header('location: '.SITEURL.'/admin/manager-admin.php');
    }
    // 3 redirect to admin

?>
