<!DOCTYPE HTML>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>Fuck Love: Ruin someone's happiness for your own.</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="/images/fave-icon.png" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
   		<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
   		<link href="/css/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<script src="/js/modernizr.custom.28468.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/simptip-mini.css" media="screen,projection" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	</head>
	<body>
		<!---start-wrap----->
			<!---start-header----->
			<div class="header" id="home">
				<div class="wrap">
				<div class="top-header">
					<div class="logo">
						<a href="index.html">Fuck Love</a>
					</div>
					<div class="top-nav">
						<ul>
							<li class="active"><a href="#home" class="scroll">Home</a></li>
							<li><a href="#what" class="scroll">What?</a></li>
							<li><a href="#why" class="scroll">Why?</a></li>
							<li><a href="#how" class="scroll">How?</a></li>							
							<li><a href="#signup" class="scroll">Buy Now!</a></li>							
							<div class="clear"> </div>
						</ul>
					</div>
					<div class="clear"> </div>
				</div>
			<!---End-header----->
			</div>
		</div>
		<div class="header-footer"><div class="img"><img src="/images/logo-head.png" /></div></div>
		<!---End-header----->
		<!---start-content---->
		<div class="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
			<!---End-contact---->
		</div>
		<!---End-content---->
		<!----start-footer---->
		<div class="footer">
			<div class="wrap">
				<div class="footer-grids">
					<div class="footer-left">
						<ul>
							<li><a class="ftwiter" href="https://twitter.com/fuckloveparis" target="_blank"> </a></li>
							<a href="https://plus.google.com/118275350827749726838" rel="publisher"></a>
							<div class="clear"> </div>
						</ul>
					</div>
					<div class="footer-right">
						<p>Send us some <a href="mailto:support@fucklove.paris">hate mail</a></p>
									<script type="text/javascript">
						$(document).ready(function() {
							$().UItoTop({ easingType: 'easeOutQuart' });
						});
					</script>
					<!----move-top-path---->
					<script type="text/javascript" src="/js/move-top.js"></script>
					<script type="text/javascript" src="/js/easing.js"></script>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$(".scroll").click(function(event){		
								event.preventDefault();
								$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
							});
							
							$(".badge-div").click(function(event){		
								$("#badge-comment").text($(this).find("img:first").attr('alt'));
							});
						});
					</script>
					<!----move-top-path---->
			    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

					</div>
					<div class="clear"> </div>
				</div>
			</div>
		</div>
		<!----//End-footer---->
		<!---End-wrap----->
	</body>
</html>

