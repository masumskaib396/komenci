<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Komenci
 */

if ( ! function_exists( 'komenci_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function komenci_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'komenci_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function komenci_posted_by() {
		$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( !function_exists('komenci_read_more') ) {
	/**
	 * Read more link for post list
	 */
	function komenci_read_more(){
		$more_text = get_theme_mod( 'komenci_archive_read_more_text', __('Read More', 'komenci') );
		printf( '<a href="%s" class="komenci-icon-btn">%s</a>', esc_url( get_permalink() ), esc_html( $more_text ) );
	}
}



if ( ! function_exists( 'komenci_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function komenci_entry_footer() {
		// Hide category and tag text for pages.
		if ( is_single() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'komenci' ) );
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'komenci' ) );

			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="ti-pin-alt"></i> <span class="screen-reader-text">' . esc_html__( 'Posted in', 'komenci' ) . '</span>%1$s</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="ti-pin-alt"></i> <span class="screen-reader-text">' . esc_html__( 'Tagged', 'komenci' ) . '</span>%1$s</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} 
		} else {
			komenci_read_more();
		}

		komenci_comment_count();

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'komenci' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'komenci_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function komenci_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;


if ( ! function_exists('komenci_comment_count') ) :
/**
 * Comment count
 */
function komenci_comment_count(){
	if ( post_password_required() || !( comments_open() || get_comments_number() ) ) {
		return;
	}
	?>
	<div class="komenci-comment">
		<a href="<?php comments_link(); ?>">
			<i class="ti-comment m-r-5"></i>
			<span><?php comments_number( '0', '1', '%' ); ?></span>
		</a>
	</div>
	<?php
}
endif;
