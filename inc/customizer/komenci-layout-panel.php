<?php
/**
 * Komenci Page layout for archive/sing/blog, page and single blog post
 *
 * @package Komenci
 * @since 1.0.0
 */

add_action( 'customize_register', 'komenci_design_settings_register' );

function komenci_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'Komenci_Customize_Control_Radio_Image' );

	/**
     * Add Layout Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'komenci_layout_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Layout Settings', 'komenci' ),
	    )
    );

    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'komenci_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive/Blog Settings', 'komenci' ),
            'panel'     => 'komenci_layout_settings_panel',
            'priority'  => 5,
        )
    );      

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'komenci_sanitize_select',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'komenci_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'komenci' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'komenci' ),
                'section'  => 'komenci_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_archive_read_more_text',
        array(
            'default'      => esc_html__( 'Read More', 'komenci' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'komenci_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'komenci' ),
            'description'  	=> esc_html__( 'Enter read more button text for archive page.', 'komenci' ),
            'section'   	=> 'komenci_archive_settings_section',
            'priority'  	=> 15
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'komenci_archive_read_more_text', 
            array(
                'selector' => '.entry-footer > a.komenci-icon-btn',
                'render_callback' => 'komenci_customize_partial_archive_more',
            )
    );

    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'komenci_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'komenci' ),
            'panel'     => 'komenci_layout_settings_panel',
            'priority'  => 10,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'komenci_sanitize_select',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'komenci_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'komenci' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'komenci' ),
                'section'  => 'komenci_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'komenci_post_settings_section',
        array(
            'title'     => esc_html__( 'Single Post Settings', 'komenci' ),
            'panel'     => 'komenci_layout_settings_panel',
            'priority'  => 15,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'komenci_sanitize_select',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'komenci_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'komenci' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'komenci' ),
                'section'  => 'komenci_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_related_posts_option',
        array(
            'default' => 'show',
            'transport'  => 'refresh',
            'sanitize_callback' => 'komenci_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new komenci_Customize_Switch_Control(
        $wp_customize,
            'komenci_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'komenci' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'komenci' ),
                'section'   => 'komenci_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'komenci' ),
                    'hide'  => esc_html__( 'Hide', 'komenci' )
                ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_related_posts_title',
        array(
            'default'    => esc_html__( 'Related Posts', 'komenci' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'komenci_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'komenci' ),
            'section'   => 'komenci_post_settings_section',
            'active_callback' => 'komenci_is_related_shown',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'komenci_related_posts_title', 
            array(
                'selector' => 'h2.komenci-related-title',
                'render_callback' => 'komenci_customize_partial_related_title',
            )
    );

    $wp_customize->add_setting( 
        'komenci_related_post_from', 
        array(
            'transport'  => 'refresh',
            'sanitize_callback' => 'komenci_sanitize_select',
            'default' => 'category',
        ) 
    );
  
    $wp_customize->add_control( 
        'komenci_related_post_from', array(
            'type' => 'select',
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'section' => 'komenci_post_settings_section', // Add a default or your own section
            'label'     => esc_html__( 'Select Related Post Type', 'komenci' ),
            'active_callback' => 'komenci_is_related_shown',
            'description' => esc_html__( 'Select whish taxonomy you want to fetch related post', 'komenci' ),
            'choices' => array(
                'category' => esc_html__( 'Category', 'komenci' ),
                'tag' => esc_html__( 'Tag', 'komenci' ),
            ),
        )
    );




    if ( class_exists( 'WooCommerce' ) ) :

    /**
     * Product Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'komenci_product_settings_section',
        array(
            'title'     => esc_html__( 'Product Page Settings', 'komenci' ),
            'panel'     => 'komenci_layout_settings_panel',
            'priority'  => 20,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_product_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'komenci_sanitize_select',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'komenci_product_page_sidebar',
            array(
                'label'    => esc_html__( 'Product Page Sidebars', 'komenci' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'komenci' ),
                'section'  => 'komenci_product_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Single Product Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'komenci_single_product_settings_section',
        array(
            'title'     => esc_html__( 'Single Product Settings', 'komenci' ),
            'panel'     => 'komenci_layout_settings_panel',
            'priority'  => 25,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_single_product_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'komenci_sanitize_select',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'komenci_single_product_sidebar',
            array(
                'label'    => esc_html__( 'Single Product Sidebars', 'komenci' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'komenci' ),
                'section'  => 'komenci_single_product_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'komenci' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_related_product_option',
        array(
            'default' => 'show',
            'transport'  => 'refresh',
            'sanitize_callback' => 'komenci_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new komenci_Customize_Switch_Control(
        $wp_customize,
            'komenci_related_product_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Product Option', 'komenci' ),
                'description'   => esc_html__( 'Show/Hide option for related product section at single product page.', 'komenci' ),
                'section'   => 'komenci_single_product_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'komenci' ),
                    'hide'  => esc_html__( 'Hide', 'komenci' )
                ),
                'priority'  => 10,
            )
        )
    );


    endif; // if woocommerce available

} // Layout panel closed