<?php 

	require_once ( PRYANIK_CUSTOMIZER_DIR . 'theme-customize-controls.php');
	require_once ( PRYANIK_CUSTOMIZER_DIR . 'theme-customize-css.php');

	function pryanik_customizer_live_preview(){
		wp_enqueue_script( 'themecustomizer', PRYANIK_CUSTOMIZER_URI .'theme-customize.js', array( 'jquery','customize-preview' ), true );
	}

	add_action( 'customize_register', 'pryanik_customize_register' );
	add_action( 'wp_head', 'pryanik_custom_css');
	add_action( 'customize_preview_init', 'pryanik_customizer_live_preview' );

?>