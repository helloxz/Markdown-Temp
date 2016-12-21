<?php
	session_start();
	//获取内容
	$content = $_POST['content'];
	//获取用户
	$user = $_SESSION['check'];
	if(isset($user)) {
		$myfile = fopen("./temp/".$user.'.md',"w");
		fwrite($myfile,$content);
		fclose($myfile);
		$redata = array("status" => "success","msg" => "保存成功");
		echo json_encode($redata);
	}
	else {
		$redata = array("status" => "failed","msg" => "保存失败");
		echo json_encode($redata);
	}
	
?>