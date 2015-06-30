<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $description; ?>" />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<meta name="author" content="<?php echo $author; ?>" />
		<link rel="icon" type="image/png" href="<?php echo HTTP_PWD_IMG; ?>favicon.ico" />

		<!-- CSS  -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo HTTP_PWD_CSS; ?>animate.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo HTTP_PWD_CSS; ?>style.css" />
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,600,500,800,900,700' rel='stylesheet' type='text/css'>
		<link href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel='stylesheet' type='text/css'>

		<!-- JS  -->
		<script type="text/javascript" src="<?php echo $this->generateUrl('phptojs'); ?>"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo HTTP_PWD_JS; ?>custom.js"></script>
		
	</head>
	<body id="<?php secho($bodyId); ?>">
