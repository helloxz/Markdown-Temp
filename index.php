<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	session_start();
	$id = $_GET['id'];
	//时间 + 随机数生成ID
	$current = date('YmdHi',time()).rand(1000,9999);
	//MD5加密
	$current = substr(md5($current),8,16);
	
	$del = $_GET['del'];

	//删除SESSION
	if($del == 'session') {
		session_destroy();
	}
	//不存在cookie
	if(!isset($_SESSION['check'])) {
		//生成session
		$_SESSION['check'] = $current;
		//setcookie("user", $current, time()+600);
		//$user = $_COOKIE['user'];
		$user = $_SESSION['check'];
		
		
		echo "<script>window.location.href = './index.php?id=$user';</script>";
		//echo "<script>window.location.href = './index.php?id=$_COOKIE[\"user\"]';</script>";
	}
	//存在cookie
	else {
		
		if($id == $_SESSION['check']) {
			$idcontent = file_get_contents("./temp/".$id.".md");
			if ($idcontent == '') {
				$myfile = fopen("./temp/".$id.".md","w");
				fwrite($myfile,$idcontent);
				fclose($myfile);
			}
		}
		else {
			$user = $_SESSION['check'];
			echo "<script>window.location.href = './index.php?id=$user';</script>";
		}
	}
	//echo $_COOKIE['user'].'dsd';
	//echo $_SESSION['check'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>Markdown Temp - 您的在线临时文档</title>
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
		<a href="javascript:;" id = "save" onclick = "return savemd();">保存</a>
		<a href="./preview.php?id=<?php echo $id; ?>" target = "_blank">预览</a>
		<a href="./index.php?del=session">再写一篇</a>
		<a href="./preview.php?id=<?php echo $id; ?>" download target = "_blank">导出HTML</a>
		<a href="./temp/<?php echo $id; ?>.md" target = "_blank" download>导出.md</a>
	</div>
	<div id = "msg" style = "color:green;text-align:center;margin-top:30px;"></div>
	<!--网站底部-->
	<div id = "footer">©2016 Powered by <a href = "http://markdown.win/" target = "_blank">Markdown-Temp</a> | <a href = "https://github.com/helloxz/Markdown-Temp" rel = "nofollow" target = "_blank">源码下载 | <a href = "http://markdown.win/readme.htm" target = "_blank">使用说明</a> | <a href = "https://www.xiaoz.me" target = "_blank">小z博客</a></div>
    <script type="text/javascript">
	//    调用编辑器
	var myEditor;
	$(function() {
	    myEditor = editormd("hi-editormd", {
	        width   : "1200px",
	        height  : 674,
	        syncScrolling : "single",
	        path    : "./editor/lib/"
	    });
	});
	</script>
	<script>
		$(document).ready(function() {
			setInterval("savemd()",30000);
		});
		function savemd() {
			var content = $("#mdtxt").val();
			$.post("./save.php",{content:content},function(data,status){
				var myDate = new Date();
				var mytime=myDate.toLocaleTimeString();
				//$("#msg").text("保存成功" + mytime);
				var reinfo = new Function("return" + data)();
				if(reinfo['status'] == 'success') {
					$("#msg").text("保存成功" + mytime);
				}
				else {
					$("#msg").text("保存失败！");
				}
			});
		}
	</script>
</body>
</html>
