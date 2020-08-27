<?php 
	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Add Page Meta
	/*
	/*-----------------------------------------------------------------------------------*/

	if ( ! function_exists( 'pryanik_page_meta_boxes_setup' ) ) :
		function pryanik_page_meta_boxes_setup() {
			add_action( 'add_meta_boxes', 'pryanik_add_page_meta_boxes' );
			add_action( 'save_post', 'pryanik_save_default_page_settings', 10, 2 ); 
		}
	endif;

	add_action( 'load-post.php', 'pryanik_page_meta_boxes_setup' );
	add_action( 'load-post-new.php', 'pryanik_page_meta_boxes_setup' );

	if ( ! function_exists( 'pryanik_add_page_meta_boxes' ) ) :
		function pryanik_add_page_meta_boxes() {
			add_meta_box( 'default-settings', __( 'Defaut Page Settings', 'pryaniktheme' ), 'pryanik_page_default_meta_box', 'page', 'normal', 'default' ); 
		}
	endif;

	function pryanik_page_default_meta_box( $object, $box ) {
		wp_nonce_field( basename( __FILE__ ), 'page_default_settings_nonce' ); ?>
			<div class="container">
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="show-title"><?php _e( "Show page title", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="show-title"><?php _e( "Select if you want to show page title", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'show_title', true ))?'checked':''; ?> id="show-title" name="show-title" />
				   </div>
				</div>
				<br>
				<div class="row">
		  			<p class="col-md-4 desc" >
		  				<label  for="sidebar-layout"><?php _e( "Sidebar layout", 'pryaniktheme' ); ?></label>
		  				<br/>
		  				<label  for="sidebar-layout"><?php _e( "Select the position of sidebar on this page.", 'pryaniktheme' ); ?></label>
		  			</p>
					<?php $value = (get_post_meta( $object->ID, 'sidebar_layout', true )); ?>
					<div class="col-md-8">
						<input type="radio" class="radio-group" name="sidebar-layout" value="left" <?php checked( $value, 'left' ); ?>><?php _e( "Left", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="sidebar-layout" value="right" <?php checked( $value, 'right' ); ?>><?php _e( "Right", 'pryaniktheme' ); ?>
						<input type="radio" class="radio-group" name="sidebar-layout" value="none" <?php checked( $value, 'none' ); ?>><?php _e( "None", 'pryaniktheme' ); ?>
				   </div>
				</div>
				<div class="row">
		  			<p class="col-md-4 desc" >
		  				<label  for="select-sidebar"><?php _e( "Select sidebar", 'pryaniktheme' ); ?></label>
		  				<br/>
		  				<label  for="select-sidebar"><?php _e( "Select sidebar from list.", 'pryaniktheme' ); ?></label>
		  			</p>
				    <div class="col-md-8">
						<select class="widefat" id="select-sidebar" name="select-sidebar">
						<?php 
							foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
								$id = ucwords( $sidebar['id']);
								$name = ucwords( $sidebar['name'] );
								?>
								<option 
									value="<?php echo esc_attr($id); ?>"
									<?php echo (get_post_meta( $object->ID, 'select_sidebar', true )==$id)?'selected':'' ?> >
									<?php echo esc_attr($name); ?>
									</option>
						<?php } ?>
					   	</select>
				   </div>
				</div>
				<br>
				<div class="row">
					<p class="col-md-4 desc" >
						<label  for="add-map"><?php _e( "Add Google Map", 'pryaniktheme' ); ?></label>
						<br/>
						<label  for="add-map"><?php _e( "Select if you want to add fullwidth map to this page.", 'pryaniktheme' ); ?></label>
					</p>
					<div class="col-md-8">
						<input class="checkbox" type="checkbox" <?php echo (get_post_meta( $object->ID, 'add_map', true ))?'checked':''; ?> id="add-map" name="add-map" />
				   </div>
				</div>
				<div class="row">
					<div class="col-md-4 desc" >
						<label><?php _e( "Google Map Embed Code", 'pryaniktheme' ); ?></label>
						<br/>
						<label><?php _e( "Insert Google map embed code. ", 'pryaniktheme' ); ?><a href="https://developers.google.com/maps/documentation/embed/start"><?php _e('Learn More','pryaniktheme') ?></a></label>
					</div>
			<textarea 	class="col-md-8"
						name="map-embed" 
						id="map-embed" 
						rows="8">
<?php echo  balanceTags(get_post_meta( $object->ID, 'map_embed', true )); ?>
			</textarea>
			</div>
			<br>
			<div class="row">
				<p class="col-md-4 desc" >
					<label  for="add-slider"><?php _e( "Add Slider", 'pryaniktheme' ); ?></label>
					<br/>
					<label  for="add-slider"><?php _e( "You can put Master Slider or third-party plugin shortcode here to add slider on this page.", 'pryaniktheme' ); ?></label>
				</p>
				<div class="col-md-8">
					<input class="widefat" id="add-slider" name="add-slider" type="text" value="<?php echo  esc_attr(get_post_meta( $object->ID, 'add_slider', true )); ?>"/></p>
				</div>
			</div>
	<?php }

	function pryanik_save_default_page_settings( $post_id, $post ) {
		if ( !isset( $_POST['page_default_settings_nonce'] ) || !wp_verify_nonce( $_POST['page_default_settings_nonce'], basename( __FILE__ ) ) )
			return $post_id;
		$post_type = get_post_type_object( $post->post_type );

		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;

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
		$new_meta_value = ( isset( $_POST['select-sidebar'] ) ?  $_POST['select-sidebar']  : '' );
		$meta_key = 'select_sidebar';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['sidebar-layout'] ) ?  $_POST['sidebar-layout']  : '' );
		$meta_key = 'sidebar_layout';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['add-map'] ) ?  $_POST['add-map']  : '' );
		$meta_key = 'add_map';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['map-embed'] ) ?  $_POST['map-embed']  : '' );
		$meta_key = 'map_embed';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
		$new_meta_value = ( isset( $_POST['add-slider'] ) ?  $_POST['add-slider']  : '' );
		$meta_key = 'add_slider';
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		
		if ( $new_meta_value && '' == $meta_value ){
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}elseif ( $new_meta_value && $new_meta_value != $meta_value ){
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}elseif ( '' == $new_meta_value && $meta_value ){
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}
?>