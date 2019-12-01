<?php
	include_once("config.php");
	$time = time();
	$con = $_POST['content'];
	@$uid = $_SESSION['uid'];
	$res =$link ->query("insert into article(content,uid,time) values($con,$uid,$time)");
	if($res){
		echo "<script>alert('留言成功!')</script>";
        echo '页面跳转中...';
        header("refresh:1;url=index.php");
	}else{
		echo "<script>alert('留言失败!请检查是否登录')</script>";
        echo '页面跳转中...';
		header("refresh:1;url=index.php");

	}
?>