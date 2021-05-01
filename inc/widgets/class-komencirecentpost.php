<?php
/**
 * Komenci class-komenci-resent-posts.php widget class file
 *
 * @package Komenci
 */


/**
 * KomenciRecentPost widget.
 */
class KomenciRecentPost extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'komenci_recent_post', // Base ID
			esc_html__( 'Komenci Posts', 'komenci' ), // Name
			array( 'description' => esc_html__( 'Display Recent Posts', 'komenci' ) ) // Args
		);
	}



	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo wp_kses_post( $args['before_widget'] );
		$ppp = isset( $instance['ppp'] ) ? esc_attr( (int) $instance['ppp'] ) : 10;
		?>
		<?php
		if ( ! empty( $instance['title'] ) ) {
			$widget_title = $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			echo wp_kses_post( $widget_title );
		}
		$argument     = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $ppp,
		);
		$recent_query = new WP_Query( $argument );
		if ( $recent_query->have_posts() ) :
			?>
		<div class="komenci-popular-post">
			<?php
			while ( $recent_query->have_posts() ) :
				$recent_query->the_post();
				?>
			<div class="komenci-popular-post-item">
				<div class="komenci-blog-meta m-b-10">
					<div class="entry-meta">
						<?php
						komenci_posted_on();
						komenci_posted_by();
						?>
					</div><!-- .entry-meta -->
				</div>
				<div class="komenci-blog-title komenci-border-bottom">
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				</div>
			</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, no posts found.', 'komenci' ); ?></p>
		<?php endif; ?>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['ppp']   = ( ! empty( $new_instance['ppp'] ) ) ? sanitize_text_field( $new_instance['ppp'] ) : '';

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'komenci' );
		$ppp   = isset( $instance['ppp'] ) ? $instance['ppp'] : '5';
		?>
		<p>
			<label id= for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'komenci' ); ?></label> 
			<input class="widefat komenci_special-wfield" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label id= for="<?php echo esc_attr( $this->get_field_id( 'ppp' ) ); ?>"><?php esc_html_e( 'Post Per Page:', 'komenci' ); ?></label> 
			<input class="widefat komenci_special-wfield" id="<?php echo esc_attr( $this->get_field_id( 'ppp' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ppp' ) ); ?>" type="text" value="<?php echo esc_attr( $ppp ); ?>"/>
		</p>
		<?php
	}

} // class KomenciRecentPost


if ( ! function_exists( 'komenci_recent_post_widget_init' ) ) {
	function komenci_recent_post_widget_init() {
		register_widget( 'KomenciRecentPost' );
	}
}
add_action( 'widgets_init', 'komenci_recent_post_widget_init' );
