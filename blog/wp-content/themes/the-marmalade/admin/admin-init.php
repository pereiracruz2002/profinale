<?php 
	
	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Theme Directories
	/*
	/*-----------------------------------------------------------------------------------*/

	define( 'PRYANIK_THEME_DIR', get_template_directory() );
	define( 'PRYANIK_THEME_URI', get_template_directory_uri() );

	define( 'PRYANIK_CHILD_THEME_DIR', get_stylesheet_directory() );
	define( 'PRYANIK_CHILD_THEME_URI', get_stylesheet_directory_uri() );

	if(!defined('PRYANIK_FRAMEWORK_DIR'))
	define( 'PRYANIK_FRAMEWORK_DIR', trailingslashit( trailingslashit( PRYANIK_THEME_DIR ) . 'admin' ) );

	if(!defined('PRYANIK_INC_DIR'))
	define( 'PRYANIK_INC_DIR', trailingslashit( trailingslashit( PRYANIK_THEME_DIR ) . 'includes' ) );

	if(!defined('PRYANIK_FRAMEWORK_URI'))
	define( 'PRYANIK_FRAMEWORK_URI', trailingslashit( trailingslashit( PRYANIK_THEME_URI ) . 'admin' ) );

	if(!defined('PRYANIK_INC_URI'))
	define( 'PRYANIK_INC_URI', trailingslashit( trailingslashit( PRYANIK_THEME_URI ) . 'includes' ) );

	define( 'PRYANIK_CUSTOMIZER_DIR', trailingslashit( trailingslashit( PRYANIK_FRAMEWORK_DIR ) . 'customizer' ) );
	define( 'PRYANIK_CUSTOMIZER_URI', trailingslashit( trailingslashit( PRYANIK_FRAMEWORK_URI ) . 'customizer' ) );
	define( 'PRYANIK_FUNCTION_DIR', trailingslashit( trailingslashit( PRYANIK_FRAMEWORK_DIR ) . 'functions' ) );
	define( 'PRYANIK_CLASS_DIR', trailingslashit( trailingslashit( PRYANIK_FRAMEWORK_DIR ) . 'classes' ) );

	define( 'PRYANIK_TEMPLATES_DIR', trailingslashit( trailingslashit( PRYANIK_INC_DIR ) . 'templates' ) );

	require ( PRYANIK_CUSTOMIZER_DIR . 'theme-customize-init.php');


	if ( ! function_exists( 'pryanik_load_textdomain' ) ) {
		function pryanik_load_textdomain () {
			load_theme_textdomain( 'pryaniktheme' );
			load_theme_textdomain( 'pryaniktheme', get_template_directory() . '/includes/assets/lang' );
			if ( function_exists( 'load_child_theme_textdomain' ) )
				load_child_theme_textdomain( 'pryaniktheme' );
		}
	}
	add_action( 'init', 'pryanik_load_textdomain', 10 );

	function pryanik_get_menu_location_name( $location ) {
		$locations = get_registered_nav_menus();
		return $locations[ $location ];
	}

	function pryanik_get_sidebar_name( $sidebar_id ) {
		global $wp_registered_sidebars;
		if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) )
			return $wp_registered_sidebars[ $sidebar_id ]['name'];
	}

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define CSS
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_theme_customize_ui_styles' ) ) :
	    function pryanik_theme_customize_ui_styles() {
	        wp_register_style('customize-ui', PRYANIK_CUSTOMIZER_URI . 'theme-customize-ui.css', 'all');
	        wp_enqueue_style('customize-ui');
	    }
	endif;
    add_action( 'customize_controls_print_scripts', 'pryanik_theme_customize_ui_styles' );

    if ( ! function_exists( 'pryanik_admin_styles' ) ) :
		function pryanik_admin_styles(){
			wp_enqueue_style('thickbox');
			
			wp_register_style( 'admin_style', PRYANIK_FRAMEWORK_URI . 'admin.css');
		   	wp_enqueue_style('admin_style');
		}
	endif;
	add_action('admin_enqueue_scripts', 'pryanik_admin_styles');

    /*-----------------------------------------------------------------------------------*/
	/*
	/*  Define JS
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_theme_customize_ui' ) ) :
	    function pryanik_theme_customize_ui() {
	        wp_register_script('theme-customize-ui', PRYANIK_CUSTOMIZER_URI . 'theme-customize-ui.js', 'jquery');
	        wp_enqueue_script('theme-customize-ui');
	    }
    endif;
    add_action( 'customize_controls_print_scripts', 'pryanik_theme_customize_ui' );

    /*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Media Uploader, Color Picker
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_enqueue_admin' ) ) :
	    function pryanik_enqueue_admin() {
			wp_enqueue_media();
			wp_enqueue_script('media-upload');
    		wp_enqueue_script('thickbox');
			wp_register_script('pryanik-media-upload', PRYANIK_FRAMEWORK_URI . 'functions/pryanik-media-upload.js', 'jquery');
	        wp_enqueue_script('pryanik-media-upload');

	        wp_register_script('admin', PRYANIK_FRAMEWORK_URI . 'admin.js', 'jquery');
	        wp_enqueue_script('admin');

	        wp_enqueue_script('wp-color-picker');
	    	wp_enqueue_style( 'wp-color-picker' );
		}
	endif;
	add_action( 'admin_enqueue_scripts', 'pryanik_enqueue_admin' );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Convert HEX to RGDA
	/*
	/*-----------------------------------------------------------------------------------*/
	if (!function_exists('pryanik_convert_rgba')) {
	    function pryanik_convert_rgba($color, $opacity) {
	        $color = str_replace("#", "", $color);

	        $r = hexdec(substr($color, 0, 2));
	        $g = hexdec(substr($color, 2, 2));
	        $b = hexdec(substr($color, 4, 2));
	        $a = intval($opacity) / 100;

	        return "rgba($r, $g, $b, $a)";
	    }
	}
 ?>