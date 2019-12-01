<?php
	include_once ("./config.php");
	$username=$_POST['username'];//获取表单提交的数据
	$password=$_POST['password'];
	$confirm=$_POST['confirm'];
	$phone = $_POST['phone'];	
	if($username == '' || $password == '' || $confirm == ''|| $phone == ''){
		echo "<script>alert('选项不许为空')</script>";
		link_reg();
	}
	// 先判断正则表达式
	$pattern_ph = '/^1[34578]\d{9}$/';
	if(!preg_match($pattern_ph,$phone)){
		echo "<script>alert('手机号码不符合要求！')</script>";
		link_reg();
	}elseif($confirm!=$password){
		echo "<script>alert('两次密码不一样')</script>";
		link_reg();
	}
	// 判断是否有此用户
	$row = $link->query("select * from `user` where username='$username'");
	$result = $row->fetch_all();
	if($result){
		echo "<script>alert('此用户已存在')</script>";
		link_reg();
	}else{
	 	$row=$link->query("insert into `user`( `username`, `password`,`phone`) values('$username','$password','$phone')");
	 	if($row){
	 		echo '注册成功...';
			link_login();
	 	}else{
			echo '注册失败...';
			link_reg();
	 	}
	}
?>