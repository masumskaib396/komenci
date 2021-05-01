<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Komenci
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$komenci_archive_sidebar      = get_theme_mod( 'komenci_archive_sidebar', 'right_sidebar' );
$komenci_post_default_sidebar = get_theme_mod( 'komenci_default_post_sidebar', 'right_sidebar' );
$komenci_page_default_sidebar = get_theme_mod( 'komenci_default_page_sidebar', 'right_sidebar' );
$komenci_product_default_sidebar = get_theme_mod( 'komenci_product_page_sidebar', 'right_sidebar' );
$product_singlet_sidebar = get_theme_mod( 'komenci_single_product_sidebar', 'right_sidebar' );

if ( is_woocommerce_active() && is_product() ) {
	if ( 'no_sidebar' === $product_singlet_sidebar ) {
		return;
	}
}  elseif ( is_single() ) {
	if ( 'no_sidebar' === $komenci_post_default_sidebar ) {
		return;
	}
} elseif ( is_page() ) {
	if ( 'no_sidebar' === $komenci_page_default_sidebar ) {
		return;
	}
} elseif ( is_woocommerce_active() && is_shop() ) {
	if ( 'no_sidebar' === $komenci_product_default_sidebar ) {
		return;
	}
} else {
	if ( 'no_sidebar' === $komenci_archive_sidebar ) {
		return;
	}
}
?>

<aside id="secondary" class="<?php echo esc_attr( komenci_sidebar_class() ); ?>">
	<div class="komenci-sidebar-wrap">
		<?php 
			if( is_woocommerce_active() && (is_shop() || is_product()) )
				dynamic_sidebar( 'product-sidebar' );
			else 
				dynamic_sidebar( 'sidebar-1' );
		?>
	</div>
</aside><!-- #secondary -->
