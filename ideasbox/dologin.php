<?php
    include_once("config.php");
    $username=$_POST['username'];/*获取登录表单提交过来的数据*/
    $password=$_POST['password'];
    
    $result=$link->query("select * from `user` where username='$username' and password='$password'");

    $row = $result->fetch_assoc();/*读取从数据库获取的数据*/
    if ($row) {/*如果数据存在，即用户登录成功*/
        echo "<script>alert('用户登录成功!')</script>";
        $_SESSION['username'] = $row['username'];
        $_SESSION['uid'] = $row['uid'];
        echo '页面跳转中...';
        header("refresh:1;url=index.php");
    }else{/*用户名或密码错误*/
        echo "<script>alert('用户名或密码错误!')</script>";
        link_login();
    }
?>