<?php 
	$instagram_user = get_option('instagram_user');
	$instagram_cols = get_option('instagram_cols');
	$instagram_rows = get_option('instagram_rows');
	$add_instagram_hover = get_option('add_instagram_hover');
	$limit = intval($instagram_cols) * intval($instagram_rows);
 ?>
 <?php if ( $instagram_user != '' ) { ?>
 	<div class="fullwidth-instagram col-<?php echo esc_attr($instagram_cols); ?> <?php echo esc_attr($limit); ?>">
		<?php $media_array = scrape_instagram( $instagram_user, $limit );
			if ( is_wp_error( $media_array ) ) {
				echo esc_attr($media_array->get_error_message());
			} else {
				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) )
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				// filters for custom classe
			   
				$aclass = esc_attr( apply_filters( 'wpiw_a_class', '' ) );
				$imgclass = esc_attr( apply_filters( 'wpiw_img_class', '' ) );

				?>
				<ul class="instagram-feed"><?php
					foreach ( $media_array as $item ) {
						if ($add_instagram_hover) {
							echo '<li style="background-image: url('. esc_url( $item['thumbnail'] ) .')"><a href="'. esc_url( $item['link'] ) .'" title="'. esc_attr( $item['description'] ).'"><div class="overlay"><span><p><i class="fa fa-comment"></i>'. esc_attr( $item['comments'] ) .'</p><p><i class="fa fa-heart"></i>'. esc_attr( $item['likes'] ) .'</p></span></div></a></li>';
						}else{
							echo '<li style="background-image: url('. esc_url( $item['thumbnail'] ) .')"><a href="'. esc_url( $item['link'] ) .'" title="'. esc_attr( $item['description'] ).'"></a></li>';
						}
					}
					?></ul>
				</div>
		<?php } ?>
	</div>
<?php } ?>
 

 <?php 
 	function scrape_instagram( $username, $slice = 9 ) {
		$username = strtolower( $username );
		if ( false === ( $instagram = get_transient( 'instagram-media-'.sanitize_title_with_dashes( $username ) ) ) ) {
			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );
			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'wpiw' ) );
			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'wpiw' ) );
			$shards = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], TRUE );
			if ( !$insta_array )
				return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			}
			if ( !is_array( $images ) )
				return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'wpiw' ) );
			$instagram = array();
			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {
						if ( $image['user']['username'] == $username ) {
							$image['link']						  = preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );
							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  => $image['link'],
								'time'		  => $image['created_time'],
								'comments'	  => $image['comments']['count'],
								'likes'		 => $image['likes']['count'],
								'thumbnail'	 => $image['images']['thumbnail'],
								'large'		 => $image['images']['standard_resolution'],
								'small'		 => $image['images']['low_resolution'],
								'type'		  => $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {
						$image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );
						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}
						$instagram[] = array(
							'description'   => __( 'Instagram Image', 'wpiw' ),
							'link'		  => '//instagram.com/p/' . $image['code'],
							'time'		  => $image['date'],
							'comments'	  => $image['comments']['count'],
							'likes'		 => $image['likes']['count'],
							'thumbnail'	 => $image['display_src'],
							'type'		  => $type
						);
					}
				break;
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
			return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'wpiw' ) );
		}
	}

	function images_only($media_item) {
		if ($media_item['type'] == 'image')
			return true;
		return false;
	} 
?>