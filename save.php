<?php
	
	//获取内容
	$content = $_POST['content'];
	//获取用户
	$user = $_COOKIE['user'];
	
	$myfile = fopen("./temp/".$user.'.md',"w");
	fwrite($myfile,$content);
	fclose($myfile);
	echo 'ok';
?>