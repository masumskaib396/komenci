<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Komenci
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function komenci_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'komenci_infinite_scroll_render',
		'posts_per_page' => get_option( 'posts_per_page' ),
	) );
}
add_action( 'after_setup_theme', 'komenci_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function komenci_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_type() );
	}
}
