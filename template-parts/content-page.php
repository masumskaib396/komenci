<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Komenci
 */
$komenci_classes = array(
	"komenci-default-hentry",
	"komenci-default-hentry",
	"komenci-blog-wrap"
);
if ( !has_post_thumbnail() ) {
	$komenci_classes[] = "komenci-hentry-without-thumbnail";
} 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($komenci_classes); ?>>

	<div class="entry-media">
		<?php komenci_post_thumbnail(); ?>
		<?php if ( is_sticky() ) : ?>
			<span class="dashicons dashicons-admin-post"></span>
		<?php endif; ?>
	</div>
	
	<div class="komenci-blog-content komenci-blog-content-2">
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title komenci-blog-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title komenci-blog-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
			<?php if( !has_post_thumbnail() && is_sticky() ) :?>
				<span class="dashicons dashicons-admin-post"></span>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			if ( is_singular() ) :
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'komenci' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html( get_the_title() )
				) );
			else :
				echo '<p>' . wp_kses_post( get_the_excerpt() ) . '</p>';
			endif;
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'komenci' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php komenci_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
