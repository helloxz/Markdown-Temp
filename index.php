<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	$id = $_GET['id'];
	
	//不存在cookie
	if(!isset($_COOKIE['user'])) {
		$current = date('YmdHi',time());
		setcookie("user", $current, time()+600);
		$user = $_COOKIE['user'];
		echo 'dsdsd';
		
		echo "<script>window.location.href = './index.php?id=$user';</script>";
		//echo "<script>window.location.href = './index.php?id=$_COOKIE[\"user\"]';</script>";
	}
	//存在cookie
	else {
		
		if($id == $_COOKIE['user']) {
			$idcontent = file_get_contents("./temp/".$id.".md");
			if ($idcontent == '') {
				$myfile = fopen("./temp/".$id.".md","w");
				fwrite($myfile,$idcontent);
				fclose($myfile);
			}
		}
		else {
			$user = $_COOKIE['user'];
			echo "<script>window.location.href = './index.php?id=$user';</script>";
		}
	}
	//echo $_COOKIE['user'].'dsd';
	
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>New Document</title>
	<meta name="generator" content="EverEdit" />
	<meta name="author" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="./editor/css/editormd.css" />
	<link rel="stylesheet" href="./css/style.css">
	<script src = "https://libs.bsdev.cn/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script src = "./editor/editormd.min.js"></script>
</head>
<body>
	<div class="editormd" id="hi-editormd">
		<textarea class = "editormd-markdown-textarea" name="editormd-markdown-textareat" id = "mdtxt"><?php echo $idcontent; ?></textarea>
		<textarea class = "editormd-html-textarea" name="editormd-html-textarea"></textarea>
	</div>
	<div id = "btn">
		<a href="javascript:;" id = "save">保存</a>
		<a href="./preview.php?user=<?php echo $id; ?>" target = "_blank">预览</a>
	</div>
	<div id = "msg" style = "color:green;text-align:center;margin-top:30px;"></div>
    <script type="text/javascript">
	//    调用编辑器
	var myEditor;
	$(function() {
	    myEditor = editormd("hi-editormd", {
	        width   : "1200px",
	        height  : 720,
	        syncScrolling : "single",
	        path    : "./editor/lib/"
	    });
	});
	</script>
	<script>
		$(document).ready(function() {
			$("#save").click(function() {
				var content = $("#mdtxt").val();
				$.post("./save.php",{content:content},function(data,status){
					var myDate = new Date();
					var mytime=myDate.toLocaleTimeString();
					$("#msg").text("保存成功" + mytime);
				});
			});
		});
	</script>
</body>
</html>
