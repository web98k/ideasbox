<?php
	session_start();
	session_destroy();
	echo '页面跳转中...';
	header("refresh:0.5;url=index.php");

?>