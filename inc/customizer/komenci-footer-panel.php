<?php
/**
 * Komenci Footer Settings panel at Theme Customizer
 *
 * @package Komenci
 * @since 1.0.0
 */

add_action( 'customize_register', 'komenci_footer_settings_register' );

function komenci_footer_settings_register( $wp_customize ) {


	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'komenci_footer_settings_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Footer Settings', 'komenci' ),
	    )
    );

    /**
	 * Widget Area Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'komenci_footer_widget_section',
        array(
            'title'		=> esc_html__( 'Widget Area', 'komenci' ),
            'panel'     => 'komenci_footer_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_footer_widget_option',
        array(
            'default' => 'show',
            'transport'    => 'refresh',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Switch_Control(
        $wp_customize,
            'komenci_footer_widget_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Footer Widget Section', 'komenci' ),
                'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'komenci' ),
                'section'   => 'komenci_footer_widget_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'komenci' ),
                    'hide'  => esc_html__( 'Hide', 'komenci' )
                ),
                'priority'  => 5,
            )
        )
    );
    

    /**
     * Field for Image Radio
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'footer_widget_layout',
        array(
            'default'           => 'column_three',
            'transport'    => 'refresh',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new Komenci_Customize_Control_Radio_Image(
        $wp_customize,
        'footer_widget_layout',
            array(
                'label'    => esc_html__( 'Footer Widget Layout', 'komenci' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'komenci' ),
                'section'  => 'komenci_footer_widget_section',
                'active_callback' => 'komenci_is_footer_shown',
                'choices'  => array(
	                    'column_four' => array(
	                        'label' => esc_html__( 'Columns Four', 'komenci' ),
	                        'url'   => '%s/assets/images/column-4.png'
	                    ),
	                    'column_three' => array(
	                        'label' => esc_html__( 'Columns Three', 'komenci' ),
	                        'url'   => '%s/assets/images/column-3.png'
	                    ),
	                    'column_two' => array(
	                        'label' => esc_html__( 'Columns Two', 'komenci' ),
	                        'url'   => '%s/assets/images/column-2.png'
	                    ),
	                    'column_one' => array(
	                        'label' => esc_html__( 'Column One', 'komenci' ),
	                        'url'   => '%s/assets/images/column-1.png'
	                    )
	            ),
	            'priority' => 10
            )
        )
    );

    $wp_customize->add_setting(
        'footer_background_color',
        array(
            'default' => '#22304A',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_background_color', 
        array(
            'label'      => esc_html__( 'Footer Background Color', 'komenci' ),
            'section'    => 'komenci_footer_widget_section',
            'active_callback' => 'komenci_is_footer_shown',
            'priority'   => 20,
        ) ) 
    );

    $wp_customize->add_setting(
        'footer_text_color',
        array(
            'default' => '#FFFFFF',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_text_color', 
        array(
            'label'      => esc_html__( 'Footer Text Color', 'komenci' ),
            'section'    => 'komenci_footer_widget_section',
            'active_callback' => 'komenci_is_footer_shown',
            'priority'   => 20,
        ) ) 
    );

    $wp_customize->add_setting(
        'footer_anchor_color',
        array(
            'default' => '#666666',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_anchor_color', 
        array(
            'label'      => esc_html__( 'Footer Anchor Color', 'komenci' ),
            'section'    => 'komenci_footer_widget_section',
            'active_callback' => 'komenci_is_footer_shown',
            'priority'   => 20,
        ) ) 
    );

    /**
	 * Bottom Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'komenci_footer_bottom_section',
        array(
            'title'		=> esc_html__( 'Bottom Section', 'komenci' ),
            'panel'     => 'komenci_footer_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'komenci_copyright_text',
        array(
            'default'    => esc_html__( 'komenci', 'komenci' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'komenci_minimal_html_senitize'
        )
    );
    $wp_customize->add_control(
        'komenci_copyright_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Copyright Text', 'komenci' ),
            'section'   => 'komenci_footer_bottom_section',
            'priority'  => 5
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'komenci_copyright_text', 
        array(
            'selector' => 'span.komenci-copyright-text',
            'render_callback' => 'komenci_customize_partial_copyright',
        )
    );

    $wp_customize->add_setting(
        'footer_bottom_background_color',
        array(
            'default' => '#22304A',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_bottom_background_color', 
        array(
            'label'      => esc_html__( 'Footer Bottom Background Color', 'komenci' ),
            'section'    => 'komenci_footer_bottom_section',
            'priority'   => 20,
        ) ) 
    );

    $wp_customize->add_setting(
        'footer_bottom_text_color',
        array(
            'default' => '#FFFFFF',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_bottom_text_color', 
        array(
            'label'      => esc_html__( 'Footer Bottom Text Color', 'komenci' ),
            'section'    => 'komenci_footer_bottom_section',
            'priority'   => 20,
        ) ) 
    );

    $wp_customize->add_setting(
        'footer_bottom_anchor_color',
        array(
            'default' => '#666666',
            'transport'=>'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'footer_bottom_anchor_color', 
        array(
            'label'      => esc_html__( 'Footer Bottom Anchor Color', 'komenci' ),
            'section'    => 'komenci_footer_bottom_section',
            'priority'   => 20,
        ) ) 
    );

} //Footer panel close