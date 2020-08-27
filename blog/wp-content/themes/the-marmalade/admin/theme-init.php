<?php

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Theme Settings
	/*
	/*-----------------------------------------------------------------------------------*/

	require_once ( PRYANIK_FUNCTION_DIR . 'theme-fonts.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'theme-options.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'post-like.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'post-meta.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'page-meta.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'author-meta.php');
	require_once ( PRYANIK_FUNCTION_DIR . 'category-meta.php');

	if ( ! function_exists( 'pryanik_theme_setup' ) ) :

		function pryanik_theme_setup() {
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support('nav-menus');
			add_theme_support( 'post-formats', array('image','gallery','quote','video','audio','link','status','chat'));
	        add_theme_support('custom-background');
	        add_theme_support('custom-header');

			register_nav_menus(array(
	            'header-menu' => __('Header Menu', 'pryaniktheme')
	        ));

	        global $content_width;
	        if ( ! isset( $content_width ) ) $content_width = 750;

	        add_editor_style( PRYANIK_INC_URI . 'css/bootstrap.css' );
	        add_editor_style( PRYANIK_INC_URI . 'css/bootstrap-style.css' );
	        add_editor_style( PRYANIK_INC_URI . 'css/theme-style.css' );

	        load_theme_textdomain('pryaniktheme', get_template_directory() . '/includes/lang');
	    }

	endif;
	add_action('after_setup_theme', 'pryanik_theme_setup', 5);

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Theme Plugins
	/*
	/*-----------------------------------------------------------------------------------*/

	require_once PRYANIK_CLASS_DIR . 'class-tgm-plugin-activation.php';

	if (!function_exists('pryanik_register_required_plugins')) {

	    function pryanik_register_required_plugins() {
	        $plugins = array(
	            array(
	                'name' => 'Pryanik Shortcodes', // The plugin name
	                'slug' => 'pryanik-shortcodes', // The plugin slug (typically the folder name)
	                'source' => PRYANIK_INC_URI . 'plugins/pryanik-shortcodes.zip', // The plugin source
	                'required' => true, // If false, the plugin is only 'recommended' instead of required
	                'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	                'external_url' => '', // If set, overrides default API URL and points to an external URL
	            ),
	            array(
	                'name' => 'Pryanik Widgets', // The plugin name
	                'slug' => 'pryanik-widgets', // The plugin slug (typically the folder name)
	                'source' => PRYANIK_INC_URI . 'plugins/pryanik-widgets.zip', // The plugin source
	                'required' => true, // If false, the plugin is only 'recommended' instead of required
	                'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	                'external_url' => '', // If set, overrides default API URL and points to an external URL
	            ),
		        array(
	                'name' => 'Master Slider', // The plugin name
	                'slug' => 'masterslider', // The plugin slug (typically the folder name)
	                'source' => PRYANIK_INC_URI . 'plugins/masterslider.zip', // The plugin source
	                'required' => true, // If false, the plugin is only 'recommended' instead of required
	                'version' => '2.17.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
	                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
	                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
	                'external_url' => '', // If set, overrides default API URL and points to an external URL
	            ),
	            array(
	                'name' => 'Contact Form 7', // The plugin name
	                'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
	                'required' => false, // If false, the plugin is only 'recommended' instead of required
	            )
	        );


	        /**
	         * Array of configuration settings. Amend each line as needed.
	         * If you want the default strings to be available under your own theme domain,
	         * leave the strings uncommented.
	         * Some of the strings are added into a sprintf, so see the comments at the
	         * end of each line for what each argument will be.
	         */
	        $config = array(
	            //'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
	            'default_path' => '', // Default absolute path to pre-packaged plugins
	            'menu' => 'install-required-plugins', // Menu slug
	            'has_notices' => true, // Show admin notices or not
	            'is_automatic' => false, // Automatically activate plugins after installation or not
	            'message' => '', // Message to output right before the plugins table
	            'strings' => array(
	                'page_title' => __('Install Required Plugins', 'pryaniktheme'),
	                'menu_title' => __('Install Plugins', 'pryaniktheme'),
	                'installing' => __('Installing Plugin: %s', 'pryaniktheme'), // %1$s = plugin name
	                'oops' => __('Something went wrong with the plugin API.', 'pryaniktheme'),
	                'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
	                'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
	                'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
	                'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
	                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
	                'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
	                'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
	                'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
	                'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
	                'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
	                'return' => __('Return to Required Plugins Installer', 'pryaniktheme'),
	                'plugin_activated' => __('Plugin activated successfully.', 'pryaniktheme'),
	                'complete' => __('All plugins installed and activated successfully. %s', 'pryaniktheme'), // %1$s = dashboard link
	                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
	            )
	        );

	        tgmpa($plugins, $config);
	    }
	    add_action('tgmpa_register', 'pryanik_register_required_plugins');
	}

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define CSS
	/*
	/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'pryanik_theme_styles' ) ) :
		function pryanik_theme_styles(){

			wp_register_style( 'bootstrap', PRYANIK_INC_URI . 'css/bootstrap.css');
			wp_register_style( 'navicon', PRYANIK_INC_URI . 'css/navicon.css');
			wp_register_style( 'owlcarousel', PRYANIK_INC_URI . 'css/owl.carousel.css');
			wp_register_style( 'bootstrap-style', PRYANIK_INC_URI . 'css/bootstrap-style.css');
			wp_register_style( 'font-awesome', PRYANIK_INC_URI .'fonts/font-awesome/css/font-awesome.min.css');
			wp_register_style( 'flaticon', PRYANIK_INC_URI . 'fonts/flaticon/flaticon.css');
			wp_register_style( 'themestyle', PRYANIK_INC_URI . 'css/theme-style.css');
			wp_register_style( 'style', PRYANIK_THEME_URI . '/style.css');

			wp_enqueue_style( 'bootstrap');
			wp_enqueue_style( 'navicon');
			wp_enqueue_style( 'owlcarousel');
			wp_enqueue_style( 'bootstrap-style');
			wp_enqueue_style( 'font-awesome');
			wp_enqueue_style( 'flaticon');
			wp_enqueue_style( 'themestyle');
			wp_enqueue_style( 'style');

		}
	endif;
	add_action( 'wp_enqueue_scripts', 'pryanik_theme_styles', 10 );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define jQuery
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_theme_js' ) ) :
		function pryanik_theme_js(){
			wp_enqueue_script( 'bootstrap-js', PRYANIK_INC_URI . 'js/bootstrap.min.js', array('jquery'), '', true );
			wp_enqueue_script( 'modernizr-js', PRYANIK_INC_URI . 'js/modernizr.custom.js', array('jquery'), '', true );
			wp_enqueue_script( 'classie-js', PRYANIK_INC_URI . 'js/classie.js', array('jquery'), '', true );
			wp_enqueue_script( 'fitvids-js', PRYANIK_INC_URI . 'js/jquery.fitvids.js', array('jquery'), '', true );
			

			if (is_home() || is_archive() || is_single() || is_page() || is_search()) {
				wp_enqueue_script( 'bxslider-js', PRYANIK_INC_URI . 'js/jquery.bxslider.js', array('jquery'), '', true );
				wp_enqueue_script( 'grid-gallery-js', PRYANIK_INC_URI . 'js/cbpGridGallery.js', array('jquery'), '', true );
				wp_enqueue_script( 'image-loaded-js', PRYANIK_INC_URI . 'js/imagesloaded.pkgd.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'masonry-js', PRYANIK_INC_URI . 'js/masonry.pkgd.min.js', array('jquery'), '', true );

				wp_enqueue_script( 'owlcarousel-js', PRYANIK_INC_URI . 'js/owl.carousel.min.js', array('jquery'), '', true );
				wp_enqueue_script( 'player-js', PRYANIK_INC_URI . 'js/pryanik.player.js', array('jquery'), '', true );
			}

			wp_enqueue_script( 'resize-stop-js', PRYANIK_INC_URI . 'js/jquery.resizestop.min.js', array('jquery'), '', true );

	    	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	        	wp_enqueue_script( 'comment-reply' );
	    	}

			wp_enqueue_script( 'theme-js', PRYANIK_INC_URI . 'js/theme.js', array('jquery'), '', true );
		}
	endif;
	add_action( 'wp_enqueue_scripts', 'pryanik_theme_js' );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Add Likes Script
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_like_scripts' ) ) :
		function pryanik_like_scripts() {
			wp_enqueue_script( 'jm_like_post', PRYANIK_INC_URI .'js/post-like.js', array('jquery'), '1.0', 1 );
			wp_localize_script( 'jm_like_post', 'ajax_var', array(
				'url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'ajax-nonce' )
				)
			);
		}
	endif;
	add_action( 'wp_enqueue_scripts', 'pryanik_like_scripts' );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Register Sidebars
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_register_sidebars' ) ) :
		function pryanik_register_sidebars() {

			register_sidebar( array(
				'name' => __('Blog Sidebar 1', 'pryaniktheme' ),
				'id' => 'blog_sidebar1',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Blog Sidebar 2', 'pryaniktheme' ),
				'id' => 'blog_sidebar2',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Blog Sidebar 3', 'pryaniktheme' ),
				'id' => 'blog_sidebar3',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Post Sidebar 1', 'pryaniktheme' ),
				'id' => 'post_sidebar1',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Post Sidebar 2', 'pryaniktheme' ),
				'id' => 'post_sidebar2',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Post Sidebar 3', 'pryaniktheme' ),
				'id' => 'post_sidebar3',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Footer Widgets 1', 'pryaniktheme' ),
				'id' => 'footer_widgets1',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Footer Widgets 2', 'pryaniktheme' ),
				'id' => 'footer_widgets2',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
			register_sidebar( array(
				'name' => __('Footer Widgets 3', 'pryaniktheme' ),
				'id' => 'footer_widgets3',
				'before_widget' => '<li id="%1$s" class="widget %2$s col-md-12 col-sm-6 col-xs-12">',
				'after_widget' => '</li>',
				'before_title' => '<div class="widget-title"><h5>',
				'after_title' => '</h5></div>'
			) );
		}
	endif;
	add_action( 'widgets_init', 'pryanik_register_sidebars' );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Comments
	/*
	/*-----------------------------------------------------------------------------------*/
	if ( ! function_exists( 'pryanik_comment_callback' ) ) :
		function pryanik_comment_callback($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment;?>
			<li class="comment" id="comment-<?php echo esc_attr($comment->comment_ID); ?>">
				<?php echo get_avatar( $comment, 90 );?>
				<div class="comment-meta">
					<?php if (get_comment_author_url()) { ?>
						<p class="comment-author"><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></p>
					<?php }else{ ?>
						<p class="comment-author"><?php comment_author(); ?></p>
					<?php } ?>
					<p class="comment-date"><?php comment_date(__('j/m/Y','pryaniktheme')); ?></p>
					<div class="comment-text"><?php comment_text(); ?></div>
					<?php comment_reply_link( array_merge( $args, array(
							 'reply_text' => __( 'Reply', 'pryaniktheme' ),
							 'depth' => $depth,
							 'max_depth' => $args['max_depth']
							 ) ) ); ?>
				</div>
	 	<?php
		}
	endif;

	if ( ! function_exists( 'pryanik_add_comment_author_to_reply_link' ) ) :
		function pryanik_add_comment_author_to_reply_link($link, $args, $comment){
		    $comment = get_comment( $comment );
		    if ( empty($comment->comment_author) ) {
		        if (!empty($comment->user_id)){
		            $user=get_userdata($comment->user_id);
		            $author=$user->user_login;
		        }else{
		            $author = __('Anonymous', 'pryaniktheme');
		        }
		    }else{
		        $author = $comment->comment_author;
		    }
		    if(strpos($author, ' ')){
		        $author = substr($author, 0, strpos($author, ' '));
		    }
		    $reply_link_text = $args['reply_text'];
		    $link = str_replace($reply_link_text, __('Reply to ','pryaniktheme') . $author, $link);
		    return $link;
		}
	endif;
	add_filter('comment_reply_link', 'pryanik_add_comment_author_to_reply_link', 10, 3);

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Comment Form
	/*
	/*-----------------------------------------------------------------------------------*/


	if ( ! function_exists( 'pryanik_comment_form_fields' ) ) :
		function pryanik_comment_form_fields( $fields ) {
		    $commenter = wp_get_current_commenter();

		    $req      = get_option( 'require_name_email' );
		    $aria_req = ( $req ? " aria-required='true'" : '' );
		    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

		    $fields   =  array(
		        'author' => '<div class="row">
		        				<div class="col-md-6 col-sm-12 col-xs-12">
						    		<input type="text" id="author" name="author" class="form-control" placeholder="' . __( 'Name', 'pryaniktheme' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
						    	</div>',
				'email' => '<div class="col-md-6 col-sm-12 col-xs-12">
						    		<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' class="form-control" placeholder="' . __( 'Email', 'pryaniktheme' ) . ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
						   		</div>
						    </div>',
				'url'    => '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
					    		<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' class="form-control" placeholder="' . __( 'Website', 'pryaniktheme' ) . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . ' />
					   		</div>
					    </div>'


			);
		    return $fields;
		}
	endif;
	add_filter( 'comment_form_default_fields', 'pryanik_comment_form_fields' );


	if ( ! function_exists( 'pryanik_comment_form_textarea' ) ) :
		function pryanik_comment_form_textarea( $args ) {
		    $args['comment_field'] = '<textarea class="form-control" id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', 'pryaniktheme' ) . '*" rows="8" aria-required="true"></textarea>';
		    return $args;
		}
	endif;
	add_filter( 'comment_form_defaults', 'pryanik_comment_form_textarea' );

	if ( ! function_exists( 'pryanik_comment_button' ) ) :
		function pryanik_comment_button() {
		    echo '<button type="submit" class="btn btn-default btn-hover">' . __( 'Submit', 'pryaniktheme' ) . '</button>';
		}
	endif;
	add_action('comment_form', 'pryanik_comment_button' );

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Read More Settings
	/*
	/*-----------------------------------------------------------------------------------*/

	function pryanik_new_excerpt_more($more) {
	    global $post;
		return ' ... ';
	}
	add_filter('excerpt_more', 'pryanik_new_excerpt_more');
 ?>
