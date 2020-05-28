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
			<a href="<?=site_url()?>"><img src="<?=get_stylesheet_directory_uri()?>/img/logo-bwr.png"></a>
		</div>
		<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'menu', 'container' => 'nav', 'container_class' => 'primary-navigation')); ?>
		<div class="nav-tools">
			<a href="#" class="nav-tool-icon toggle-search-bar"><img src="<?=get_stylesheet_directory_uri()?>/img/search.png"></a>
			<?php if ( WC()->cart->get_cart_contents_count() == 0 ): ?>
			<a href="<?=wc_get_cart_url()?>" class="nav-tool-icon"><img src="<?=get_stylesheet_directory_uri()?>/img/cart.png"></a>
			<?php else: ?>
			<a href="<?=wc_get_cart_url()?>" class="nav-tool-icon"><img src="<?=get_stylesheet_directory_uri()?>/img/cart-full.png"></a>
			<?php endif; ?>
		</div>
		<div class="search-bar" style="display:none">
			<span class="icon"><img src="<?=get_stylesheet_directory_uri()?>/img/search.png"></span>
			<form action="<?=site_url('shop/')?>"><input type="search" name="s" placeholder="SEARCH..."></form>
			<a href="#" class="icon toggle-search-bar"><img src="<?=get_stylesheet_directory_uri()?>/img/close.png"></a>
		</div>
	</header>

