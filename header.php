<!DOCTYPE html>
<html id="webliu" lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta name="applicable-device" content="pc,mobile"/>
	<?php include('includes/seo.php'); ?>
	<meta name="apple-mobile-web-app-title" content="<?php echo get_bloginfo('name') ?>">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/reset.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="//at.alicdn.com/t/font_653527_i8u4s9qyo7nqxgvi.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/animate.min.css" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/webliu.css">
	<link href="<?php echo get_stylesheet_directory_uri() ?>/css/prism.css" rel="stylesheet">
	<?php wp_head(); ?>
	<?php if ( is_home() ) { ?><?php echo '<style>::-webkit-scrollbar {width: 0px;}</style>' ?><?php } ?>
</head>
<body class="notindex">
	<!-- header -->
	<div class="header">
		<div class="container">
			<section class="logo">
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" style="background-image: url(<?php echo webliu_option('site_logo'); ?>;)" class="logopng"></a>
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" style="background-image: url(<?php echo webliu_option('site_logo1'); ?>;)" class="logogif hide"></a>
			</section>
			<section class="search_show">
				<a href="javascript:;" class="">
					<i class="fa fa-search" data-toggle="tooltip" title="搜索"></i>
				</a>
			</section>
			<section class="site_nav">
				<ul>
					<?php wp_nav_menu(array('theme_location'=>'header-menu','menu' => 'hedaer-menu','container' => false,'items_wrap' => '%3$s',)); ?>
				</ul>
			</section>
			<section id="mobile_nav" class="mobile_nav">
				<span class="menu_top"></span>
				<span class="menu_bottom"></span>
			</section>
		</div>
	</div>
	<!-- 顶部head结束 -->
