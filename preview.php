<?php
	include_once( './Parsedown.php' );
	$user = $_GET['user'];
	$content = file_get_contents("./temp/".$user.".md");
	$Parsedown = new Parsedown();
	//echo $Parsedown->text($content);
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
	<link rel="stylesheet" href="https://libs.bsdev.cn/highlight.js/9.8.0/styles/github.css">
	<link rel="stylesheet" href="https://libs.bsdev.cn/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">
	<script src = "https://libs.bsdev.cn/highlight.js/9.8.0/highlight.pack.js"></script>
	<script src = "https://libs.bsdev.cn/jquery/2.0.3/jquery-2.0.3.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-md-offset-1">
				<?php echo $Parsedown->text($content); ?>
				<!--<pre><code class="markdown">
					<?php echo $Parsedown->text($content); ?>
				</code></pre>-->
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$(".markdown img").addClass("img-responsive");
		});
	</script>
</body>
</html>

