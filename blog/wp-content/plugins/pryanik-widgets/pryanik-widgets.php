<?php
/*
Plugin Name: Pryanik Widget Plugin
Description: A plugin that adds bunch of custom widgets(Twitter, Facebook, Instagram, Flickr, Recent Posts, Social Links)
Version: 1.1.1
Author: Pryanik
License: GPL2
*/

class Pryanik_Social_Links_Widget extends WP_Widget {

	public $icons = array(
		'facebook' => 'fa-facebook',
		'instagram' => 'fa-instagram',
		'twitter' => 'fa-twitter',
		'google_plus' => 'fa-google-plus',
		'behance' => 'fa-behance',
		'dribbble' => 'fa-dribbble',
		'linked_in' => 'fa-linkedin',
		'pinterest' => 'fa-pinterest',
		'youtube' => 'fa-youtube-play',
		'tumblr' => 'fa-tumblr',
		'flickr' => 'fa-flickr',
		'bloglovin' => 'fa-heart',
		'email' => 'fa-envelope-o',
		'rss' => 'fa-rss',
		'github' => 'fa-git',
		'skype' => 'fa-skype',
		'vkontakte' => 'fa-vk',
		'digg' => 'fa-digg',
		'dropbox' => 'fa-dropbox',
		'soundcloud' => 'fa-soundcloud');
	public $titles = array(
		'facebook' => 'Facebook',
		'instagram' => 'Instagram',
		'twitter' => 'Twitter',
		'google_plus' => 'Google+',
		'behance' => 'Behance',
		'dribbble' => 'Dribbble',
		'linked_in' => 'LinkedIn',
		'pinterest' => 'Pinterest',
		'youtube' => 'Youtube',
		'tumblr' => 'Tumblr',
		'flickr' => 'Flickr',
		'bloglovin' => "Bloglovin'",
		'email' => 'Email',
		'rss' => 'RSS',
		'github' => 'Github',
		'skype' => 'Skype',
		'vkontakte' => 'VK',
		'digg' => 'Digg',
		'dropbox' => 'Dropbox',
		'soundcloud' => 'SoundCloud');

	public function __construct() {
		$widget_ops = array('classname' => 'widget_social', 'description' => __( 'Add your social accounts','pryaniktheme' ) );
		parent::__construct('Pryanik_Social_Links_Widget', __( 'Pryanik Social Links Widget', 'pryaniktheme' ), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$values['facebook'] = $instance['facebook'];
		$values['instagram'] = $instance['instagram'];
		$values['twitter'] = $instance['twitter'];
		$values['google_plus'] = $instance['google_plus'];
		$values['behance'] = $instance['behance'];
		$values['dribbble'] = $instance['dribbble'];
		$values['linked_in'] = $instance['linked_in'];
		$values['pinterest'] = $instance['pinterest'];
		$values['youtube'] = $instance['youtube'];
		$values['tumblr'] = $instance['tumblr'];
		$values['flickr'] = $instance['flickr'];
		$values['bloglovin'] = $instance['bloglovin'];
		$values['email'] = $instance['email'];
		$values['rss'] = $instance['rss'];
		$values['github'] = $instance['github'];
		$values['skype'] = $instance['skype'];
		$values['vkontakte'] = $instance['vkontakte'];
		$values['digg'] = $instance['digg'];
		$values['dropbox'] = $instance['dropbox'];
		$values['soundcloud'] = $instance['soundcloud'];

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post($args['before_widget']);
		if ( $title ) {
			echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);
		}
		?>
		<ul class='list-inline'>
		<?php 
		foreach ($this->icons as $arg => $value) {
			if (!empty($values[$arg]))
				if ($values[$arg] == '#') {
					echo '<li><a href="' . $values[$arg] .'"><i class="fa '. $value .'"></i></a></li>';
				}else{
					if (substr( $values[$arg], 0, 4 ) === "http" || substr( $values[$arg], 0, 7 ) === "http://")  {
						echo '<li><a href="' . $values[$arg] .'"><i class="fa '. $value .'"></i></a></li>';
					}else{
						echo '<li><a href="http://' . $values[$arg] .'"><i class="fa '. $value .'"></i></a></li>';
					}
				}
		} ?>
		</ul>
		<?php 
		echo wp_kses_post($args['after_widget']);
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 	'title' => '', 
																		'facebook' => '',
																		'instagram' => '',
																		'twitter' => '',
																		'google_plus' => '',
																		'behance' => '',
																		'dribbble' => '',
																		'linked_in' => '',
																		'pinterest' => '',
																		'youtube' => '',
																		'tumblr' => '',
																		'flickr' => '',
																		'bloglovin' => '',
																		'email' => '',
																		'rss' => '',
																		'github' => '',
																		'skype' => '',
																		'vkontakte' => '',
																		'digg' => '',
																		'dropbox' => '',
																		'soundcloud' => ''
																	) );
		$instance['title'] = strip_tags($new_instance['title']);

		$instance['facebook'] = $new_instance['facebook'];
		$instance['instagram'] = $new_instance['instagram'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['google_plus'] = $new_instance['google_plus'];
		$instance['behance'] = $new_instance['behance'];
		$instance['dribbble'] = $new_instance['dribbble'];
		$instance['linked_in'] = $new_instance['linked_in'];
		$instance['pinterest'] = $new_instance['pinterest'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['tumblr'] = $new_instance['tumblr'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['bloglovin'] = $new_instance['bloglovin'];
		$instance['email'] = $new_instance['email'];
		$instance['rss'] = $new_instance['rss'];
		$instance['github'] = $new_instance['github'];
		$instance['skype'] = $new_instance['skype'];
		$instance['vkontakte'] = $new_instance['vkontakte'];
		$instance['digg'] = $new_instance['digg'];
		$instance['dropbox'] = $new_instance['dropbox'];
		$instance['soundcloud'] = $new_instance['soundcloud'];

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 	'title' => '', 
																'facebook' => '',
																'instagram' => '',
																'twitter' => '',
																'google_plus' => '',
																'behance' => '',
																'dribbble' => '',
																'linked_in' => '',
																'pinterest' => '',
																'youtube' => '',
																'tumblr' => '',
																'flickr' => '',
																'bloglovin' => '',
																'email' => '',
																'rss' => '',
																'github' => '',
																'skype' => '',
																'vkontakte' => '',
																'digg' => '',
																'dropbox' => '',
																'soundcloud' => ''
															) );
		$title = strip_tags($instance['title']);
		$values['facebook'] = $instance['facebook'];
		$values['instagram'] = $instance['instagram'];
		$values['twitter'] = $instance['twitter'];
		$values['google_plus'] = $instance['google_plus'];
		$values['behance'] = $instance['behance'];
		$values['dribbble'] = $instance['dribbble'];
		$values['linked_in'] = $instance['linked_in'];
		$values['pinterest'] = $instance['pinterest'];
		$values['youtube'] = $instance['youtube'];
		$values['tumblr'] = $instance['tumblr'];
		$values['flickr'] = $instance['flickr'];
		$values['bloglovin'] = $instance['bloglovin'];
		$values['email'] = $instance['email'];
		$values['rss'] = $instance['rss'];
		$values['github'] = $instance['github'];
		$values['skype'] = $instance['skype'];
		$values['vkontakte'] = $instance['vkontakte'];
		$values['digg'] = $instance['digg'];
		$values['dropbox'] = $instance['dropbox'];
		$values['soundcloud'] = $instance['soundcloud'];
		?>
		<p>
			<label class="widefat" for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pryaniktheme' ) ?>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
				name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
				type="text" 
				value="<?php echo esc_attr($title); ?>" />

			</label>
		</p>
		
		<?php foreach ($values as $arg => $value) { ?>
			<p>
				<label class="widefat" for="<?php echo esc_attr($this->get_field_id($arg)); ?>"><?php echo esc_attr($this->titles[$arg]); ?> <?php _e('Link:', 'pryaniktheme' ); ?> 
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id($arg)); ?>" 
					name="<?php echo esc_attr($this->get_field_name($arg)); ?>" 
					type="text" 
					value="<?php echo esc_attr($value); ?>" />
					
				</label>
			</p>
		<?php }
	}
}

class Pryanik_Text_Editor_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_text', 'description' => __('TinyMCE text editor.','pryaniktheme'));
		$control_ops = array('width' => 400, 'height' => 700);
		parent::__construct('Pryanik_Text_Editor_Widget', __('Pryanik TinyMCE Text Widget','pryaniktheme'), $widget_ops, $control_ops);
		
		add_action( 'admin_footer', array( $this, 'enqueue_scripts') );
	}
	
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$strContent = apply_filters( 'the_content', $instance['html'] );
		
		echo trim($strContent) ? $args['before_widget'] : str_replace(' class="', ' class="empty ', $args['before_widget']);
		echo ! empty( $title ) ? $args['before_title'] . $title . $args['after_title'] : ' ' ;?>
		<div class="textwidget"><?php echo ($strContent); ?></div>
		<?php
		echo wp_kses_post($args['after_widget']);
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('', 'pryaniktheme'), 'html' => '' ) );
		if( !$_POST ) wp_print_styles('editor-buttons');
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','pryaniktheme'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<?php 
		if ( class_exists( 'Metabox' ) && is_callable( array( 'Metabox', 'app' ), true ) ) add_filter('teeny_mce_before_init', array( Metabox::app(), 'customTinyMCE' ) );
		
		$field_id = $this->get_field_id( 'html' );
		$field_name = $this->get_field_name( 'html' );
		$html = isset( $instance[ 'html' ] ) ? $instance['html']  : '';
		?>
		
	<div class="widget-mce">
		<br />
		<?php wp_editor( $html, $field_id, array('textarea_name' => $field_name, 'editor_css' => '<style>table.mceToolbar > tbody > tr{transform: scale(0.85,0.85);-ms-transform: scale(0.85,0.85);-webkit-transform: scale(0.85,0.85); transform-origin: 0 0; -moz-transform-origin: 0 0; -webkit-transform-origin: 0 0;}td.mceToolbar span[role=application]{display: block;width: 386px;overflow: hidden;}</style>' ) );?>
		<br />
	</div>
	<script type="text/javascript">
	//<![CDATA[
		(function(jq){
			var id = <?php echo json_encode( $field_id );?>;
			var isAjaxMode = <?php echo json_encode( defined( 'DOING_AJAX' ) && DOING_AJAX == true );?>;
			/**
			 * For ajax only, that is the reason why we check $_POST
			 **/
			if( id.toString().length && isAjaxMode && typeof tinymce != 'undefined' ){
				tinymce.execCommand( 'mceRemoveEditor', true, id );
				var init;
				if( typeof tinyMCEPreInit.mceInit[ id ] == 'undefined' ){
					init = tinyMCEPreInit.mceInit[ id ] = tinymce.extend( {}, tinyMCEPreInit.mceInit[ getTemplateWidgetId( id ) ] );
				}else{
					init = tinyMCEPreInit.mceInit[ id ];
				}
				
				try { tinymce.init( init ); } catch(e){ console.log( e ); }
				
				if ( typeof(QTags) == 'function' ) {
					var objQtSettings;
					
					if( typeof tinyMCEPreInit.qtInit[ id ] == 'undefined' ){
						objQtSettings = tinyMCEPreInit.qtInit[ id ] = jq.extend( {}, tinyMCEPreInit.qtInit[ getTemplateWidgetId( id ) ] );
						objQtSettings['id'] = id;
					}else{
						objQtSettings = tinyMCEPreInit.qtInit[ id ];
					}
					
					jq( '[id="wp-' + id + '-wrap"]' ).unbind( 'onmousedown' );
					jq( '[id="wp-' + id + '-wrap"]' ).bind( 'onmousedown', function(){
						wpActiveEditor = id;
					});
					
					QTags( objQtSettings );
					QTags._buttonsInit();
					
					switchEditors.switchto( jq( 'textarea[id="' + id + '"]' ).closest( '.widget-mce' ).find( '.wp-switch-editor.switch-' + ( getUserSetting( 'editor' ) == 'html' ? 'html' : 'tmce' ) )[0] );
				}
				
			}
		})(jQuery);
	//]]>
	</script>
		<?php 
	}

	public function enqueue_scripts(){
		?>
		<script type="text/javascript">
		//<![CDATA[
		/**
		 * Get widget template id, for retrieving init settings from js
		 **/
		function getTemplateWidgetId( id ){
			var form = jQuery( 'textarea[id="' + id + '"]' ).closest( 'form' );
			var id_base = form.find( 'input[name="id_base"]' ).val();
			var widget_id = form.find( 'input[name="widget-id"]' ).val();
			return id.replace( widget_id, id_base + '-__i__' );
		}
		(function(jq){
			jq( document ).ready(function(){
				/**
				 * Turn off mce mode can trigger mce store data to the textarea
				 **/
				function fixTinyMceSubmit( mce ){
					mce.closest('form').find('input[type="submit"]').click(function(){
						if( getUserSetting( 'editor' ) == 'tinymce' ){
							var id = mce.find( 'textarea' ).attr( 'id' );
							tinymce.execCommand('mceRemoveEditor', false, id);
							tinymce.execCommand( 'mceAddEditor', false, id );
						}
						return true;
					});
				}
				/**
				 * Reactive mce everytime node structure changes
				 * Which includes add widget, or re-position widget
				 **/
				function fixTinyMceSort(mce, mce_html){
					if( !mce.children().length ){
						//Add widget
						mce.html( mce_html );
						mce.removeAttr( 'data-mce');
						var id = mce.find( 'textarea' ).attr( 'id' );
						setTimeout(function(){
							tinymce.execCommand('mceRemoveEditor', true, id);
							var init = tinyMCEPreInit.mceInit[ id ] = tinymce.extend( {}, tinyMCEPreInit.mceInit[ getTemplateWidgetId( id ) ] );
							for( i in init )
								if( typeof init[i] == 'string' )
									init[i] = init[i].replace( getTemplateWidgetId( id ), id );
									
							try { tinymce.init( init ); } catch(e){ console.log( e ); }
							
							/**
							 * Fix Quick tag
							 **/
							if ( typeof(QTags) == 'function' ) {
								mce.find( '.quicktags-toolbar' ).remove();
								
								var objQtSettings = jq.extend({}, tinyMCEPreInit.qtInit[ getTemplateWidgetId( id ) ] );
								objQtSettings['id'] = id;
								
								jq( '[id="wp-' + id + '-wrap"]' ).unbind( 'onmousedown' );
								jq( '[id="wp-' + id + '-wrap"]' ).bind( 'onmousedown', function(){
									wpActiveEditor = id;
								});
								
								//Add settings with current widget id into QTags 
								QTags(objQtSettings);
								//Re-init the QTags
								QTags._buttonsInit();
								
								switchEditors.switchto( mce.find( '.wp-switch-editor.switch-' + ( getUserSetting( 'editor' ) == 'html' ? 'html' : 'tmce' ) )[ 0 ] );
							}
							
							fixTinyMceSubmit( mce );
						}, 50 );
					}else{
						//Re-posistion widget
						var id = mce.find( 'textarea' ).attr( 'id' );
						tinymce.execCommand('mceRemoveEditor', false, id);
						tinymce.execCommand( 'mceAddEditor', false, id );
					}
				}
				
				jq( '.widget-mce' ).each(function(){
					var mce = jq(this);
					
					if( mce.closest('#widgets-left ').length ){
						/**
						 * Remove all tinymce behavior from default widget template
						 * Avoid any js trouble
						 * Store html as settings as html attribute [data-mce]
						 * restore to widget when add widget
						 **/
						var id = mce.find( 'textarea' ).attr( 'id' );
						tinymce.execCommand('mceRemoveEditor', true, id);
						mce.attr( 'data-mce', mce.html() );
						mce.empty();
					}else{
						fixTinyMceSubmit( mce );
					}
				} );
				
				jq( 'div.widgets-sortables' ).bind( 'sortstop', function(event,ui){
					setTimeout(function(){
						var mce = jq(ui.item).find( '.widget-mce' );
						if( mce.length ){
							fixTinyMceSort(mce, mce.attr( 'data-mce' ));
						}
					}, 50 );
				});
			});
		})(jQuery);
		//]]>
		</script>
		<?php
	}

	public function update($new_instance , $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['html'] = ( !empty( $new_instance['html'] ) ) ? $new_instance['html'] : '';
		return $instance;
	}
}

class Pryanik_Instagram_Widget extends WP_Widget {

	function Pryanik_Instagram_Widget() {
		$widget_ops = array('classname' => 'widget_instagram', 'description' => __('Displays your latest Instagram photos', 'pryaniktheme') );
		parent::__construct('widget_instagram', __('Pryanik Instagram Widget', 'pryaniktheme'), $widget_ops);
	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$username = empty($instance['username']) ? '' : $instance['username'];
		$limit = empty($instance['number']) ? 8 : $instance['number'];
		$col = empty($instance['col']) ? '4col' : $instance['col'];
		$target = empty($instance['target']) ? '_blank' : $instance['target'];

		echo wp_kses_post($before_widget);
		if(!empty($title)) { echo wp_kses_post($before_title) . wp_kses_post($title) . wp_kses_post($after_title); };

		if ( $username != '' ) {
			$media_array = $this->scrape_instagram( $username, $limit );
			
			if ( is_wp_error( $media_array ) ) {
				echo esc_attr($media_array->get_error_message());
			} else {
				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				// filters for custom classes
				switch ($col) {
					case '2col':
						$liclass = 'col-md-6 col-sm-6 col-xs-12';
						break;
					case '3col':
						$liclass = 'col-md-4 col-sm-4 col-xs-12';
						break;
					case '4col':
						$liclass = 'col-md-3 col-sm-3 col-xs-12';
						break;
					case '5col':
						$liclass = 'col-md-15 col-sm-15 col-xs-12';
						break;
					case '6col':
						$liclass = 'col-md-2 col-sm-2 col-xs-12';
						break;
					default:
						$liclass = 'col-md-3 col-sm-3 col-xs-12';
						break;
				}
			   
				$aclass = esc_attr( apply_filters( 'wpiw_a_class', '' ) );
				$imgclass = esc_attr( apply_filters( 'wpiw_img_class', '' ) );

				?>
				<div class="row">
					<ul class="instagram-feed"><?php
				foreach ( $media_array as $item ) {
					echo '<li class="'.$liclass.'"><a href="'. esc_url( $item['link'] ) .'" style="background-image: url('. esc_url( $item['thumbnail'] ) .')" title="'. esc_attr( $item['description'] ).'"></a></li>';
				}
				?></ul>
				</div><?php
			}
		}

		echo wp_kses_post($after_widget);
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Instagram', 'pryaniktheme'), 'username' => '', 'link' => __('Follow Us', 'pryaniktheme'), 'number' => 8, 'col' => '4col', 'size' => 'thumbnail', 'target' => '_blank') );
		$title = esc_attr($instance['title']);
		$username = esc_attr($instance['username']);
		$number = absint($instance['number']);
		$col = esc_attr($instance['col']);
		$target = esc_attr($instance['target']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'pryaniktheme'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php _e('Username', 'pryaniktheme'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of photos', 'pryaniktheme'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('col')); ?>"><?php _e('Number of columns', 'pryaniktheme'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('col')); ?>" name="<?php echo esc_attr($this->get_field_name('col')); ?>" class="widefat">
				<option value="2col" <?php selected('2col', $col) ?>><?php _e('2', 'pryaniktheme'); ?></option>
				<option value="3col" <?php selected('3col', $col) ?>><?php _e('3', 'pryaniktheme'); ?></option>
				<option value="4col" <?php selected('4col', $col) ?>><?php _e('4', 'pryaniktheme'); ?></option>
				<option value="5col" <?php selected('5col', $col) ?>><?php _e('5', 'pryaniktheme'); ?></option>
				<option value="6col" <?php selected('6col', $col) ?>><?php _e('6', 'pryaniktheme'); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php _e('Open links in', 'pryaniktheme'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('target')); ?>" name="<?php echo esc_attr($this->get_field_name('target')); ?>" class="widefat">
				<option value="_self" <?php selected('_self', $target) ?>><?php _e('Current window (_self)', 'pryaniktheme'); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php _e('New window (_blank)', 'pryaniktheme'); ?></option>
			</select>
		</p>
		<?php

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = trim(strip_tags($new_instance['username']));
		$instance['number'] = !absint($new_instance['number']) ? 8 : $new_instance['number'];
		$instance['col'] = (($new_instance['col'] == '2col' || $new_instance['col'] == '3col' || $new_instance['col'] == '4col' || $new_instance['col'] == '5col' || $new_instance['col'] == '6col') ? $new_instance['col'] : '4col');
		$instance['target'] = (($new_instance['target'] == '_self' || $new_instance['target'] == '_blank') ? $new_instance['target'] : '_self');
		return $instance;
	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {
    $username = strtolower( $username );
    if ( false === ( $instagram = get_transient( 'instagram-media-'.sanitize_title_with_dashes( $username ) ) ) ) {
      $remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );
      if ( is_wp_error( $remote ) )
        return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'wpiw' ) );
      if ( 200 != wp_remote_retrieve_response_code( $remote ) )
        return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'wpiw' ) );
      $shards = explode( 'window._sharedData = ', $remote['body'] );
      $insta_json = explode( ';</script>', $shards[1] );
      $insta_array = json_decode( $insta_json[0], TRUE );
      if ( !$insta_array )
        return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'wpiw' ) );
      if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) )
        $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
      else
        return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'wpiw' ) );
      if ( !is_array( $images ) )
        return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'wpiw' ) );

      $instagram = array();

      foreach ( $images as $image ) {
        $image = $image['node'];
        $image['display_url'] = preg_replace( "/^http:/i", "", $image['display_url'] );
        if ( $image['is_video']  == true ) {
          $type = 'video';
        } else {
          $type = 'image';
        }
        $instagram[] = array(
          'description'   => esc_html__( 'Instagram Image', 'wpiw' ),
          'link'      => '//instagram.com/p/' . $image['shortcode'],
          'comments'    => $image['edge_media_to_comment']['count'],
          'likes'    => $image['edge_liked_by']['count'],
          'thumbnail'  => $image['display_url']
        );
      }

      if ( ! empty( $instagram ) ) {
        $instagram = base64_encode( serialize( $instagram ) );
        set_transient( 'instagram-media-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
      }
    }
    if ( ! empty( $instagram ) ) {
      $instagram = unserialize( base64_decode( $instagram ) );
      return array_slice( $instagram, 0, $slice );
    } else {
      return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'wpiw' ) );
    }
  }

	function images_only($media_item) {
		if ($media_item['type'] == 'image')
			return true;
		return false;
	}
}

class Pryanik_Facebook_Widget extends WP_Widget {

	function Pryanik_Facebook_Widget() {
		$widget_ops = array('classname' => 'widget_facebook', 'description' => __('Embed and promote any Facebook Page on your website', 'pryaniktheme') );
		parent::__construct('widget_facebook', __('Pryanik Facebook Widget', 'pryaniktheme'), $widget_ops);
	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$href = empty($instance['href']) ? '' : $instance['href'];
		$hide_cover = ($instance['hide_cover'] == true) ? 'true' : 'false';
		$show_facepile = ($instance['show_facepile'] == true) ? 'true' : 'false';
		$show_posts = ($instance['show_posts'] == true) ? 'true' : 'false';

		echo wp_kses_post($before_widget);
		if(!empty($title)) { echo wp_kses_post($before_title) . wp_kses_post($title) . wp_kses_post($after_title); }; ?>

		<div class="fb-page" width='500' data-href="<?php echo esc_url($href); ?>" data-hide-cover="<?php echo esc_attr($hide_cover); ?>" data-show-facepile="<?php echo esc_attr($show_facepile); ?>" data-show-posts="<?php echo esc_attr($show_posts); ?>">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="<?php echo esc_url($href); ?>">
					<a href="<?php echo esc_url($href); ?>"></a>
				</blockquote>
			</div>
		</div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<?php 
		echo wp_kses_post($after_widget);
	}

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Facebook', 'pryaniktheme'), 'href' => '', 'hide_cover' => false, 'show_facepile' => false, 'show_posts' => false) );
		$title = esc_attr($instance['title']);
		$href = esc_url($instance['href']);
		$hide_cover = esc_attr($instance['hide_cover']);
		$show_facepile = esc_attr($instance['show_facepile']);
		$show_posts = esc_attr($instance['show_posts']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'pryaniktheme'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('href')); ?>"><?php _e('Facebook Page URL', 'pryaniktheme'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('href')); ?>" name="<?php echo esc_attr($this->get_field_name('href')); ?>" type="text" value="<?php echo esc_url($href); ?>" /></label></p>
		<p><input id="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cover')); ?>" type="checkbox" <?php checked(isset($instance['hide_cover']) ? $instance['hide_cover'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>"><?php _e('Hide Cover Photo', 'pryaniktheme'); ?></label></p>
		<p><input id="<?php echo esc_attr($this->get_field_id('show_facepile')); ?>" name="<?php echo esc_attr($this->get_field_name('show_facepile')); ?>" type="checkbox" <?php checked(isset($instance['show_facepile']) ? $instance['show_facepile'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('show_facepile')); ?>"><?php _e("Show Friend's Faces", 'pryaniktheme'); ?></label></p>
		<p><input id="<?php echo esc_attr($this->get_field_id('show_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_posts')); ?>" type="checkbox" <?php checked(isset($instance['show_posts']) ? $instance['show_posts'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('show_posts')); ?>"><?php _e('Show Page Posts', 'pryaniktheme'); ?></label></p>

		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['href'] = esc_url($new_instance['href']);
		$instance['hide_cover'] = isset($new_instance['hide_cover']);
		$instance['show_facepile'] = isset($new_instance['show_facepile']);
		$instance['show_posts'] = isset($new_instance['show_posts']);
		return $instance;
	}
}

class Pryanik_Widget_Flickr extends WP_Widget{

	function Pryanik_Widget_Flickr(){
		$widget_ops = array('classname' => 'widget_flickr', 'description' => __('Add Flickr Stream Widget', 'pryaniktheme') );
		parent::__construct('Pryanik_Widget_Flickr', __('Pryanik Flickr Widget', 'pryaniktheme'), $widget_ops);
		add_action('wp_enqueue_scripts', array(&$this, 'js'));
	}

	function js(){
		if ( is_active_widget(false, false, $this->id_base, true) ) {
		   wp_enqueue_script( 'flickr-js', PRYANIK_INC_URI . 'js/flickrush.min.js', array('jquery'), '', true );
		}
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Flickr', 'pryaniktheme'), 'flickr_id' => '', 'number' => 8, 'col' => '4col', 'show_random' => false) );
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$flickr_id     = isset( $instance['flickr_id'] ) ? esc_attr( $instance['flickr_id'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 8;
		$col = esc_attr($instance['col']);
		$show_random = isset( $instance['show_random'] ) ? (bool) $instance['show_random'] : false;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'flickr_id' )); ?>"><?php _e( 'Flickr ID:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flickr_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr_id' )); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of photos to show:' , 'pryaniktheme'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('col')); ?>"><?php _e('Number of columns', 'pryaniktheme'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('col')); ?>" name="<?php echo esc_attr($this->get_field_name('col')); ?>" class="widefat">
				<option value="2col" <?php selected('2col', $col) ?>><?php _e('2', 'pryaniktheme'); ?></option>
				<option value="3col" <?php selected('3col', $col) ?>><?php _e('3', 'pryaniktheme'); ?></option>
				<option value="4col" <?php selected('4col', $col) ?>><?php _e('4', 'pryaniktheme'); ?></option>
				<option value="5col" <?php selected('5col', $col) ?>><?php _e('5', 'pryaniktheme'); ?></option>
				<option value="6col" <?php selected('6col', $col) ?>><?php _e('6', 'pryaniktheme'); ?></option>
			</select>
		</p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_random ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_random' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_random' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_random' )); ?>"><?php _e( 'Show random posts?', 'pryaniktheme' ); ?></label></p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['number'] = (int) $new_instance['number'];
		 $instance['col'] = (($new_instance['col'] == '2col' || $new_instance['col'] == '3col' || $new_instance['col'] == '4col' || $new_instance['col'] == '5col' || $new_instance['col'] == '6col') ? $new_instance['col'] : '4col');
		$instance['show_random'] = !empty($new_instance['show_random']) ? 1 : 0;

		return $instance;
	}

	function widget($args, $instance){
		extract($args, EXTR_SKIP);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Flickr', 'pryaniktheme' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$flickr_id = ( ! empty( $instance['flickr_id'] ) ) ? $instance['flickr_id'] : __( '52617155@N08', 'pryaniktheme' );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 8;
		$col = empty($instance['col']) ? '4col' : $instance['col'];
		if ( ! $number )
			$number = 8;
		$show_random = ! empty( $instance['show_random'] ) ? '1' : '0';
		switch ($col) {
			case '2col':
				$class = 'col-md-6 col-sm-6 col-xs-12';
				break;
			case '3col':
				$class = 'col-md-4 col-sm-4 col-xs-12';
				break;
			case '4col':
				$class = 'col-md-3 col-sm-3 col-xs-12';
				break;
			case '5col':
				$class = 'col-md-15 col-sm-15 col-xs-12';
				break;
			case '6col':
				$class = 'col-md-2 col-sm-2 col-xs-12';
				break;
			default:
				$class = 'col-md-3 col-sm-3 col-xs-12';
				break;
		}
		echo wp_kses_post($before_widget);
		if ( $title )
			echo wp_kses_post($before_title) . wp_kses_post($title) . wp_kses_post($after_title);
		echo "<div class='flickr' data-limit='" . esc_attr($number) . "' data-col='". esc_attr($class) . "' data-flickrid='". esc_attr($flickr_id) ."' data-random='". esc_attr($show_random) ."'></div>";
		?>
		<?php 
		echo wp_kses_post($after_widget);
	}
}

class Pryanik_Widget_Twitter extends WP_Widget{

	function Pryanik_Widget_Twitter(){
		$widget_ops = array('classname' => 'widget_twitter', 'description' => __('Add a twitter timeline widget', 'pryaniktheme' ) );
		parent::__construct('Pryanik_Widget_Twitter', __('Pryanik Twitter Widget', 'pryaniktheme' ), $widget_ops);
	}

	function form($instance){
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$user        = isset( $instance['user'] ) ? esc_attr( $instance['user'] ) : '';
		$id          = isset( $instance['id'] ) ? esc_attr( $instance['id'] ) : '';
		$theme       = isset( $instance['theme'] ) ? esc_attr( $instance['theme'] ) : 'light';
		$color       = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : '#cea97c';
		$header      = isset( $instance['header'] ) ? (bool) $instance['header'] : true;
		$footer      = isset( $instance['footer'] ) ? (bool) $instance['footer'] : true;
		$borders     = isset( $instance['borders'] ) ? (bool) $instance['borders'] : true;
		//$scroll    = isset( $instance['scroll'] ) ? (bool) $instance['scroll'] : true;
		//$transparent = isset( $instance['transparent'] ) ? (bool) $instance['transparent'] : true;
		$limit       = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 3;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'user' )); ?>"><?php _e( 'Twitter Username:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'user' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'user' )); ?>" type="text" value="<?php echo esc_attr($user); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'id' )); ?>"><?php _e( 'Widget ID:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'id' )); ?>" type="text" value="<?php echo esc_attr($id); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'theme' )); ?>"><strong><?php _e( 'Color Theme:', 'pryaniktheme' ); ?></strong><br><?php _e( 'Default Twitter color themes', 'pryaniktheme' ); ?></label>

		<select id="<?php echo esc_attr($this->get_field_id( 'theme' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'theme' )); ?>" class="widefat">
			<option value="dark"<?php echo ($theme=='dark')?'selected':''; ?>><?php _e('Dark', 'pryaniktheme'); ?></option>
			<option value="light"<?php echo ($theme=='light')?'selected':''; ?>><?php _e('Light', 'pryaniktheme'); ?></option>
		</select>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'color' )); ?>"><strong><?php _e( 'Links Color:', 'pryaniktheme' ); ?></strong></label><br>
		<input  name="<?php echo esc_attr($this->get_field_name( 'color' )); ?>" 
				class="twitter-color"
				type="text" 
				id="<?php echo esc_attr($this->get_field_id( 'color' )); ?>" 
				value="<?php echo esc_attr($color); ?>"
				data-default-color="<?php echo esc_attr($color); ?>">
		<p><input class="checkbox" type="checkbox" <?php checked( $header ); ?> id="<?php echo esc_attr($this->get_field_id( 'header' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'header' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'header' )); ?>"><strong><?php _e( 'No Header:', 'pryaniktheme' ); ?></strong><br><?php _e( "Hides the timeline header", 'pryaniktheme' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $footer ); ?> id="<?php echo esc_attr($this->get_field_id( 'footer' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'footer' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'footer' )); ?>"><strong><?php _e( 'No Footer:', 'pryaniktheme' ); ?></strong><br><?php _e( "Hides the timeline footer and Tweet box, if included", 'pryaniktheme' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $borders ); ?> id="<?php echo esc_attr($this->get_field_id( 'borders' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'borders' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'borders' )); ?>"><strong><?php _e( 'No Borders:', 'pryaniktheme' ); ?></strong><br><?php _e( "Removes all borders within the widget", 'pryaniktheme' ); ?></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"><strong><?php _e( 'Tweet limit:', 'pryaniktheme' ); ?></strong><br><?php _e( 'Number of tweets to show', 'pryaniktheme' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr($limit); ?>" size="3" /></p>

		<?php 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['user'] = strip_tags($new_instance['user']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['theme'] = strip_tags($new_instance['theme']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		
		$instance['header'] = !empty($new_instance['header']) ? 1 : 0;
		$instance['footer'] = !empty($new_instance['footer']) ? 1 : 0;
		$instance['borders'] = !empty($new_instance['borders']) ? 1 : 0;
		//$instance['scroll'] = !empty($new_instance['scroll']) ? 1 : 0;
		//$instance['transparent'] = !empty($new_instance['transparent']) ? 1 : 0;
		
		return $instance;
	}

	function widget($args, $instance){
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$user = ( ! empty( $instance['user'] ) ) ? $instance['user'] : '';
		$id = ( ! empty( $instance['id'] ) ) ? $instance['id'] : '';
		$theme = ( ! empty( $instance['theme'] ) ) ? $instance['theme'] : 'light';
		$color = ( ! empty( $instance['color'] ) ) ? $instance['color'] : '';
		
		$header = ! empty( $instance['header'] ) ? '1' : '0';
		$footer = ! empty( $instance['footer'] ) ? '1' : '0';
		$borders = ! empty( $instance['borders'] ) ? '1' : '0';
		//$scroll = ! empty( $instance['scroll'] ) ? '1' : '0';
		//$transparent = ! empty( $instance['transparent'] ) ? '1' : '0';

		$limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 3;
		if ( ! $limit )
			$limit = 3;
		
		echo wp_kses_post($before_widget);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		if ( $title ) echo wp_kses_post($before_title)  . esc_attr($title)  . wp_kses_post($after_title);

		$chrome =   ($header ? "noheader " : " ") .
					($footer ? "nofooter " : " ") . 
					($borders ? "noborders " : " ");
					//($scroll ? "noscrollbar" : " ") .
					//($transparent ? "transparent" : " ");
		?>
		
		<a class="twitter-timeline" 
			href="https://twitter.com/<?php echo esc_attr($user); ?>"
			data-widget-id="<?php echo esc_attr($id); ?>"
			data-theme="<?php echo esc_attr($theme); ?>"
			data-link-color="<?php echo esc_attr($color); ?>"
			data-chrome="<?php echo esc_attr($chrome); ?>"
			data-tweet-limit="<?php echo esc_attr($limit); ?>">
			Tweets by @<?php echo esc_attr($user); ?>
		</a>
		
		<?php 
		echo wp_kses_post($after_widget);
	}
}

class Pryanik_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries2', 'description' => __( "Your site&#8217;s most recent posts.", 'pryaniktheme' ) );
		parent::__construct('recent-posts', __('Pryanik Recent Posts Widget', 'pryaniktheme'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);

		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
	?>
		<?php echo wp_kses_post($before_widget); ?>
		<?php if ( $title ) echo wp_kses_post($before_title)  . esc_attr($title)  . wp_kses_post($after_title); ?>
		<div class="recent">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<article>
				<a class="img" href="<?php the_permalink(); ?>">
					<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail(array(90,90));
					}else{
						$format = get_post_format(get_the_ID());
						switch ($format) {
						    case "0": ?>
								<span  style="font-family:'Times New Roman';font-size:16px;">T</span>
					         	<?php break;
						    case "chat": ?>
						        <i class="fa fa-wechat"></i>
						        <?php break;
						    case "gallery": ?>
						    	<i class="fa fa-image"></i>
						        <?php break;
						    case "link": ?>
						        <i class="fa fa-link"></i>
						        <?php break;
						    case "image":
						    	$img = get_post_meta( get_the_ID(), 'upload_image', true ); 
								$img = str_replace('http://','',$img);
								echo wp_get_attachment_image( $img , array(90,90));
						       	break;
						    case "quote": ?>
						       <i class="fa fa-quote-left"></i>
						        <?php break;
						    case "status": ?>
						       <i class="fa fa-bullhorn"></i>
						        <?php break;
						    case "video": ?>
						        <i class="fa fa-play"></i>
						    	<?php break;		
						    case "audio": ?>
						        <i class="fa fa-music"></i>
						        <?php break;
						    }
						}
					?>					
				</a>
				<header>
					<div class="post-categories">
						<?php $post_categories = wp_get_post_categories( get_the_ID() );	
							foreach($post_categories as $c){
								$cat = get_category( $c );
								$id = get_cat_ID($cat->name); ?>
								<a href="<?php echo get_category_link( $id ); ?>"><?php echo esc_attr($cat->name); ?></a>
						<?php } ?>
					</div>
					<a class='post-title' href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
					<?php if ( $show_date ) : ?>
						<a class='post-date' href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time(get_option( 'date_format' )); ?></a>
					<?php endif; ?>
					<a class='read-more' href="<?php the_permalink(); ?>">
						<?php _e('Read more','pryaniktheme'); ?>
					</a>
				</header>
			</article>
		<?php endwhile; ?>
		</div>
		<?php echo wp_kses_post($after_widget); ?>
	<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'pryaniktheme' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of posts to show:', 'pryaniktheme' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php _e( 'Display post date?', 'pryaniktheme' ); ?></label></p>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*
/*  Define Custom Widgets
/*
/*-----------------------------------------------------------------------------------*/

	if (!function_exists('pryanik_register_widgets')) {
		function pryanik_register_widgets() { 
		    register_widget("Pryanik_Social_Links_Widget");
		    register_widget("Pryanik_Text_Editor_Widget");
		    register_widget("Pryanik_Instagram_Widget");
		    register_widget("Pryanik_Facebook_Widget");
		    register_widget("Pryanik_Widget_Flickr");
		    register_widget("Pryanik_Widget_Twitter");
		    register_widget("Pryanik_Widget_Recent_Posts");
		}
		add_action('widgets_init', 'pryanik_register_widgets', 1);
	}
?>
