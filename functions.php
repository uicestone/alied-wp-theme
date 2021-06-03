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

add_post_type_support('product', 'wps_subtitle');

add_action('wp', function() {
	wp_register_style('alied-style', get_stylesheet_directory_uri() . '/style.css', array(), time());
	wp_register_style('swiper', get_stylesheet_directory_uri() . '/lib/swiper.min.css', array(), '5.4.0');
	wp_register_script('alied-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), time());
	wp_register_script('swiper', get_stylesheet_directory_uri() . '/lib/swiper.min.js', array(), '5.4.0');
});

add_action('wp_enqueue_scripts', function(){
	sf_child_theme_dequeue_style();
	wp_enqueue_style('swiper');
	wp_enqueue_style('alied-style');
	wp_enqueue_script('swiper');
	wp_enqueue_script('alied-script');
}, 40);

add_action('after_setup_theme', function () {
	register_nav_menu('primary', '主导航');
	add_theme_support('post-thumbnails');
	add_image_size('home-banner', 1600, 666, true);
	// add_image_size('post-thumbnail', 1280, 720, true);
});

add_filter( 'woocommerce_min_password_strength', function ( $strength ) {
	return 1;
}, 10, 1);

/**
 * Remove the password strength meter script from the scripts queue
 * you can also use wp_print_scripts hook
 */
// add_action( 'wp_enqueue_scripts', function () {
// 	wp_dequeue_script( 'wc-password-strength-meter' );
// }, 10 );

// add_action( 'wp_enqueue_scripts',  function () {
// 	wp_localize_script( 'wc-password-strength-meter', 'pwsL10n', array(
// 		'short' => 'Too short',
// 		'bad' => 'Too bad',
// 		'good' => 'Better but not enough',
// 		'strong' => 'Better',
// 		'mismatch' => 'Your passwords do not match, please re-enter them.'
// 	) );
// }, 9999 );

add_filter( 'woocommerce_get_script_data', function ( $params, $handle  ) {

	if( $handle === 'wc-password-strength-meter' ) {
		$params = array_merge( $params, array(
			'min_password_strength' => 1,
			'i18n_password_error' => '密码必须是8位以上字母、数字的组合，并且不是任何常见密码',
			'i18n_password_hint' => ''
		) );
	}
	return $params;

} , 20, 2 );

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );