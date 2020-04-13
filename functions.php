<?php
/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
	// wp_dequeue_style('storefront-style');
	// wp_dequeue_style('storefront-woocommerce-style');
	wp_dequeue_style('storefront-child-style');
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */

show_admin_bar(false);

add_action('wp', function() {
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css', array(), time());
	wp_register_script('script', get_stylesheet_directory_uri() . '/script.js', array(), time());
});

add_action('wp_enqueue_scripts', function(){
	sf_child_theme_dequeue_style();
	wp_enqueue_style('style');
	wp_enqueue_script('script');
}, 40);

add_action('after_setup_theme', function () {
	register_nav_menu('primary', '主导航');
	add_theme_support('post-thumbnails');
	// add_image_size('headline', 1600, 700, true);
	// add_image_size('post-thumbnail', 1280, 720, true);
});
