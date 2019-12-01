<!-- <?php
  @include_once("config.php");
  @$res = $link->query("select * from article as a,user as u where a.uid = u.uid");
  // 统计评论条数
  @$count = $res->num_rows;
 
?> -->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>意见收集处</title>
    	<link rel="icon" sizes="any" mask href="../image/Qzone.svg">
    	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
    <div class="header">
        广东科技学院
    </div>
    <div class="topInfo">
        <!-- <span class="edit">编辑</span> -->
    	<div class="zoneName">
    		<h2>意见收集处</h2>
    		<p>广东科技学院饭堂意见收集处。</p>
    	</div>
    	<div class="support">
    		<img src="image/support_1.png" alt="赞">
    		<span class="num"></span>
    	</div>
    	<!-- bottom nav -->
    	<div class="top_bottom">
    	   <div class="photo">
    	   	  <img src="image/timg.jpeg">   
    	   </div>
    	   <div class="container">
           <?php
    	   	  echo '<ul class="section">';
             
                if(isset($_SESSION['username'])){
                  echo '<li>'.$_SESSION['username'].'</li>';
                  echo '<li><a href="unlink.php">退出登录</a></li>';
                }else{
                  echo '<li><a href="login.html">登录</a></li>';
                  echo '<li><a href="reg.html">注册</a></li>';
                }
             
    		    echo '</ul>';
            ?>
    	   </div>
    	</div>
    </div>
    <!-- 下面实现留言板功能 -->
    <div class="mainframe">
    	<!-- <div class="title">留言板</div> -->
    	<div class="message">饭堂公告</div>
    	<div class="info">
    		刚开通饭堂，请同学们踊跃发言！
    	</div>
      <form action="doart.php" method="post">
      	<div class="content" contenteditable="true" name="content">
         <textarea type="text" name="content" rows="6" cols="110">
           
         </textarea>

        </div>
      	<input type="submit" name="" value="发表" class="subbtn">
      </form>
    	<div class="numofmessage">留言(<?php echo $count; ?>)</div>
    	<!-- 下面是留言区 -->
    	<div class="msgFrame">
        <!-- 开始遍历-->
        <?php
          // 获取结果 
          $data = $res -> fetch_all();
          foreach($data as $k => $v){
            echo '<div class="content_1">';
            echo '<img class="name" src="image/header.jpg" alt="photo">';
            echo     '<div class="mainInfo">';
            echo       '<div class="userId">'.$v[5].'</div>';
            echo       '<div class="conInfo">';
            echo        $v[2];
            echo          '</div>';
            echo       '<div class="time">'.@date('Y-m-d H:i:s',$v[2]).'</div></div>';
            echo  '</div>';
          }
        ?>
        <!-- 遍历结束 -->
    	</div>
    </div>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
</script>
</html>