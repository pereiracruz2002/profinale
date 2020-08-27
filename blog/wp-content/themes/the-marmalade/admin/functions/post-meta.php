<?php 

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Add Post Meta
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_post_meta_boxes_setup' ) ) :
		function pryanik_post_meta_boxes_setup() {
			add_action( 'add_meta_boxes', 'pryanik_add_post_meta_boxes' );
			add_action( 'save_post', 'pryanik_save_audio_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_video_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_gallery_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_image_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_quote_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_link_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_chat_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_status_post_settings', 10, 2 );
			add_action( 'save_post', 'pryanik_save_default_post_settings', 10, 2 ); 
		}
	endif;

	add_action( 'load-post.php', 'pryanik_post_meta_boxes_setup' );
	add_action( 'load-post-new.php', 'pryanik_post_meta_boxes_setup' );

	if ( ! function_exists( 'pryanik_add_post_meta_boxes' ) ) :
		function pryanik_add_post_meta_boxes() {
			add_meta_box( 'image-settings', __( 'Image Post Settings', 'pryaniktheme' ), 'pryanik_post_image_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'gallery-settings', __( 'Gallery Post Settings', 'pryaniktheme' ), 'pryanik_post_gallery_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'audio-settings', __( 'Audio Post Settings', 'pryaniktheme' ), 'pryanik_post_audio_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'video-settings', __( 'Video Post Settings', 'pryaniktheme' ), 'pryanik_post_video_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'quote-settings', __( 'Quote Post Settings', 'pryaniktheme' ), 'pryanik_post_quote_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'link-settings', __( 'Link Post Settings', 'pryaniktheme' ), 'pryanik_post_link_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'chat-settings', __( 'Chat Post Settings', 'pryaniktheme' ), 'pryanik_chat_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'status-settings', __( 'Status Post Settings', 'pryaniktheme' ), 'pryanik_status_meta_box', 'post', 'normal', 'default' );
			add_meta_box( 'default-settings', __( 'Defaut Post Settings', 'pryaniktheme' ), 'pryanik_post_default_meta_box', 'post', 'normal', 'default' ); 
		}
	endif;

	function pryanik_post_default_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_default_settings_nonce' ); ?>
			<div class="container">
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="custom-settings"><?php _e( "Use Custom Post Meta Settings", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="custom-settings"><?php _e( "Select if you want to use custom post meta display settings for this post. Otherwise it will use settings selected in Customizer > Post Settings.", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'custom_settings', true ))?'checked':''; ?> id="custom-settings" name="custom-settings" />
				   </div>
				</div>
				<br>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-title"><?php _e( "Title Visability", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-title"><?php _e( "Select when the post title is displayed.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'show_title', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="show-title" value="always" <?php checked( $value, 'always' ); ?>><?php _e( "Always show", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-title" value="post" <?php checked( $value, 'post' ); ?>><?php _e( "Only on post page", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-title" value="never" <?php checked( $value, 'never' ); ?>><?php _e( "Never show", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-content"><?php _e( "Content Visability", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-content"><?php _e( "Select when the post content is displayed.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'show_content', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="show-content" value="always" <?php checked( $value, 'always' ); ?>><?php _e( "Always show", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-content" value="post" <?php checked( $value, 'post' ); ?>><?php _e( "Only on post page", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-content" value="never" <?php checked( $value, 'never' ); ?>><?php _e( "Never show", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-counters"><?php _e( "Counters Visability", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-counters"><?php _e( "Select when the post counters are displayed.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'show_counters', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="show-counters" value="always" <?php checked( $value, 'always' ); ?>><?php _e( "Always show", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-counters" value="post" <?php checked( $value, 'post' ); ?>><?php _e( "Only on post page", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-counters" value="never" <?php checked( $value, 'never' ); ?>><?php _e( "Never show", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-share"><?php _e( "Share Options Visability", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-share"><?php _e( "Select when the post share options are displayed.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'show_share', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="show-share" value="always" <?php checked( $value, 'always' ); ?>><?php _e( "Always show", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-share" value="post" <?php checked( $value, 'post' ); ?>><?php _e( "Only on post page", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-share" value="never" <?php checked( $value, 'never' ); ?>><?php _e( "Never show", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<br>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="spotlight"><?php _e( "Spotlight Post", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="spotlight"><?php _e( "Show post content on featured image.", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'spotlight', true ))?'checked':''; ?> id="spotlight" name="spotlight" />
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="spotlight-content-color"><?php _e( "Content color", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="spotlight-content-color"><?php _e( "Select content color for spotlight post.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'spotlight_content_color', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="spotlight-content-color" value="light" <?php checked( $value, 'light' ); ?>><?php _e( "Light", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="spotlight-content-color" value="dark" <?php checked( $value, 'dark' ); ?>><?php _e( "Dark", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<br>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-fullwidth"><?php _e( "Fullwidth Post", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-fullwidth"><?php _e( "Show fullwidth post(works only for grid blog type).", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'show_fullwidth', true ))?'checked':''; ?> id="show-fullwidth" name="show-fullwidth" />
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-related"><?php _e( "Reated Posts Visability", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-related"><?php _e( "Select when related posts are displayed.", 'pryaniktheme' ); ?></label>
					</p>
					<?php $value = (get_post_meta( $object->ID, 'show_related', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="show-related" value="always" <?php checked( $value, 'always' ); ?>><?php _e( "Always show", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-related" value="post" <?php checked( $value, 'post' ); ?>><?php _e( "Only on post page", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="show-related" value="never" <?php checked( $value, 'never' ); ?>><?php _e( "Never show", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<br>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-author"><?php _e( "Show Author Block", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-author"><?php _e( "Select if you want to show author block on post page", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'show_author', true ))?'checked':''; ?> id="show-author" name="show-author" />
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="hide-nav"><?php _e( "Hide Post Navigation", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="hide-nav"><?php _e( "Select if you want to hide prev/next post navigation on post page", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'hide_nav', true ))?'checked':''; ?> id="hide-nav" name="hide-nav" />
				   </div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2><?php _e( "Custom Post Title", 'pryaniktheme' ); ?></h2>
					</div>
					<p class="col-md-4 desc" >
						<label  for="show-custom-title"><?php _e( "Show Custom Post Title", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-custom-title"><?php _e( "Select if you want to show custom post title with background image on post page", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'show_custom_title', true ))?'checked':''; ?> id="show-custom-title" name="show-custom-title" />
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="custom-post-title"><?php _e( "Custom Title", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="widefat" id="custom-post-title" name="custom-post-title" placeholder="Custom title" type="text" value="<?php echo  get_post_meta( $object->ID, 'custom_post_title', true ); ?>" size="200" /></p>
				   </div>
				</div>
				<div class="row">
					<p class="col-md-4 desc" >
						<label><?php _e( "Title Background Image", 'pryaniktheme' ); ?></label>
						<br/>
						<label><?php _e( "Select a background image for custom post title", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input  id="upload-image-button"
								class="button button-primary" 
								type="button"
								value="<?php _e("Select image", 'pryaniktheme' ); ?>" />
						<input  id="post-title-image"
								name="post-title-image"
								style="display:none"
								value="<?php echo  esc_url(get_post_meta( $object->ID, 'post_title_image', true )); ?>"/>
					</div>
				</div>
			</div>
	<?php }
	function pryanik_save_default_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_default_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_default_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;

		$new_meta_value = ( isset( $_POST['custom-settings'] ) ?  $_POST['custom-settings']  : '' );
		$meta_key = 'custom_settings';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-title'] ) ?  $_POST['show-title']  : '' );
		$meta_key = 'show_title';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-content'] ) ?  $_POST['show-content']  : '' );
		$meta_key = 'show_content';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-counters'] ) ?  $_POST['show-counters']  : '' );
		$meta_key = 'show_counters';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-share'] ) ?  $_POST['show-share']  : '' );
		$meta_key = 'show_share';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['spotlight'] ) ?  $_POST['spotlight']  : '' );
		$meta_key = 'spotlight';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['spotlight-content-color'] ) ?  $_POST['spotlight-content-color']  : '' );
		$meta_key = 'spotlight_content_color';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-fullwidth'] ) ?  $_POST['show-fullwidth']  : '' );
		$meta_key = 'show_fullwidth';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-related'] ) ?  $_POST['show-related']  : '' );
		$meta_key = 'show_related';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-author'] ) ?  $_POST['show-author']  : '' );
		$meta_key = 'show_author';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['hide-nav'] ) ?  $_POST['hide-nav']  : '' );
		$meta_key = 'hide_nav';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['show-custom-title'] ) ?  $_POST['show-custom-title']  : '' );
		$meta_key = 'show_custom_title';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['custom-post-title'] ) ?  $_POST['custom-post-title']  : '' );
		$meta_key = 'custom_post_title';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['post-title-image'] ) ?  $_POST['post-title-image']  : '' );
		$meta_key = 'post_title_image';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_image_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_image_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<p class="col-md-4 desc" >
					<label><?php _e( "Post Image", 'pryaniktheme' ); ?></label>
					<br/>
					<label><?php _e( "Uploaded image will be shown on post page.It also will be shown on blog page if featured image wasn't selected.", 'pryaniktheme' ); ?></label>
				</p>
				
				<div class="col-md-8">
					<input  id="upload-image-button"
							class="button button-primary" 
							type="button"
							value="<?php _e("Select image", 'pryaniktheme' ); ?>" />
					<input  id="upload-image"
							name="upload-image"
							style="display:none"
							value="<?php echo  esc_url(get_post_meta( $object->ID, 'upload_image', true )); ?>"/>
				</div>
			</div>
		</div>
	<?php }
	function pryanik_save_image_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_image_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_image_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['upload-image'] ) ?  $_POST['upload-image']  : '' );
		$meta_key = 'upload_image';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_gallery_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_gallery_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<p class="col-md-4 desc" >
					<label><?php _e( "Gallery Images", 'pryaniktheme' ); ?></label>
					<br/>
					<label><?php _e( "Uploaded images will be shown as slider on blog and post pages.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input  id="upload-gallery-button"
							class="button button-primary" 
							type="button"
							value="<?php _e("Select images", 'pryaniktheme' ); ?>" />
					<input  id="upload-gallery"
							name="upload-gallery"
							style="display:none"
							value="<?php echo  esc_url(get_post_meta( $object->ID, 'upload_gallery', true )); ?>"/>
				</div>
			</div>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="slider-mode"><?php _e( "Slider Mode", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="slider-mode"><?php _e( "Type of transition between slides.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<select class="widefat" id="slider-mode" name="slider-mode">
						<option value="horizontal"<?php echo (get_post_meta( $object->ID, 'slider_mode', true )=='horizontal')?'selected':''; ?>><?php _e( "Horizontal", 'pryaniktheme' ); ?></option>
						<option value="vertical"<?php echo (get_post_meta( $object->ID, 'slider_mode', true )=='vertical')?'selected':''; ?>><?php _e( "Vertical", 'pryaniktheme' ); ?></option>
						<option value="fade"<?php echo (get_post_meta( $object->ID, 'slider_mode', true )=='fade')?'selected':''; ?>><?php _e( "Fade", 'pryaniktheme' ); ?></option>
					</select>
			   </div>
			</div>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="slider-auto"><?php _e( "Auto Slideshow", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="slider-auto"><?php _e( "Slides will automatically transition.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'slider_auto', true ))?'checked':''; ?> id="slider-auto" name="slider-auto" />
			   </div>
			</div>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="slider-pause"><?php _e( "Pause", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="slider-pause"><?php _e( "The amount of time (in ms) between each auto transition", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="slider-pause" name="slider-pause" type="text" value="<?php echo  intval(get_post_meta( $object->ID, 'slider_pause', true )); ?>" size="5" /></p>
			   </div>
			</div>
		</div>
	<?php }
	function pryanik_save_gallery_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_gallery_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_gallery_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['upload-gallery'] ) ?  $_POST['upload-gallery']  : '' );
		$meta_key = 'upload_gallery';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['slider-mode'] ) ?  $_POST['slider-mode']  : '' );
		$meta_key = 'slider_mode';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		$new_meta_value = ( isset( $_POST['slider-auto'] ) ?  $_POST['slider-auto']  : '' );
		$meta_key = 'slider_auto';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		$new_meta_value = ( isset( $_POST['slider-pause'] ) ?  $_POST['slider-pause']  : '' );
		$meta_key = 'slider_pause';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_audio_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_audio_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 desc" >
					<label><?php _e( "Audio File URL or Embed Code", 'pryaniktheme' ); ?></label>
					<br/>
					<label><?php _e( "Select audio file (.mp3 for best compatibility) OR paste your 3rd party (eg: soundcloud, spotify) embed code here.", 'pryaniktheme' ); ?></label>
					<div class="row"></div>
					<div>
						<input 	id="upload-audio-button"
								class="button button-primary" 
								type="button"
								value=<?php _e( "Select audio file", 'pryaniktheme' ); ?>/>
					</div>
				</div>
					
			<textarea 	class="col-md-8"
						name="upload-audio" 
						id="upload-audio" 
						rows="8">
<?php echo  balanceTags(get_post_meta( $object->ID, 'upload_audio', true )); ?>
			</textarea>
			</div>
		</div>
	<?php }
	function pryanik_save_audio_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_audio_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_audio_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['upload-audio'] ) ?  $_POST['upload-audio']  : '' );
		$meta_key = 'upload_audio';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_video_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_video_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 desc" >
					<label><?php _e( "Embed Code", 'pryaniktheme' ); ?></label>
					<br/>
					<label><?php _e( "Paste your 3rd party (eg: youtube, vimeo) embed code here.", 'pryaniktheme' ); ?></label>
				</div>
					
			<textarea 	class="col-md-8"
						name="upload-video" 
						id="upload-video" 
						rows="8">
<?php echo  balanceTags(get_post_meta( $object->ID, 'upload_video', true )); ?>
			</textarea>
			</div>
		</div>
	<?php }
	function pryanik_save_video_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_video_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_video_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['upload-video'] ) ?  $_POST['upload-video']  : '' );
		$meta_key = 'upload_video';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_quote_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_quote_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="quote-text"><?php _e( "The Quote", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="quote-text"><?php _e( "The actual quote for this post.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="quote-text" name="quote-text" type="text" value="<?php echo  esc_attr(get_post_meta( $object->ID, 'quote_text', true )); ?>"/></p>
				</div>
			</div>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="quote-ref"><?php _e( "Optional Quote Reference", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="quote-ref"><?php _e( "A persons name or the quotes source.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="quote-ref" name="quote-ref" type="text" value="<?php echo  esc_attr(get_post_meta( $object->ID, 'quote_ref', true )); ?>"/></p>
				</div>
			</div>
		</div>
	<?php }
	function pryanik_save_quote_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_quote_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_quote_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['quote-text'] ) ?  $_POST['quote-text']  : '' );
		$meta_key = 'quote_text';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		$new_meta_value = ( isset( $_POST['quote-ref'] ) ?  $_POST['quote-ref']  : '' );
		$meta_key = 'quote_ref';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_post_link_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_link_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="link-ref"><?php _e( "Link URL", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="link-ref"><?php _e( "The hyperlink displayed in the post.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="link-ref" name="link-ref" type="text" value="<?php echo  esc_attr(get_post_meta( $object->ID, 'link_ref', true )); ?>"/></p>
				</div>
			</div>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="link-text"><?php _e( "Optional Link Description", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="link-text"><?php _e( "An optional short description about the link.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="link-text" name="link-text" type="text" value="<?php echo  esc_attr(get_post_meta( $object->ID, 'link_text', true )); ?>"/></p>
				</div>
			</div>
		</div>
	<?php }	
	function pryanik_save_link_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_link_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_link_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['link-text'] ) ?  $_POST['link-text']  : '' );
		$meta_key = 'link_text';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

		$new_meta_value = ( isset( $_POST['link-ref'] ) ?  $_POST['link-ref']  : '' );
		$meta_key = 'link_ref';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_chat_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_chat_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 desc" >
					<label  for="chat-list"><?php _e( "Chat Dialog", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="chat-list"><?php _e( "The chat dialog needs to be formated like this:", 'pryaniktheme' ); ?></label>
					<br/>
					<pre>
					<?php _e( "
John: Hello
Mary: Hi John
Jim: Bye.", 
					'pryaniktheme' ); ?>
					</pre>
				</div>
				
	<textarea 	class="col-md-8"
				name="chat-list" 
				id="chat-list" 
				rows="8">
	<?php echo  esc_textarea(get_post_meta( $object->ID, 'chat_list', true )); ?>
	</textarea>
			</div>
		</div>
	<?php }
	function pryanik_save_chat_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_chat_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_chat_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['chat-list'] ) ?  $_POST['chat-list']  : '' );
		$meta_key = 'chat_list';
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}

	function pryanik_status_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'post_status_settings_nonce' ); ?>
		<div class="container">
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="status-embed-code"><?php _e( "Embedded Twitter Code", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="status-embed-code"><?php _e( "If you would rather embed a tweet you can do so here.", 'pryaniktheme' ); ?></label>
				</p>
				
	<textarea 	class="col-md-8" 
				type="text"
				name="status-embed-code" 
				id="status-embed-code" 
				rows="8">
	<?php echo  esc_textarea(get_post_meta( $object->ID, 'status_embed_code', true )); ?>
	</textarea>
			</div>
		</div>
	<?php }
	function pryanik_save_status_post_settings( $post_id, $post ) {
		if ( !isset( $_POST['post_status_settings_nonce'] ) || !wp_verify_nonce( $_POST['post_status_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		$new_meta_value = ( isset( $_POST['status-embed-code'] ) ?  $_POST['status-embed-code']  : '' );
		$meta_key = 'status_embed_code';
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}
 ?>