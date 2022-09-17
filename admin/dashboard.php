<?php if(!isset($_SESSION)){session_start();}
include('config.php');
include('functuins.php');

if (!isset($_SESSION['admin_role'])){
    if(isset($_POST['username'])&& isset($_POST['password'])){
        $username = input_secure($_POST['username']);
        $password = input_secure($_POST['password']);

        $ency_password = sha1(md5($password));

        $sql_stmnt = "SELECT * from  taheleltech where username ='".$username."'and password ='".$ency_password."'and pvalid ='1'";
        $result = mysqli_query($conn,$sql_stmnt);
        $users_num = mysqli_num_rows($result);

            if($users_num >0){
                $_SESSION['admin_role']=1;
                ?>

                    <script language="javascript">window.location.href="dashboard.php";</script>

                <?php

            } else{
            ?>

            <script language="javascript">window.location.href="index.php?error_msg=1";</script>
            <?php
            }
    }else{
        ?>

        <script language="javascript">window.location.href="index.php?error_msg=1";</script>
        <?php
        }

}else{


$breadcrumb_array = array(
    "لوحة التحكم");
 include('header.php'); 
?>
<!--begin::Dashboard-->
Welcome
<!--end::Dashboard-->
<?php 
$widget_page = true;
include('footer.php'); 
}
?>