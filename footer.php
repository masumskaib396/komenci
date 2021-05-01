<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Komenci
 */

?>

<?php
/**
 * komenci_content_end hook
 *
 * @since 1.0.0
 */
do_action( 'komenci_content_end' );

/**
 * komenci_footer_before hook
 *
 * @since 1.0.0
 */
do_action( 'komenci_footer_before' );

$komenci_footer_layout = get_theme_mod( 'komenci_footer_widget_option', 'show' );
if ( 'show' === $komenci_footer_layout ) :
	/**
	 * komenci_footer_section hook
	 *
	 * @since 1.0.0
	 */
	do_action( 'komenci_footer_section' );
endif;

/**
 * komenci_footer_bottom hook
 *
 * @since 1.0.0
 */
do_action( 'komenci_footer_bottom' );

/**
 * komenci_footer_after hook
 *
 * @since 1.0.0
 */
do_action( 'komenci_footer_after' );


/**
 * komenci_after_page
 * 
 * @since 1.0.0
 */
do_action( 'komenci_after_page' );


wp_footer(); ?>

</body>
</html>
