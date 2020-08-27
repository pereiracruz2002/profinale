<?php
/* Plugin Name: Pryanik Shortcodes Plugin
Description: A WordPress plugin that will add a button to the tinyMCE editor to add shortcodes
Author: Pryanik
Version: 1.0
License: GPL2
*/
if ( ! class_exists( 'Pryanik_Shortcodes' ) ) :

	class Pryanik_Shortcodes {

	    function __construct(){
	    	require_once( plugin_dir_path( __FILE__ ) .'pryanik-shortcodes-output.php' );

	    	define('SHORTCODES_URI', plugin_dir_url( __FILE__ ) );
			define('SHORTCODES_DIR', plugin_dir_path( __FILE__ ) );

	        add_action('init', array(&$this, 'init'));
	        add_action('admin_init', array(&$this, 'admin_init'));
	       	add_action('admin_enqueue_scripts', array(&$this, 'print_shortcode_scripts'));
		}
		
		/*--------------------------------------------------------------------*/
		/*
		/*	Register
		/*
		/*--------------------------------------------------------------------*/

		function init(){
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) { return; }

			if ( get_user_option('rich_editing') == 'true' ) {
				add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
				add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
			}
		}

		/*--------------------------------------------------------------------*/
		/*
		/*	Print shortcode scripts in footer only if needed
		/*
		/*--------------------------------------------------------------------*/

		function print_shortcode_scripts(){
			global $add_shortcode_scripts;
			if ( ! $add_shortcode_scripts ){
				return;
			}else{
				wp_enqueue_scripts('shortcodes-css');
				wp_enqueue_scripts('shortcodes-js');
			}
		}

		/*--------------------------------------------------------------------*/
		/*
		/*	Add TinyMCE rich editor buttons
		/*
		/*--------------------------------------------------------------------*/

		function add_rich_plugins( $plugin_array ){
			$plugin_array['shortcodes'] = SHORTCODES_URI . 'main.js';
			return $plugin_array;
		}

		/*--------------------------------------------------------------------*/
		/*
		/*	Register TinyMCE rich editor buttons
		/*
		/*--------------------------------------------------------------------*/	

		function register_rich_buttons( $buttons ){
			array_push( $buttons, 'shortcodes' );
			return $buttons;
		}

		/*--------------------------------------------------------------------*/
		/*
		/*	Enqueue Admin Scripts and Styles
		/*
		/*--------------------------------------------------------------------*/

		function admin_init(){
			wp_enqueue_style( 'tinymce-css', SHORTCODES_URI . 'style.css', true, '1.0', 'all' );
		}
	}

	$shortcodes = new Pryanik_Shortcodes();
	endif;
?>