<!DOCTYPE HTML>
<html>
<head>
<title>404 error page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="<?php echo ASSET; ?>error/css/errorstyle.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<!---start-wrap -->
	<div class="wrap">
		<!--start-content -->
		<div class="content">
			<!-- start-logo -->
			<div class="logo">
				<h1><a href="#"><img src="<?php echo ASSET; ?>error/images/logo.png"/></a></h1>
				<span><img src="<?php echo ASSET; ?>error/images/signal.png"/>Oops! The Page you requested was not found!</span>
			</div>
			
			<div class="buttom">
				<div class="seach_bar">
					<p>Go back to <span><a href="<?php echo URL; ?>home/">HOME</a></span> page or search here</p>
		
					<div class="search_box">
					<form>
					   <input type="text" value="The Page No Avaliable" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
				    </form>
					 </div>
				</div>
			</div>

		</div>

	<p class="copy_right">&#169; 2014 Template by<a href="http://pomosda.or.id" target="_blank">&nbsp;ICT-POMOSDA</a> </p>
	</div>
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
</body>
</html>
