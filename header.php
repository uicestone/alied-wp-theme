<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title><?php bloginfo('sitename'); ?></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>
	<header>
		<div class="logo">
			<a href="<?=site_url()?>"><img src="<?=get_stylesheet_directory_uri()?>/img/logo.png"></a>
		</div>
		<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'menu', 'container' => 'nav', 'container_class' => 'primary-navigation')); ?>
	</header>

