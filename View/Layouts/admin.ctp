<!DOCTYPE HTML>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo __('Fuck Love: Ruin someone\'s happiness for your own.') ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="/images/fave-icon.png" />
   		<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
   		<link href="/css/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<script src="/js/modernizr.custom.28468.js"></script>
		<link rel="stylesheet" type="text/css" href="/css/simptip-mini.css" media="screen,projection" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
	</head>
	<body>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
	</body>
</html>

