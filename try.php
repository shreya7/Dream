<?php 
include('db.php');
session_start();
{
    $user=mysql_real_escape_string($_POST['UserName']);
    $pass=mysql_real_escape_string($_POST['Password']);
    $fetch=mysql_query("SELECT UserId FROM `login_master` WHERE 
                         UserName='$user' and Password='$pass'");
    $count=mysql_num_rows($fetch);
    if($count!="")
    {
    session_register("sessionusername");
    $_SESSION['login_username']=$user;
    header("Location:profile.php"); 
    }
    else
    {
       header('Location:index.php');
    }

}
?>