<?php
include_once("config.php");
// 查询评论总数
$row = $link->query("select * from article");
var_dump($row);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>饭堂意见箱</title>
    	<link rel="icon" sizes="any" mask href="">
    	<link rel="stylesheet" type="text/css" href="css/qqZone.css">
</head>
<body>
    <div class="header">
        请输入你的评论
    </div>
    <div class="topInfo">
        <span class="edit">编辑</span>
    	<div class="zoneName">
    		<h2>广东科技学院饭堂</h2>
    		<p>让每个学生吃饱睡足！</p>
    	</div>
    	<div class="support">
    		<img src="image/support_1.png" alt="赞">
    		<span class="num">7</span>
    	</div>
    	<div class="tips">7人评论</div>
    	<!-- bottom nav -->
    	<div class="top_bottom">
    	   <div class="photo">
    	   	  <img src="">   
    	   </div>
    	      <div class="uploadphoto">修改头像</div>
    	   <div class="container">
    	   	  <ul class="section">
    			<!-- <li>留言处</li> -->
    		<!-- 	<li>日志</li>
    			<li>相册</li>
    			<li>留言板</li>
    			<li>说说</li>
    			<li>个人档</li>
    			<li>音乐</li>
    			<li>更多</li> -->
    		</ul>
    	   </div>
    	</div>
    </div>
    <!-- 下面实现留言板功能 -->
    <div class="mainframe">
    	<div class="title">留言板</div>
    	<div class="message">饭堂意见收集处</div>
    	<div class="info">
    		同学们，请发出你们的宝贵意见吧！
    	</div>
    	<div class="content" contenteditable="true"></div>
    	<input type="button" name="submit" value="发表" class="subbtn">
    	<div class="numofmessage">留言(0)</div>
    	<!-- 下面是留言区 -->
    	<div class="msgFrame">
    	    <div class="content_1">
    	         <img class="name" src="" alt="photo">
    	         <div class="mainInfo">
    		         <div class="userId"><a href="#">zipple</a></div>
    		         <div class="conInfo">
    				       这是一条留言。
    		            </div>
    		         <div class="time">2016-12-19  23:46:11</div>
    		    </div>

    	    </div>
         </div>
    </div>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
   $(".zoneName").hover(function(){
   	   $(".edit").show();
   },function(){
   	   $(".edit").delay(500).hide(0);//延时执行
   })
   //鼠标响应事件
   $(".support").mouseover(function(e){
   	   var left=e.pageX;
   	   var top=e.pageY;
   	   top=top-41;//这里是因为这个元素的父元素使用了margin-top属性，使得top值偏移了41像素。
   	   top=top+25;//加上鼠标自己的高度
   	   console.log(left+"px"+"   top:"+top)
   	   $(".tips").css({"left":left+"px","top":top+"px"});
   	   // $(".tips").delay(800).show(0);加了延时执行后会使得鼠标响应事件不灵敏
   	   // $(".tips").show("slow");
   	   $(".tips").fadeIn();
   })
   /*
    *鼠标离开事件，其中leave是指离开当前元素，而out包括其子元素
   */
   // $(".support").mouseout(function(){
   // 	   $(".tips").hide();
   // })
   $(".support").mouseleave(function(){
   	   console.log("leave");
   	   // $(".tips").css("display","none");
   	   // $(".tips").hide("slow");
   	    $(".tips").fadeOut();
   })
   //修改头像
   $(".photo").hover(function(){
   	   $(".uploadphoto").delay(800).show(0);
   },function(){
   	   $(".uploadphoto").hide();
   }) 
   $(".uploadphoto").hover(function(){
   	   if ($(this).is(":visible")) {
          console.log("visible")
   	   }
   	   else
   	   $(".uploadphoto").show();
   })
   //创建一个div
    function creatDiv(className,closeName,left,top){
          var div =$('<div style="left:' + left + 'px; top:' + top + 'px;"></div>');     
          div.addClass(className);
          $('body').append(div);
          left+=360;
          var close=$('<div style="left:' + left + 'px; top:' + top + 'px;"></div>'); 
          close.addClass(closeName);
          $('body').append(close);
      }     
   $(".uploadphoto").click(function(){
   	   var className='dialog';
   	   var closeName="close";
   	   console.log("点击上传");
   	   creatDiv(className,closeName,500,200);   
   	   $(".close").bind("click",function(){
   	   	      	  $(".dialog").remove();
   	              $(".close").remove();
   	              console.log("关闭成功");
   	              $(".uploadphoto").hide();
   	   });
   })
   //下面是错误的尝试，直接绑定一个函数名称可能导致该函数直接执行！
   // $(".close").bind("click",closeDialog());
   // function closeDialog(){
   // 	  $(".dialog").remove();
   // 	  $(".close").remove();
   // 	  console.log("关闭");
   // }


   //接下来使用数据库储存留言数据
   var count=0;
   $(".subbtn").click(function(){
   	 var text= $(".content").text();
   	 var time=getCurrentTime();
   	 if(text==""){
   	 	alert("您还没有输入任何内容！");
   	 }
   	 else{
   	 	loadmessage(text,'zipple',time);
   	 	count++;
   	 	console.log('success!');
   	 	$(".content").text("");
   	 	$(".numofmessage").text("留言("+count+")");
   	 }
   })
   function loadmessage(message,id,time){
      	//创建content_index
      	//包含img.name + mainInfo
      	//.userId .conInfo .time
      	var contentDiv='<div class="content_1">';
      	   contentDiv+='<img class="name" src="http://qlogo3.store.qq.com/qzone/1262283870/1262283870/100?1481718124" alt="photo">';
      	   contentDiv+='<div class="mainInfo">'
      	   contentDiv+=' <div class="userId"><a href="#">';
      	   contentDiv+=id;
      	   contentDiv+='</a></div> <div class="conInfo">';
      	   contentDiv+=message;
      	   contentDiv+='</div> <div class="time">';
      	   contentDiv+=time;
      	   contentDiv+='</div> </div> </div>'
           $(".msgFrame").prepend(contentDiv);
   }
   function getCurrentTime(){
   	   var today=new Date();
   	   var y=today.getFullYear();
   	   var mh=today.getMonth();
   	   mh++;
   	   var d=today.getDate();
   	   var h=today.getHours();
   	   var m=today.getMinutes();
   	   var s=today.getSeconds();
   	   m=checkTime(m)
       s=checkTime(s)
       var time=y+"-"+mh+"-"+d+"  "+h+":"+m+":"+s;
       return time;
   }
   function checkTime(i){
       if(i<10)
         i="0"+i
       return i
    }

</script>
</html>