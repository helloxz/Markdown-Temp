<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	include_once( './Parsedown.php' );
	$id = $_GET['id'];
	//文件名称
	$mdname = "./temp/$id.md";
	//获取文件大小
	$mdsize = filesize($mdname);
	
	//打开一个markdown文档
	$fpmd = fopen($mdname,"r");
	//读取整个文档并赋值
	$content = fread($fpmd,$mdsize);
	//文件不存在
	if(!$fpmd) {
		//返回404状态
		header('HTTP/1.1 404 Not Found'); 
		header("status: 404 Not Found"); 
		//读取404页面
		$error404 = file_get_contents("./404.html");
		echo $error404;
		exit;
	}
	//文件为空
	if($content == "") {
		$content = "<h3>空空如也</h3>";
	}
	//关闭fclose
	fclose($fpmd);
	
	//初始化Parsedown
	$Parsedown = new Parsedown();
	
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>Markdown Temp预览</title>
	<meta name="generator" content="EverEdit" />
	<meta name="author" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://libs.bsdev.cn/highlight.js/9.8.0/styles/github.css">
	<link rel="stylesheet" href="https://libs.bsdev.cn/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src = "https://libs.bsdev.cn/highlight.js/9.8.0/highlight.pack.js"></script>
	<script src = "https://libs.bsdev.cn/jquery/2.0.3/jquery-2.0.3.min.js"></script>
	<style type = "text/css">
		body {
			font-family:"Microsoft YaHei";
		}
		h1, .h1, h2, .h2, h3, .h3 {
		    margin-bottom: 22px;
		    margin-top: 22px;
		}
		img {display:block;}
		p {
		    margin: 0 0 10px;
		    line-height: 24px;
		    margin-bottom:20px;
		}
		li {
			padding-bottom:5px;
		}
		blockquote p {
			font-size:16px;
		}
		.row {
			/*border:1px solid #ccc;*/
			margin-top:24px;
			margin-bottom:40px;
		}
		#footer {
			width:100%;
			font-size:12px;
			text-align:center;
			/*background-color: #575757;*/
			color:#737373;
			line-height:32px;
			position:fixed;
			bottom:0;
		}
		#footer a {
			text-decoration:none;
			color:#919191;
		}
		li pre {
		    margin-top: 8px;
		}  
	</style>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-md-offset-1">
				<div class = "htmlcontent"><?php echo $Parsedown->text($content); ?></div>
			</div>
		</div>
	</div>
	<!--网站底部-->
	<div id = "footer">©2016 Powered by <a href = "http://markdown.win/" target = "_blank">Markdown-Temp</a> | <a href = "https://github.com/helloxz/Markdown-Temp" rel = "nofollow" target = "_blank">源码下载 | <a href = "http://markdown.win/readme.htm" target = "_blank">使用说明</a> | <a href = "https://www.xiaoz.me" target = "_blank">小z博客</a></div>
	<!--图片自适应-->
	<script>
		$(document).ready(function(){
			$(".container img").addClass("img-responsive");
			//通过获取第一个H1标签来生成标题
			var mytitle = $(".htmlcontent h1").eq(0).text();
			//改变文档标题
			$("title").text(mytitle + " - Markdown Temp预览");
		});
	</script>
</body>
</html>