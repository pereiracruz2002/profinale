<?php

	function pryanik_customize_register( $wp_customize ){

		// require custom control classes
		require_once ( PRYANIK_CLASS_DIR . 'custom-controls.php');
		require_once ( PRYANIK_FUNCTION_DIR . 'create-lists.php');

		/*-----------------------------------------------------------------------------------*/
		/*
		/*  Global Select & Slider Arrays
		/*
		/*-----------------------------------------------------------------------------------*/

		// landing opacity
		$range_opacity = array(
			'min' => '0.0',
			'max' => '1.0',
			'step' => '0.1',
		);
		// Radius
		$range_radius = array(
			'min' => '0',
			'max' => '100',
			'step' => '1',
		);
		// padding & margins
		$range_padding = array(
			'min' => '0',
			'max' => '100',
			'step' => '5',
		);
		// fonts
		//$fonts = Pryanik_list_fonts();
		// font size
		$range_font_size = array(
			'min' => '10',
			'max' => '80',
			'step' => '1',
		);
		// font line height
		$range_font_line = array(
			'min' => '0',
			'max' => '3',
			'step' => '.1',
		);
		// font letter spacing
		$range_font_spacing = array(
			'min' => '-10',
			'max' => '10',
			'step' => '1',
		);

		/*-----------------------------------------------------------------------------------*/
		/*
		/*  Remove unnecessary core sections & controls
		/*
		/*-----------------------------------------------------------------------------------*/

		$wp_customize->remove_section( 'title_tagline');
		$wp_customize->remove_section( 'colors');
		$wp_customize->remove_section( 'background_image');
		$wp_customize->remove_section( 'header_image');
		$wp_customize->remove_section( 'static_front_page');

		/*-----------------------------------------------------------------------------------*/
		/*
		/*  Add Pannels
		/*
		/*-----------------------------------------------------------------------------------*/

		$wp_customize->add_panel( 'header', array(
			'priority' => 2,
			'capability' => 'edit_theme_options',
			'title' => __( 'Header Settings', 'pryaniktheme' ),
			'description' => __( 'Select logo for your site. You can also change logo and menu settings.', 'pryaniktheme' ),
		) );

		$wp_customize->add_panel( 'layout', array(
			'priority' => 3,
			'capability' => 'edit_theme_options',
			'title' => __( 'Layout Settings', 'pryaniktheme' ),
			'description' => __( 'Select blog type, layout and sidebar.', 'pryaniktheme' ),
		) );

		$wp_customize->add_panel( 'typography', array(
			'priority' => 7,
			'capability' => 'edit_theme_options',
			'title' => __( 'Typography Settings', 'pryaniktheme' ),
			'description' => __( 'Select font styles for headings and body text.', 'pryaniktheme' ),
		) );

		$wp_customize->add_panel( 'footer', array(
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'title' => __( 'Footer Settings', 'pryaniktheme' ),
			'description' => __( 'Upload footer logo, change background color, set up fullwidth instagram widget', 'pryaniktheme' ),
		) );

		/*-----------------------------------------------------------------------------------*/
		/*
		/*  Add Sections
		/*
		/*-----------------------------------------------------------------------------------*/

		$wp_customize->add_section( 'general_settings' , array('title'=> __( 'General Settings', 'pryaniktheme' ),'priority'   => 1) );

		$wp_customize->add_section( 'logo' , array('title'=> __( 'Logo', 'pryaniktheme' ),'priority'   => 1, 'panel' => 'header') );
		$wp_customize->add_section( 'menu' , array('title'=> __( 'Menu', 'pryaniktheme' ),'priority'   => 2, 'panel' => 'header') );
		$wp_customize->add_section( 'general_header' , array('title'=> __( 'General Settings', 'pryaniktheme' ),'priority'   => 3, 'panel' => 'header') );
		$wp_customize->add_section( 'toggle_sidebar' , array('title'=> __( 'Toggle Sidebar Settings', 'pryaniktheme' ),'priority'   => 4, 'panel' => 'header') );

		$wp_customize->add_section( 'blog' , array('title'=> __( 'Blog Layout', 'pryaniktheme' ),'priority'   => 1, 'panel' => 'layout') );
		$wp_customize->add_section( 'post_page' , array('title'=> __( 'Post Page Layout', 'pryaniktheme' ),'priority'   => 2, 'panel' => 'layout') );
		$wp_customize->add_section( 'category' , array('title'=> __( 'Category Pages Layout', 'pryaniktheme' ),'priority'   => 3, 'panel' => 'layout') );
		$wp_customize->add_section( 'search' , array('title'=> __( 'Search and Archive Pages Layout', 'pryaniktheme' ),'priority'   => 4, 'panel' => 'layout') );

		$wp_customize->add_section( 'post_settings' , array('title'=> __( 'Post Settings', 'pryaniktheme' ),'priority'   => 4) );
		$wp_customize->add_section( 'background_settings' , array('title'=> __( 'Background Settings', 'pryaniktheme' ),'priority'   => 5) );
		$wp_customize->add_section( 'color_settings' , array('title'=> __( 'Colors', 'pryaniktheme' ),'priority'   => 6) );
		
		$wp_customize->add_section( 'body' , array('title'=> __( 'Body Text Settings', 'pryaniktheme' ),'priority'   => 1, 'panel' => 'typography') );
		$wp_customize->add_section( 'h1' , array('title'=> __( 'H1 Settings', 'pryaniktheme' ),'priority'   => 2, 'panel' => 'typography') );
		$wp_customize->add_section( 'h2' , array('title'=> __( 'H2 Settings', 'pryaniktheme' ),'priority'   => 3, 'panel' => 'typography') );
		$wp_customize->add_section( 'h3' , array('title'=> __( 'H3 Settings', 'pryaniktheme' ),'priority'   => 4, 'panel' => 'typography') );
		$wp_customize->add_section( 'h4' , array('title'=> __( 'H4 Settings', 'pryaniktheme' ),'priority'   => 5, 'panel' => 'typography') );
		$wp_customize->add_section( 'h5' , array('title'=> __( 'H5 Settings', 'pryaniktheme' ),'priority'   => 6, 'panel' => 'typography') );
		$wp_customize->add_section( 'h6' , array('title'=> __( 'H6 Settings', 'pryaniktheme' ),'priority'   => 7, 'panel' => 'typography') );

		$wp_customize->add_section( 'buttons_settings' , array('title'=> __( 'Buttons Settings', 'pryaniktheme' ),'priority'   => 8) );
		
		$wp_customize->add_section( 'custom_slider' , array('title'=> __( 'Home Page Slider', 'pryaniktheme' ),'priority'   => 9) );

		$wp_customize->add_section( 'footer_settings' , array('title'=> __( 'General Settings', 'pryaniktheme' ),'priority'   => 1, 'panel' => 'footer') );
		$wp_customize->add_section( 'footer_instagram' , array('title'=> __( 'Fullwidth Instagram Widget', 'pryaniktheme' ),'priority'   => 2, 'panel' => 'footer') );
	
		/*-----------------------------------------------------------------------------------*/
		/*
		/*  Add Settings and Controls
		/*
		/*-----------------------------------------------------------------------------------*/

		//General Settings Section

		$wp_customize->add_setting( 'upload_favicon' , array('type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'upload_apple_icon' , array('type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'site_layout' , array('type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'add_loader' , array('default'     => false,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'upload_loader' , array('type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_url_raw') );

		//General Settings Controls

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_favicon',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Upload the favicon', 'pryaniktheme' ),
				   'section'    => 'general_settings',
				   'settings'   => 'upload_favicon'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_apple_icon',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Upload the apple touch icon', 'pryaniktheme' ),
				   'section'    => 'general_settings',
				   'settings'   => 'upload_apple_icon'
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'site_layout',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Select site layout', 'pryaniktheme' ),
				   'section'    => 'general_settings',
				   'settings'   => 'site_layout',
				   'choices'        => array(
						'fullwidth'   => __( 'Full width', 'pryaniktheme' ),
						'boxed'  => __( 'Boxed', 'pryaniktheme' )
					)
			   )
		   )
		);
		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'add_loader',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Add site loader gif', 'pryaniktheme' ),
				   'section'    => 'general_settings',
				   'settings'   => 'add_loader',
				   'type'    => 'checkbox'
			   )
		   )
		);
		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_loader',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Upload loader gif', 'pryaniktheme' ),
				   'section'    => 'general_settings',
				   'settings'   => 'upload_loader'
			   )
		   )
		);

		//Logo Section

		$wp_customize->add_setting( 'upload_logo' , array('type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'upload_logo2x' , array('type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'logo_position' , array('default'     => 'center','type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'logo_padding_top' , array('default'     => 30,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'logo_padding_bottom' , array('default'     => 30,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'logo_background_color' , array('type' => 'option', 'default'     => '#ffffff','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );

		//Logo Controls

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'logo_position',
				array(
					'priority' => 1,
					'label'          => __( 'Logo position', 'pryaniktheme' ),
					'section'        => 'logo',
					'settings'       => 'logo_position',
					'type'           => 'select',
					'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'center'  => __( 'Center', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' )
					)
				)
			)
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_logo',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Upload the logo', 'pryaniktheme' ),
				   'section'    => 'logo',
				   'settings'   => 'upload_logo'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_logo2x',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Upload the logo @2x.', 'pryaniktheme' ),
				   'section'    => 'logo',
				   'settings'   => 'upload_logo2x'
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'logo_padding_top',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Padding top', 'pryaniktheme' ),
				   'section'    => 'logo',
				   'settings'   => 'logo_padding_top',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_padding
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'logo_padding_bottom',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Padding bottom', 'pryaniktheme' ),
				   'section'    => 'logo',
				   'settings'   => 'logo_padding_bottom',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_padding

			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'logo_background_color',
			array(
				'priority' => 6,
				'label'      => __( 'Background color', 'pryaniktheme' ),
				'section'    => 'logo',
				'settings'   => 'logo_background_color',
			) )
		);

		//Menu Section

		$wp_customize->add_setting( 'hide_menu' , array('default'     => false,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_position' , array('default'     => 'after','type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_float' , array('default'     => 'center','type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_padding_top' , array('default'     => 15,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_padding_bottom' , array('default'     => 15,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_background_color' , array('type' => 'option', 'default'     => '#fff','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );
		$wp_customize->add_setting( 'menu_li_padding' ,  array('default'     => 30,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

		$wp_customize->add_setting( 'menu_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_font_weight' , array('type' => 'option', 'default'     => true,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_font_size' , array('type' => 'option', 'default'     => 16,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_letterspacing' , array('type' => 'option', 'default'     => 0,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_lineheight' , array('type' => 'option', 'default'     => 1.9,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'menu_color' , array('type' => 'option', 'default'     => '#222','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );

		//Menu Controls

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'hide_menu',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Hide header menu', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'hide_menu',
				   'type'    => 'checkbox'
			   )
		   )
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'menu_position',
				array(
					'priority' => 2,
					'label'          => __( 'Menu position', 'pryaniktheme' ),
					'section'        => 'menu',
					'settings'       => 'menu_position',
					'type'           => 'select',
					'choices'        => array(
						'before'   => __( 'Before Logo', 'pryaniktheme' ),
						'after'  => __( 'After Logo', 'pryaniktheme' )
					)
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'menu_float',
				array(
					'priority' => 3,
					'label'          => __( 'Menu align', 'pryaniktheme' ),
					'section'        => 'menu',
					'settings'       => 'menu_float',
					'type'           => 'select',
					'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'center'  => __( 'Center', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' )
					)
				)
			)
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_padding_top',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Margin top', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_padding_top',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_padding
			   )
		   )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_padding_bottom',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Margin bottom', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_padding_bottom',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_padding

			   )
		   )
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'menu_background_color',
			array(
				'priority' => 6,
				'label'      => __( 'Background color', 'pryaniktheme' ),
				'section'    => 'menu',
				'settings'   => 'menu_background_color',
			) )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_li_padding',
			   array(
				   'priority' => 7,
				   'label'      => __( 'Item padding', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_li_padding',
				   'type'    	=> 'slider',
				   'choices'    =>  array(
										'min' => '5',
										'max' => '50',
										'step' => '1',
									)

			   )
		   )
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'menu_font_family',
				array(
					'priority' => 8,
					'label'          => __( 'Font family', 'pryaniktheme' ),
					'section'        => 'menu',
					'settings'       => 'menu_font_family',
					'type'           => 'select',
					'choices'        => pryanik_list_fonts()
				)
			)
		);
		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'menu_font_weight',
			   array(
				   'priority' => 9,
				   'label'      => __( 'Bold', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_font_weight',
				   'type'    => 'checkbox'
			   )
		   )
		);
		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'menu_text_transform',
			   array(
				   'priority' => 10,
				   'label'      => __( 'Uppercase', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_text_transform',
				   'type'    => 'checkbox'
			   )
		   )
		);
		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'menu_italic',
			   array(
				   'priority' => 11,
				   'label'      => __( 'Italic', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_italic',
				   'type'    => 'checkbox'
			   )
		   )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_font_size',
			   array(
				   'priority' => 12,
				   'label'      => __( 'Font size', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_font_size',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_size

			   )
		   )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_letterspacing',
			   array(
				   'priority' => 13,
				   'label'      => __( 'Letterspacing', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_letterspacing',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_spacing

			   )
		   )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'menu_lineheight',
			   array(
				   'priority' => 14,
				   'label'      => __( 'Line Height', 'pryaniktheme' ),
				   'section'    => 'menu',
				   'settings'   => 'menu_lineheight',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_line

			   )
		   )
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color',
			array(
				'priority' => 15,
				'label'      => __( 'Font color', 'pryaniktheme' ),
				'section'    => 'menu',
				'settings'   => 'menu_color',
			) )
		);

		//General Header Settings Section

		$wp_customize->add_setting( 'add_search' , array('default'     => true,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'search_type' , array('default'     => 'default','type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'add_toggle' , array('default'     => true,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );		
		$wp_customize->add_setting( 'search_position' , array('default'     => 'logo','type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'search_color' , array('type' => 'option', 'default'     => '#222','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );
		$wp_customize->add_setting( 'divider_color' , array('type' => 'option', 'default'     => '#ddd','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );

		//Genereal Header Settings Controls

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'add_search',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Add search to header', 'pryaniktheme' ),
				   'section'    => 'general_header',
				   'settings'   => 'add_search',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'search_type',
				array(
					'priority' => 2,
					'label'          => __( 'Search type', 'pryaniktheme' ),
					'section'        => 'general_header',
					'settings'       => 'search_type',
					'type'           => 'select',
					'choices'        => array(
						'dropdown'   => __( 'Dropdown', 'pryaniktheme' ),
						'default'  => __( 'Default', 'pryaniktheme' )
					)
				)
			)
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'add_toggle',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Add toggle sidebar', 'pryaniktheme' ),
				   'section'    => 'general_header',
				   'settings'   => 'add_toggle',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'search_position',
				array(
					'priority' => 4,
					'label'          => __( 'Search and Toggle button position', 'pryaniktheme' ),
					'section'        => 'general_header',
					'settings'       => 'search_position',
					'type'           => 'select',
					'choices'        => array(
						'logo'   => __( 'Logo Bar', 'pryaniktheme' ),
						'menu'  => __( 'Menu Bar', 'pryaniktheme' )
					)
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'search_color',
			array(
				'priority' => 5,
				'label'      => __( 'Font color', 'pryaniktheme' ),
				'section'    => 'general_header',
				'settings'   => 'search_color',
			) )
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'divider_color',
			array(
				'priority' => 6,
				'label'      => __( 'Header divider color', 'pryaniktheme' ),
				'section'    => 'general_header',
				'settings'   => 'divider_color',
			) )
		);

		//Toggle Sidebar Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'select_toggle_sidebar' , array('default'     => 'post_sidebar2','type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'toggle_sidebar_color' , array('type' => 'option', 'default'     => '#222','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );
		$wp_customize->add_setting( 'toggle_sidebar_widgets_color' , array('type' => 'option', 'default'     => 'light','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'toggle_sidebar_width' ,  array('default'     => 500,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		//Toggle Sidebar Settings Controls

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'select_toggle_sidebar',
			   array(
				   	'priority' => 1,
				   	'label'      => __( 'Select sidebar for toggle sidebar', 'pryaniktheme' ),
				   	'section'    => 'toggle_sidebar',
				   	'settings'   => 'select_toggle_sidebar',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'toggle_sidebar_color',
			array(
				'priority' => 2,
				'label'      => __( 'Background color', 'pryaniktheme' ),
				'section'    => 'toggle_sidebar',
				'settings'   => 'toggle_sidebar_color',
			) )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'toggle_sidebar_widgets_color',
			   array(
				   	'priority' => 3,
				   	'label'      => __( 'Select widgets color theme', 'pryaniktheme' ),
				   	'section'    => 'toggle_sidebar',
				   	'settings'   => 'toggle_sidebar_widgets_color',
				   	'type'           => 'radio',
					'choices'        => array(
						'light'   => __( 'Light', 'pryaniktheme' ),
						'dark'  => __( 'Dark', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'toggle_sidebar_width',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Sidebar width', 'pryaniktheme' ),
				   'section'    => 'toggle_sidebar',
				   'settings'   => 'toggle_sidebar_width',
				   'type'    	=> 'slider',
				   'choices'    =>  array(
										'min' => '450',
										'max' => '800',
										'step' => '50',
									)

			   )
		   )
		);

		//Blog Layout Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'blog_type' , array('type' => 'option', 'default' => 'grid', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'blog_sidebar_layout' , array('type' => 'option','default' => 'right', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'blog_sidebar' , array('type' => 'option', 'default'     => 'blog_sidebar1','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'blog_layout' , array('type' => 'option','default' => '2col', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'blog_order' , array('type' => 'option', 'default' => 'last', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'blog_pagination' , array('type' => 'option', 'default' => 'short', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Blog Layout Settings Controls

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'blog_type',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Blog type', 'pryaniktheme' ),
				   'section'    => 'blog',
				   'settings'   => 'blog_type',
				   'choices'        => array(
						'list'   => __( 'List', 'pryaniktheme' ),
						'grid'  => __( 'Grid', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'blog_sidebar_layout',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Blog sidebar layout', 'pryaniktheme' ),
				   'section'    => 'blog',
				   'settings'   => 'blog_sidebar_layout',
				   'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' ),
						'none'  => __( 'None', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'blog_sidebar',
			   array(
				   	'priority' => 3,
				   	'label'      => __( 'Select sidebar for blog', 'pryaniktheme' ),
				   	'section'    => 'blog',
				   	'settings'   => 'blog_sidebar',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'blog_layout',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Blog layout( for grid blog type )', 'pryaniktheme' ),
				   'section'    => 'blog',
				   'settings'   => 'blog_layout',
				   'choices'        => array(
						'2col'   => __( '2 Columns', 'pryaniktheme' ),
						'3col'  => __( '3 Columns', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'blog_order',
				array(
					'priority' => 5,
					'label'          => __( 'Select post order type', 'pryaniktheme' ),
					'section'        => 'blog',
					'settings'       => 'blog_order',
					'type'           => 'radio',
					'choices'        => array(
						'last'   => __( 'Newest first', 'pryaniktheme' ),
						'first'  => __( 'Oldest first', 'pryaniktheme' ),
						'rand'  => __( 'Random order', 'pryaniktheme' )
					)
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'blog_pagination',
				array(
					'priority' => 6,
					'label'          => __( 'Blog pagination type', 'pryaniktheme' ),
					'section'        => 'blog',
					'settings'       => 'blog_pagination',
					'type'           => 'radio',
					'choices'        => array(
						'short'   => __( 'Older/Newer posts', 'pryaniktheme' ),
						'default'  => __( 'Classic pagination', 'pryaniktheme' )
					)
				)
			)
		);

		//Post Page Layout Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'post_page_sidebar_layout' , array('type' => 'option','default' => 'right', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'post_page_sidebar' , array('type' => 'option', 'default'     => 'post_sidebar1','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'post_title_padding_top' , array('default'     => 90,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'post_title_padding_bottom' , array('default'     => 90,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

		//Post Page Layout Settings Controls

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'post_page_sidebar_layout',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Post page sidebar layout', 'pryaniktheme' ),
				   'section'    => 'post_page',
				   'settings'   => 'post_page_sidebar_layout',
				   'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' ),
						'none'  => __( 'None', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'post_page_sidebar',
			   array(
				   	'priority' => 2,
				   	'label'      => __( 'Select sidebar for post page', 'pryaniktheme' ),
				   	'section'    => 'post_page',
				   	'settings'   => 'post_page_sidebar',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);
		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'post_title_padding_top',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Custom post title margin top', 'pryaniktheme' ),
				   'section'    => 'post_page',
				   'settings'   => 'post_title_padding_top',
				   'type'    	=> 'slider',
				   'choices'    =>  array(
										'min' => '0',
										'max' => '200',
										'step' => '10',
									)
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'post_title_padding_bottom',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Custom post title margin bottom', 'pryaniktheme' ),
				   'section'    => 'post_page',
				   'settings'   => 'post_title_padding_bottom',
				   'type'    	=> 'slider',
				   'choices'    =>  array(
										'min' => '0',
										'max' => '200',
										'step' => '10',
									)

			   )
		   )
		);

		//Search and Archive Pages Layout Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'search_grid_type' , array('type' => 'option', 'default' => 'grid', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'search_sidebar_layout' , array('type' => 'option','default' => 'none', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'search_sidebar' , array('type' => 'option', 'default'     => 'blog_sidebar2','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'search_layout' , array('type' => 'option','default' => '3col', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Search and Archive Pages Layout Settings Controls

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'search_grid_type',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Type', 'pryaniktheme' ),
				   'section'    => 'search',
				   'settings'   => 'search_grid_type',
				   'choices'        => array(
						'list'   => __( 'List', 'pryaniktheme' ),
						'grid'  => __( 'Grid', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'search_sidebar_layout',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Search and archive pages sidebar layout', 'pryaniktheme' ),
				   'section'    => 'search',
				   'settings'   => 'search_sidebar_layout',
				   'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' ),
						'none'  => __( 'None', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'search_sidebar',
			   array(
				   	'priority' => 3,
				   	'label'      => __( 'Select sidebar for search and archive pages', 'pryaniktheme' ),
				   	'section'    => 'search',
				   	'settings'   => 'search_sidebar',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'search_layout',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Search and archive pages layout( for grid type )', 'pryaniktheme' ),
				   'section'    => 'search',
				   'settings'   => 'search_layout',
				   'choices'        => array(
						'2col'   => __( '2 Columns', 'pryaniktheme' ),
						'3col'  => __( '3 Columns', 'pryaniktheme' )
					)
			   )
		   )
		);

		//Category Pages Layout Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'category_type' , array('type' => 'option', 'default' => 'grid', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'category_sidebar_layout' , array('type' => 'option','default' => 'right', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'category_sidebar' , array('type' => 'option', 'default'     => 'blog_sidebar3','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'category_layout' , array('type' => 'option','default' => '2col', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'category_pagination' , array('type' => 'option', 'default' => 'short', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Blog Layout Settings Controls

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'category_type',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Category pages type', 'pryaniktheme' ),
				   'section'    => 'category',
				   'settings'   => 'category_type',
				   'choices'        => array(
						'list'   => __( 'List', 'pryaniktheme' ),
						'grid'  => __( 'Grid', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'category_sidebar_layout',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Category pages sidebar layout', 'pryaniktheme' ),
				   'section'    => 'category',
				   'settings'   => 'category_sidebar_layout',
				   'choices'        => array(
						'left'   => __( 'Left', 'pryaniktheme' ),
						'right'  => __( 'Right', 'pryaniktheme' ),
						'none'  => __( 'None', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'category_sidebar',
			   array(
				   	'priority' => 3,
				   	'label'      => __( 'Select sidebar for category pages', 'pryaniktheme' ),
				   	'section'    => 'category',
				   	'settings'   => 'category_sidebar',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'category_layout',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Category pages layout( for grid type )', 'pryaniktheme' ),
				   'section'    => 'category',
				   'settings'   => 'category_layout',
				   'choices'        => array(
						'2col'   => __( '2 Columns', 'pryaniktheme' ),
						'3col'  => __( '3 Columns', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'category_pagination',
				array(
					'priority' => 5,
					'label'          => __( 'Category pages pagination type', 'pryaniktheme' ),
					'section'        => 'category',
					'settings'       => 'category_pagination',
					'type'           => 'radio',
					'choices'        => array(
						'short'   => __( 'Older/Newer posts', 'pryaniktheme' ),
						'default'  => __( 'Classic pagination', 'pryaniktheme' )
					)
				)
			)
		);

		//Post Settings Section

		$wp_customize->add_setting( 'show_title' , array('type' => 'option', 'default'     => 'always','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'show_content' , array('type' => 'option', 'default'     => 'always','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'show_counters' , array('type' => 'option', 'default'     => 'always','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'show_share' , array('type' => 'option', 'default'     => 'always','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'show_related' , array('type' => 'option', 'default'     => 'post','transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		$wp_customize->add_setting( 'show_author' , array('type' => 'option', 'default'     => true,'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'hide_nav' , array('type' => 'option', 'default'     => false,'transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Post Settings Controls

		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'show_title',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'Show post title', 'pryaniktheme' ),
		            'section'        => 'post_settings',
		            'settings'       => 'show_title',
		            'type'           => 'select',
		            'choices'        => array(	'always' => __("Always", 'pryaniktheme' ),
		            							'post' => __("Only on Post page", 'pryaniktheme' ),
		            							'never' => __("Never show", 'pryaniktheme' ))
		        )
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'show_content',
		        array(
		        	'priority' => 2,
		            'label'          => __( 'Show post content', 'pryaniktheme' ),
		            'section'        => 'post_settings',
		            'settings'       => 'show_content',
		            'type'           => 'select',
		            'choices'        => array(	'always' => __("Always", 'pryaniktheme' ),
		            							'post' => __("Only on Post page", 'pryaniktheme' ),
		            							'never' => __("Never show", 'pryaniktheme' ))
		        )
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'show_counters',
		        array(
		        	'priority' => 3,
		            'label'          => __( 'Show post counters', 'pryaniktheme' ),
		            'section'        => 'post_settings',
		            'settings'       => 'show_counters',
		            'type'           => 'select',
		            'choices'        => array(	'always' => __("Always", 'pryaniktheme' ),
		            							'post' => __("Only on Post page", 'pryaniktheme' ),
		            							'never' => __("Never show", 'pryaniktheme' ))
		        )
		    )
		);
		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'show_share',
		        array(
		        	'priority' => 4,
		            'label'          => __( 'Show post share options', 'pryaniktheme' ),
		            'section'        => 'post_settings',
		            'settings'       => 'show_share',
		            'type'           => 'select',
		            'choices'        => array(	'always' => __("Always", 'pryaniktheme' ),
		            							'post' => __("Only on Post page", 'pryaniktheme' ),
		            							'never' => __("Never show", 'pryaniktheme' ))
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'show_related',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Show related posts on post page', 'pryaniktheme' ),
	               'section'    => 'post_settings',
	               'settings'   => 'show_related',
	               'type'           => 'select',
		           'choices'        => array(	'always' => __("Always", 'pryaniktheme' ),
		            							'post' => __("Only on Post page", 'pryaniktheme' ),
		            							'never' => __("Never show", 'pryaniktheme' ))
	           )
	       )
	   	);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'show_author',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Show author block on post page', 'pryaniktheme' ),
	               'section'    => 'post_settings',
	               'settings'   => 'show_author',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'hide_nav',
	           array(
	           	   'priority' => 7,
	               'label'      => __( 'Hide post navigation on post page', 'pryaniktheme' ),
	               'section'    => 'post_settings',
	               'settings'   => 'hide_nav',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);

		//Background Settings Section

		$wp_customize->add_setting( 'background_color' , array('type' => 'option', 'default'     => '#fff','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'background_stretch' , array('type' => 'option', 'default'     => 'false','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'background_image' , array('type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'background_repeat' , array('type' => 'option', 'default'     => 'repeat','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'background_position' , array('type' => 'option', 'default'     => 'center','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'background_attachment' , array('type' => 'option', 'default'     => 'fixed','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

		//Background Settings Controls

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'background_color', 
			array(
				'priority' => 1,
				'label'      => __( 'Background color', 'pryaniktheme' ),
				'section'    => 'background_settings',
				'settings'   => 'background_color',
			) ) 
		);

		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'background_stretch',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Background Image Stretch', 'pryaniktheme' ),
	               'section'    => 'background_settings',
	               'settings'   => 'background_stretch',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);

	   	$wp_customize->add_control(
	       new WP_Customize_Image_Control(
	           $wp_customize,
	           'background_image',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Upload background image', 'pryaniktheme' ),
	               'section'    => 'background_settings',
	               'settings'   => 'background_image'
	           )
	       )
	   	);

	   	$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'background_repeat1',
		        array(
		        	'priority' => 4,
		            'label'          => __( 'Background Repeat', 'pryaniktheme' ),
		            'section'        => 'background_settings',
		            'settings'       => 'background_repeat',
		            'type'           => 'select',
		            'choices'        => array('no-repeat' => __("No Repeat", 'pryaniktheme' ),
		            							'repeat' => __("Tile", 'pryaniktheme' ),
		            							'repeat-x' => __("Tile Horizontally", 'pryaniktheme' ),
		            							'repeat-y' => __("Tile Vertically", 'pryaniktheme' ))
		        )
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'background_position',
		        array(
		        	'priority' => 5,
		            'label'          => __( 'Background Position', 'pryaniktheme' ),
		            'section'        => 'background_settings',
		            'settings'       => 'background_position',
		            'type'           => 'select',
		            'choices'        => array('left' => __("Left", 'pryaniktheme' ),
		            							'center' => __("Center", 'pryaniktheme' ),
		            							'right' => __("Right", 'pryaniktheme' ))
		        )
		    )
		);

		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'background_attachment1',
		        array(
		        	'priority' => 6,
		            'label'          => __( 'Background Attachment', 'pryaniktheme' ),
		            'section'        => 'background_settings',
		            'settings'       => 'background_attachment',
		            'type'           => 'select',
		            'choices'        => array('fixed' => __("Fixed", 'pryaniktheme' ),
		            							'scroll' => __("Scroll", 'pryaniktheme' ))
		        )
		    )
		);

		//Colors Settings Section

		$wp_customize->add_setting( 'skin_color1' , array('type' => 'option', 'default'     => '#cea97c','transport'   => 'refresh','sanitize_callback' => 'esc_html') );		
		$wp_customize->add_setting( 'skin_color2' , array('type' => 'option', 'default'     => '#f51746','transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Colors Settings Controls

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'skin_color1', 
			array(
				'priority' => 1,
				'label'      => __( 'Skin Color 1', 'pryaniktheme' ),
				'section'    => 'color_settings',
				'settings'   => 'skin_color1',
			) ) 
		);
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'skin_color2', 
			array(
				'priority' => 2,
				'label'      => __( 'Skin Color 2', 'pryaniktheme' ),
				'section'    => 'color_settings',
				'settings'   => 'skin_color2',
			) ) 
		);

		//Typography Settings Section

		$wp_customize->add_setting( 'body_font_family' , array('type' => 'option', 'default'     => 'Hind','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'body_font_size' , array('type' => 'option', 'default'     => 14,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

		$wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'body_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'Body Text Font family', 'pryaniktheme' ),
		            'section'        => 'body',
		            'settings'       => 'body_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'body_font_size',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'body',
	               'settings'   => 'body_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);

	   	$wp_customize->add_setting( 'h1_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h1_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h1_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h1_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h1_font_size' , array('type' => 'option', 'default'     => 60,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h1_letterspacing' , array('type' => 'option', 'default'     => -1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h1_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H1 Font family', 'pryaniktheme' ),
		            'section'        => 'h1',
		            'settings'       => 'h1_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h1_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h1',
	               'settings'   => 'h1_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h1_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h1',
	               'settings'   => 'h1_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h1_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h1',
	               'settings'   => 'h1_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h1_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h1',
	               'settings'   => 'h1_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h1_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h1',
	               'settings'   => 'h1_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

        $wp_customize->add_setting( 'h2_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h2_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h2_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h2_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h2_font_size' , array('type' => 'option', 'default'     => 36,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h2_letterspacing' , array('type' => 'option', 'default'     => -1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h2_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H2 Font family', 'pryaniktheme' ),
		            'section'        => 'h2',
		            'settings'       => 'h2_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h2_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h2',
	               'settings'   => 'h2_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h2_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h2',
	               'settings'   => 'h2_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h2_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h2',
	               'settings'   => 'h2_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h2_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h2',
	               'settings'   => 'h2_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h2_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h2',
	               'settings'   => 'h2_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

        $wp_customize->add_setting( 'h3_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h3_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h3_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h3_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h3_font_size' , array('type' => 'option', 'default'     => 24,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h3_letterspacing' , array('type' => 'option', 'default'     => -1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h3_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H3 Font family', 'pryaniktheme' ),
		            'section'        => 'h3',
		            'settings'       => 'h3_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h3_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h3',
	               'settings'   => 'h3_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h3_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h3',
	               'settings'   => 'h3_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h3_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h3',
	               'settings'   => 'h3_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h3_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h3',
	               'settings'   => 'h3_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h3_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h3',
	               'settings'   => 'h3_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

        $wp_customize->add_setting( 'h4_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h4_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h4_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h4_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h4_font_size' , array('type' => 'option', 'default'     => 18,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h4_letterspacing' , array('type' => 'option', 'default'     => -1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h4_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H4 Font family', 'pryaniktheme' ),
		            'section'        => 'h4',
		            'settings'       => 'h4_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h4_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h4',
	               'settings'   => 'h4_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h4_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h4',
	               'settings'   => 'h4_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h4_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h4',
	               'settings'   => 'h4_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h4_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h4',
	               'settings'   => 'h4_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h4_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h4',
	               'settings'   => 'h4_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

        $wp_customize->add_setting( 'h5_font_family' , array('type' => 'option', 'default'     => 'Montserrat','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h5_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h5_text_transform' , array('type' => 'option', 'default'     => true,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h5_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h5_font_size' , array('type' => 'option', 'default'     => 14,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h5_letterspacing' , array('type' => 'option', 'default'     => 1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h5_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H5 Font family', 'pryaniktheme' ),
		            'section'        => 'h5',
		            'settings'       => 'h5_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h5_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h5',
	               'settings'   => 'h5_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h5_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h5',
	               'settings'   => 'h5_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h5_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h5',
	               'settings'   => 'h5_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h5_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h5',
	               'settings'   => 'h5_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h5_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h5',
	               'settings'   => 'h5_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

        $wp_customize->add_setting( 'h6_font_family' , array('type' => 'option', 'default'     => 'Playfair Display','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h6_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h6_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h6_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h6_font_size' , array('type' => 'option', 'default'     => 12,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
        $wp_customize->add_setting( 'h6_letterspacing' , array('type' => 'option', 'default'     => -1,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );

        $wp_customize->add_control(
		    new WP_Customize_Control(
		        $wp_customize,
		        'h6_font_family',
		        array(
		        	'priority' => 1,
		            'label'          => __( 'H6 Font family', 'pryaniktheme' ),
		            'section'        => 'h6',
		            'settings'       => 'h6_font_family',
		            'type'           => 'select',
		            'choices'        => pryanik_list_fonts()
		        )
		    )
		);
		$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h6_font_weight',
	           array(
	           	   'priority' => 2,
	               'label'      => __( 'Bold', 'pryaniktheme' ),
	               'section'    => 'h6',
	               'settings'   => 'h6_font_weight',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h6_text_transform',
	           array(
	           	   'priority' => 3,
	               'label'      => __( 'Uppercase', 'pryaniktheme' ),
	               'section'    => 'h6',
	               'settings'   => 'h6_text_transform',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new WP_Customize_Control(
	           $wp_customize,
	           'h6_italic',
	           array(
	           	   'priority' => 4,
	               'label'      => __( 'Italic', 'pryaniktheme' ),
	               'section'    => 'h6',
	               'settings'   => 'h6_italic',
	               'type'    => 'checkbox' 
	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h6_font_size',
	           array(
	           	   'priority' => 5,
	               'label'      => __( 'Font size', 'pryaniktheme' ),
	               'section'    => 'h6',
	               'settings'   => 'h6_font_size',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_size

	           )
	       )
	   	);
	   	$wp_customize->add_control(
	       new Pryanik_Customize_Slider_Control(
	           $wp_customize,
	           'h6_letterspacing',
	           array(
	           	   'priority' => 6,
	               'label'      => __( 'Letterspacing', 'pryaniktheme' ),
	               'section'    => 'h6',
	               'settings'   => 'h6_letterspacing',
	               'type'    	=> 'slider',
	               'choices'    =>  $range_font_spacing

	           )
	       )
	   	);

	   	//Buttons Style Settings Section

		$wp_customize->add_setting( 'buttons_font_family' , array('type' => 'option', 'default'     => 'Hind','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_font_weight' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_text_transform' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_italic' , array('type' => 'option', 'default'     => false,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_xs_font_size' , array('type' => 'option', 'default'     => 10,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_sm_font_size' , array('type' => 'option', 'default'     => 12,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_font_size' , array('type' => 'option', 'default'     => 14,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_lg_font_size' , array('type' => 'option', 'default'     => 18,'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_border_radius' ,  array('default'     => 0,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'buttons_border_width' ,  array('default'     => 1,'type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		
		//Buttons Style Settings Controls

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'buttons_font_family',
				array(
					'priority' => 1,
					'label'          => __( 'Font family', 'pryaniktheme' ),
					'section'        => 'buttons_settings',
					'settings'       => 'buttons_font_family',
					'type'           => 'select',
					'choices'        => pryanik_list_fonts()
				)
			)
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'buttons_font_weight',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Bold', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_font_weight',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'buttons_text_transform',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Uppercase', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_text_transform',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'buttons_italic',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Italic', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_italic',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_xs_font_size',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Extra Small Font size', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_xs_font_size',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_size

			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_sm_font_size',
			   array(
				   'priority' => 6,
				   'label'      => __( 'Small Font size', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_sm_font_size',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_size

			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_font_size',
			   array(
				   'priority' => 7,
				   'label'      => __( 'Default Font size', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_font_size',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_size

			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_lg_font_size',
			   array(
				   'priority' => 8,
				   'label'      => __( 'Latge Font size', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_lg_font_size',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_font_size

			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_border_radius',
			   array(
				   'priority' => 9,
				   'label'      => __( 'Button Border Radius', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_border_radius',
				   'type'    	=> 'slider',
				   'choices'    =>  $range_radius
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Customize_Slider_Control(
			   $wp_customize,
			   'buttons_border_width',
			   array(
				   'priority' => 10,
				   'label'      => __( 'Button Border Width', 'pryaniktheme' ),
				   'section'    => 'buttons_settings',
				   'settings'   => 'buttons_border_width',
				   'type'    	=> 'slider',
				   'choices'    =>  array(
										'min' => '0',
										'max' => '10',
										'step' => '1',
									)
			   )
		   )
		);
	
		//Custom Slider Settings Section

		$wp_customize->add_setting( 'slider_shortcode' , array('type' => 'option', 'default' => '', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );

		//Custom Slider Settings Controls

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'slider_shortcode',
			   array(
				   'priority' => 1,
				   'label'      => __( 'You can put Master Slider or third-party plugin shortcode here to add slider on home page.', 'pryaniktheme' ),
				   'section'    => 'custom_slider',
				   'settings'   => 'slider_shortcode'
			   )
		   )
		);

		//Footer Settings Section

		//General Footer Settings Section

		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}

		$wp_customize->add_setting( 'footer_color' , array('type' => 'option', 'default'     => '#222','transport'   => 'postMessage','sanitize_callback' => 'sanitize_hex_color') );
		$wp_customize->add_setting( 'footer_widgets_color' , array('type' => 'option', 'default'     => 'dark','transport'   => 'postMessage','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'footer_widgets' , array('type' => 'option', 'default'     => 'footer_widgets1','transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'footer_layout' , array('type' => 'option','default' => '3col', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'copyright_text' , array('type' => 'option', 'default' => '© ' . date('Y') . ' Pryanik', 'transport'   => 'postMessage','sanitize_callback' => 'wp_kses_post') );
		$wp_customize->add_setting( 'upload_footer_logo' , array('type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_setting( 'upload_footer_logo2x' , array('type' => 'option', 'transport'   => 'postMessage','sanitize_callback' => 'esc_url_raw') );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
			$wp_customize,
			'footer_color',
			array(
				'priority' => 1,
				'label'      => __( 'Footer color', 'pryaniktheme' ),
				'section'    => 'footer_settings',
				'settings'   => 'footer_color',
			) )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'footer_widgets_color',
			   array(
				   	'priority' => 2,
				   	'label'      => __( 'Select widgets color theme', 'pryaniktheme' ),
				   	'section'    => 'footer_settings',
				   	'settings'   => 'footer_widgets_color',
				   	'type'           => 'radio',
					'choices'        => array(
						'light'   => __( 'Light', 'pryaniktheme' ),
						'dark'  => __( 'Dark', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
			   $wp_customize,
			   'footer_widgets',
			   array(
				   	'priority' => 3,
				   	'label'      => __( 'Select footer widgets', 'pryaniktheme' ),
				   	'section'    => 'footer_settings',
				   	'settings'   => 'footer_widgets',
				   	'type'           => 'select',
					'choices'        => $sidebar_options
			   )
		   )
		);

		$wp_customize->add_control(
		   new Pryanik_Site_Layout_Picker_Custom_Control(
			   $wp_customize,
			   'footer_layout',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Footer widgets layout', 'pryaniktheme' ),
				   'section'    => 'footer_settings',
				   'settings'   => 'footer_layout',
				   'choices'        => array(
						'2col'   => __( '2 Col', 'pryaniktheme' ),
						'3col'  => __( '3 Col', 'pryaniktheme' ),
						'4col'  => __( '4 Col', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'copyright_text',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Add Copyright Text', 'pryaniktheme' ),
				   'section'    => 'footer_settings',
				   'settings'   => 'copyright_text'
			   )
		   )
		);
	
		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_footer_logo',
			   array(
				   'priority' => 6,
				   'label'      => __( 'Upload footer logo', 'pryaniktheme' ),
				   'section'    => 'footer_settings',
				   'settings'   => 'upload_footer_logo'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Image_Control(
			   $wp_customize,
			   'upload_footer_logo2x',
			   array(
				   'priority' => 7,
				   'label'      => __( 'Upload footer logo @2x.', 'pryaniktheme' ),
				   'section'    => 'footer_settings',
				   'settings'   => 'upload_footer_logo2x'
			   )
		   )
		);

		//Footer Instagram Widget Section

		$wp_customize->add_setting( 'add_instagram_fullwidth' , array('default'     => false,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'instagram_user' , array('type' => 'option', 'default' => '', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'instagram_cols' , array('type' => 'option','default' => '8', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'instagram_rows' , array('type' => 'option','default' => '1', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );
		$wp_customize->add_setting( 'add_instagram_hover' , array('default'     => false,'type' => 'option', 'transport'   => 'refresh','sanitize_callback' => 'esc_html') );


		//Genereal Header Settings Controls

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'add_instagram_fullwidth',
			   array(
				   'priority' => 1,
				   'label'      => __( 'Add fullwidth footer instagram widget', 'pryaniktheme' ),
				   'section'    => 'footer_instagram',
				   'settings'   => 'add_instagram_fullwidth',
				   'type'    => 'checkbox'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'instagram_user',
			   array(
				   'priority' => 2,
				   'label'      => __( 'Instagram username', 'pryaniktheme' ),
				   'section'    => 'footer_instagram',
				   'settings'   => 'instagram_user'
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'instagram_cols',
			   array(
				   'priority' => 3,
				   'label'      => __( 'Number of columns', 'pryaniktheme' ),
				   'section'    => 'footer_instagram',
				   'settings'   => 'instagram_cols',
				   'type'		=> 'select',
				   'choices'        => array(
						'4'   => __( '4', 'pryaniktheme' ),
						'5'  => __( '5', 'pryaniktheme' ),
						'6'  => __( '6', 'pryaniktheme' ),
						'7'   => __( '7', 'pryaniktheme' ),
						'8'  => __( '8', 'pryaniktheme' ),
						'9'  => __( '9', 'pryaniktheme' ),
						'10'  => __( '10', 'pryaniktheme' ),
						'11'  => __( '11', 'pryaniktheme' ),
						'12'  => __( '12', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'instagram_rows',
			   array(
				   'priority' => 4,
				   'label'      => __( 'Number of rows', 'pryaniktheme' ),
				   'section'    => 'footer_instagram',
				   'settings'   => 'instagram_rows',
				   'type'		=> 'select',
				   'choices'        => array(
						'1'   => __( '1', 'pryaniktheme' ),
						'2'  => __( '2', 'pryaniktheme' )
					)
			   )
		   )
		);

		$wp_customize->add_control(
		   new WP_Customize_Control(
			   $wp_customize,
			   'add_instagram_hover',
			   array(
				   'priority' => 5,
				   'label'      => __( 'Add hover', 'pryaniktheme' ),
				   'section'    => 'footer_instagram',
				   'settings'   => 'add_instagram_hover',
				   'type'    => 'checkbox'
			   )
		   )
		);
	}
 ?>