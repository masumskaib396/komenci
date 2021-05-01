<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Komenci
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function komenci_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// add a classs when box layout selected.
	$page_layout = get_theme_mod( 'komenci_site_layout', 'fullwidth_layout' );
	if ( 'boxed_layout' === $page_layout ) {
		$classes[] = 'box-layout-page';
	}

	return $classes;
}
add_filter( 'body_class', 'komenci_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function komenci_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'komenci_pingback_header' );



/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function komenci_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'komenci' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'komenci' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) :

		register_sidebar(
			array(
				'name'          => esc_html__( 'Products Sidebar', 'komenci' ),
				'id'            => 'product-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'komenci' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

	endif;

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'komenci' ),
			'id'            => 'footer-widget-area',
			'description'   => esc_html__( 'Add widgets here.', 'komenci' ),
			'before_widget' => '<section id="%1$s" class="komenci-footer-widget widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'komenci_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function komenci_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'komenci-fonts', komenci_fonts_url(), array(), null );
	// Add Themify icons, used in the main stylesheet.
	wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/vendor/themify-icons/themify-icons.css', array(), wp_get_theme()->get( 'Version' ) );
	// Add Bootstrap styles files.
	wp_dequeue_style( 'bootstrap' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.css', array(), wp_get_theme()->get( 'Version' ) );
	// Add Meanmenu styles files.
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/assets/vendor/meanmenu/meanmenu.css', array(), wp_get_theme()->get( 'Version' ) );
	// Add Dashicons.
	wp_enqueue_style( 'dashicons' );
	// Add Komenci main styles files.
	wp_enqueue_style( 'komenci-main', get_template_directory_uri() . '/assets/css/komenci-style.css', array(), wp_get_theme()->get( 'Version' ) );
	// Theme stylesheet.
	wp_enqueue_style( 'komenci-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	// Add Komenci mairesponsiven styles files.
	wp_enqueue_style( 'komenci-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'komenci-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/assets/vendor/meanmenu/jquery.meanmenu.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'komenci-touch-navigation', get_template_directory_uri() . '/assets/js/touch-keyboard-navigation.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'komenci-config', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );

	wp_localize_script(
		'komenci-touch-navigation',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'komenci' ),
			'collapse' => __( 'collapse child menu', 'komenci' ),
		)
	);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$komenci_dynamic_css       = '';
	$komenci_header_bg         = get_header_image();
	$komenci_header_background = get_theme_mod( 'header_background_color' );
	$komenci_footer_background = get_theme_mod( 'footer_background_color', '#22304A' );
	$komenci_footer_text       = get_theme_mod( 'footer_text_color', '#FFFFFF' );
	$komenci_footer_anchor     = get_theme_mod( 'footer_anchor_color', '#666666' );

	$komenci_footer_bottom_background = get_theme_mod( 'footer_bottom_background_color', '#22304A' );
	$komenci_footer_bottom_text       = get_theme_mod( 'footer_bottom_text_color', '#FFFFFF' );
	$komenci_footer_bottom_anchor     = get_theme_mod( 'footer_bottom_anchor_color', '#fc414a' );

	if ( $komenci_header_bg ) {
		$komenci_dynamic_css .= '.komenci-breadcrumb-section { background: url("' . esc_url( $komenci_header_bg ) . '") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; background-size: cover; }';
		$komenci_dynamic_css .= '.komenci-breadcrumb-section::before {
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(255,255,255,0.5);
		}';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_header_background ) {
		$komenci_dynamic_css .= '.komenci-breadcrumb-section { background-color: ' . esc_attr( $komenci_header_background ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_background ) {
		$komenci_dynamic_css .= '#colophon { background-color: ' . esc_attr( $komenci_footer_background ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_text ) {
		$komenci_dynamic_css .= '.komenci-footer-widget, .komenci-footer-widget li, .komenci-footer-widget p, .komenci-footer-widget h3, .komenci-footer-widget h4 { color: ' . esc_attr( $komenci_footer_text ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_anchor ) {
		$komenci_dynamic_css .= '.komenci-footer-widget a { color: ' . esc_attr( $komenci_footer_anchor ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_bottom_background ) {
		$komenci_dynamic_css .= '.komenci-footer-bottom { background-color: ' . esc_attr( $komenci_footer_bottom_background ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_bottom_text ) {
		$komenci_dynamic_css .= '.komenci-footer-bottom p, .komenci-copywright, .komenci-copywright li { color: ' . esc_attr( $komenci_footer_bottom_text ) . ' }';
		$komenci_dynamic_css .= "\n";
	}
	if ( $komenci_footer_bottom_anchor ) {
		$komenci_dynamic_css .= '.komenci-footer-bottom a, .komenci-copywright a, .komenci-copywright li a { color: ' . esc_attr( $komenci_footer_bottom_anchor ) . ' }';
		$komenci_dynamic_css .= "\n";
	}

	$komenci_dynamic_css = komenci_css_strip_whitespace( $komenci_dynamic_css );

	wp_add_inline_style( 'komenci-style', $komenci_dynamic_css );

}
add_action( 'wp_enqueue_scripts', 'komenci_scripts', 5 );

/**
 * Add an extra menu to our nav for our priority+ navigation to use
 *
 * @param object $nav_menu  Nav menu.
 * @param object $args      Nav menu args.
 * @return string More link for hidden menu items.
 */
function komenci_add_ellipses_to_nav( $nav_menu, $args ) {

	if ( 'menu-1' === $args->theme_location ) :

		$nav_menu .= '<div class="main-menu-more">';
		$nav_menu .= '<ul class="main-menu">';
		$nav_menu .= '<li class="menu-item menu-item-has-children">';
		$nav_menu .= '<button class="submenu-expand main-menu-more-toggle is-empty" tabindex="-1" aria-label="More" aria-haspopup="true" aria-expanded="false">';
		$nav_menu .= '<span class="screen-reader-text">' . esc_html__( 'More', 'komenci' ) . '</span>';
		// $nav_menu .= komenci_get_icon_svg( 'arrow_drop_down_ellipsis' );
		$nav_menu .= '</button>';
		$nav_menu .= '<ul class="sub-menu hidden-links">';
		$nav_menu .= '<li id="menu-item--1" class="mobile-parent-nav-menu-item menu-item--1">';
		$nav_menu .= '<button class="menu-item-link-return">';
		// $nav_menu .= komenci_get_icon_svg( 'chevron_left' );
		$nav_menu .= esc_html__( 'Back', 'komenci' );
		$nav_menu .= '</button>';
		$nav_menu .= '</li>';
		$nav_menu .= '</ul>';
		$nav_menu .= '</li>';
		$nav_menu .= '</ul>';
		$nav_menu .= '</div>';

	endif;

	return $nav_menu;
}


/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function komenci_css_strip_whitespace( $css ) {
	$replace = array(
		'#/\*.*?\*/#s' => '',  // Strip C style comments.
		'#\s\s+#'      => ' ', // Strip excess whitespace.
	);
	$search  = array_keys( $replace );
	$css     = preg_replace( $search, $replace, $css );

	$replace = array(
		': '  => ':',
		'; '  => ';',
		' {'  => '{',
		' }'  => '}',
		', '  => ',',
		'{ '  => '{',
		';}'  => '}', // Strip optional semicolons.
		",\n" => ',', // Don't wrap multiple selectors.
		"\n}" => '}', // Don't wrap closing braces.
		'} '  => "}\n", // Put each rule on it's own line.
	);
	$search  = array_keys( $replace );
	$css     = str_replace( $search, $replace, $css );

	return trim( $css );
}


if ( ! function_exists( 'komenci_fonts_url' ) ) :

	/**
	 * Register Google fonts for Komenci.
	 *
	 * @return string Google fonts URL for the theme.
	 * @since 1.0.0
	 */

	function komenci_fonts_url() {
		$fonts_url = '';
		$fonts     = array();

		/* translators: If there are characters in your language that are not supported by Muli, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Mulish font: on or off', 'komenci' ) ) {
			$fonts[] = 'Mulish:300,400,600';
		}

		/* translators: If there are characters in your language that are not supported by Muli, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Saira Condensed font: on or off', 'komenci' ) ) {
			$fonts[] = 'Saira Condensed:400,500,600';
		}

		$fonts = apply_filters('komenci_google_fonts', $fonts);

		if ( $fonts ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( 'latin' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;




/**
 * Logo wrapper
 *
 * @since 1.0.0
 */
function komenci_logo_wrap() {
	?>
	<a class="komenci_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" itemprop="url">
		<?php echo komenci_logo(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<?php
}



/**
 * Komenci Logo.
 *
 * @return string
 * @since 1.0.0
 */
function komenci_logo() {
	if ( get_theme_mod( 'custom_logo' ) ) {
		$logo          = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$alt_attribute = get_post_meta( get_theme_mod( 'custom_logo' ), '_wp_attachment_image_alt', true );
		if ( empty( $alt_attribute ) ) {
			$alt_attribute = get_bloginfo( 'name' );
		}
		$logo = '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( $alt_attribute ) . '">';
	} else {
		$logo = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
	}
	return $logo;
}


if ( !function_exists( 'komenci_content_wrap_calc' ) ) {
	/**
	 * Komenci content wrap classes list
	 *
	 */
	function komenci_content_wrap_calc( $type_layout ) {
		$wrap_class = array(
			'col-lg-8',
			'col-md-8',
			'col-sm-12',
			'content-area',
		);
		if ( 'no_sidebar' === $type_layout ) {
			$wrap_class = array(
				'col-lg-12',
				'col-md-12',
				'col-sm-12',
				'content-area',
			);
		} elseif ( 'left_sidebar' === $type_layout ) {
			$wrap_class[] = 'order-lg-2';
			$wrap_class[] = 'order-md-2';
		}
		return $wrap_class;
	}
}

if ( !function_exists( 'komenci_content_class' ) ) {
	/**
	 * Komenci content class init
	 */
	function komenci_content_class() {

		$archive_sidebar      = get_theme_mod( 'komenci_archive_sidebar', 'right_sidebar' );
		$post_default_sidebar = get_theme_mod( 'komenci_default_post_sidebar', 'right_sidebar' );
		$page_default_sidebar = get_theme_mod( 'komenci_default_page_sidebar', 'right_sidebar' );
		$product_default_sidebar = get_theme_mod( 'komenci_product_page_sidebar', 'right_sidebar' );
		$product_singlet_sidebar = get_theme_mod( 'komenci_single_product_sidebar', 'right_sidebar' );

		if ( is_woocommerce_active() && is_product() ) {
			$content_class = komenci_content_wrap_calc( $product_singlet_sidebar );
		} elseif ( is_single() ) {
			$content_class = komenci_content_wrap_calc( $post_default_sidebar );
		} elseif ( is_page_template('template-full.php') ) {
			$content_class = komenci_content_wrap_calc( 'no_sidebar' );
		} elseif ( is_page_template('template-full-width.php') ) {
			$content_class = komenci_content_wrap_calc( 'no_sidebar' );
		} elseif ( is_page() ) {
			$content_class = komenci_content_wrap_calc( $page_default_sidebar );
		} elseif ( is_woocommerce_active() && is_shop() ) {
			$content_class = komenci_content_wrap_calc( $product_default_sidebar );
		} else {
			$content_class = komenci_content_wrap_calc( $archive_sidebar );
		}

		$content_class = apply_filters('komenci_content_class', $content_class);

		$content_class = implode( ' ', $content_class );
		return $content_class;
	}
}

if ( !function_exists( 'komenci_sidebar_wrap_calc' ) ) {
	/**
	 * Komenci sidebar classes list
	 */
	function komenci_sidebar_wrap_calc( $type_layout ) {
		$wrap_class = array(
			'col-lg-4 col-md-4',
			'col-md-4',
			'col-sm-12',
			'widget-area',
		);
		if ( 'left_sidebar' === $type_layout ) {
			$wrap_class[] = 'order-lg-1';
			$wrap_class[] = 'order-md-1';
		}
		
		return $wrap_class;
	}
}

if ( !function_exists( 'komenci_sidebar_class' ) ) {
	/**
	 * Komenci sidebar class init
	 */
	function komenci_sidebar_class() {

		$archive_sidebar      = get_theme_mod( 'komenci_archive_sidebar', 'right_sidebar' );
		$post_default_sidebar = get_theme_mod( 'komenci_default_post_sidebar', 'right_sidebar' );
		$page_default_sidebar = get_theme_mod( 'komenci_default_page_sidebar', 'right_sidebar' );
		$product_default_sidebar = get_theme_mod( 'komenci_product_page_sidebar', 'right_sidebar' );
		$product_singlet_sidebar = get_theme_mod( 'komenci_single_product_sidebar', 'right_sidebar' );
		
		if ( is_woocommerce_active() && is_product() ) {
			$sidebar_class = komenci_sidebar_wrap_calc( $product_singlet_sidebar );
		} elseif ( is_single() ) {
			$sidebar_class = komenci_sidebar_wrap_calc( $post_default_sidebar );
		} elseif ( is_page() ) {
			$sidebar_class = komenci_sidebar_wrap_calc( $page_default_sidebar );
		} elseif ( is_woocommerce_active() && is_shop() ) {
			$sidebar_class = komenci_sidebar_wrap_calc( $product_default_sidebar );
		} else {
			$sidebar_class = komenci_sidebar_wrap_calc( $archive_sidebar );
		}

		$sidebar_class = apply_filters('komenci_sidebar_class', $sidebar_class);
		$sidebar_class = implode( ' ', $sidebar_class );
		return $sidebar_class;
	}
}


/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function komenci_custom_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 40;
}
add_filter( 'excerpt_length', 'komenci_custom_excerpt_length', 999 );


/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function komenci_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '';
}
add_filter( 'excerpt_more', 'komenci_excerpt_more' );



if ( ! function_exists( 'komenci_related_posts' ) ) {
	/**
	 * Single blog post related posts list
	 */
	function komenci_related_posts( $the_post_id ) {

		// Define shared post arguments.
		$related_args      = array(
			'update_post_meta_cache'    => false,
			'update_post_term_cache'    => false,
			'ignore_sticky_posts'       => 1,
			'orderby'                   => 'rand',
			'post_type'                 => 'post',
			'post__not_in'              => array( $the_post_id ),
			'posts_per_page'            => 3,
		);
		$related_post_type = get_theme_mod( 'komenci_related_post_from', 'category' );
		// Related by tags.
		if ( $related_post_type == 'tag' ) {
			$tags = wp_get_post_tags( $the_post_id );
			if ( $tags ) {
				$first_tag               = $tags[0]->term_id;
				$related_args['tag__in'] = array( $first_tag );
			}
		} else {
			// Related by categories.
			$cats = wp_get_post_categories( $the_post_id );
			if ( $cats && isset($cats[0]) ) {
				$first_tag                    = ( isset($cats[0]->term_id) ) ? $cats[0]->term_id : $cats[0];
				$related_args['category__in'] = array( $first_tag );
			}
		}

		return $related_args;
	}
}


if ( ! function_exists( 'komenci_set_attributes' ) ) {
	/**
	 * Set dynamic attributes
	 */
	function komenci_set_attributes( $attributes ) {

		if ( !$attributes )
			return;

		$set_attr = array();
		foreach( $attributes as $key => $attr ) {
			$attr = (array)$attr;
			$attr = implode(" ", $attr);
			$set_attr[] = "{$key}='{$attr}'";
		}
		
		return implode(" ", $set_attr);
	}
}

/**
 * wp_body_open callback for backword Compatibility
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}


/**
 * WooCommerce Modification
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
        return ( class_exists( 'WooCommerce' ) ) ? true : false;
    }
}
function komenci_woo_wrapper_start(){
	echo '<div id="primary" class="' . esc_attr( komenci_content_class() ) . '"><main id="main" class="site-main" role="main">';
}

function komenci_woo_hooks(){
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	add_action('woocommerce_before_main_content', 'komenci_woo_wrapper_start', 10);

	$related_product = get_theme_mod( 'komenci_related_product_option', 'show' );
	if( $related_product === 'hide' ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}
}
add_action('wp_head', 'komenci_woo_hooks');

