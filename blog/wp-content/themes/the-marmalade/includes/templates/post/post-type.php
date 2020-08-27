<?php 
	$format = get_post_format(get_the_ID());
	switch ($format) {
		case 'image':
			$img = get_post_meta( get_the_ID(), 'upload_image', true ); 
			if (!empty($img)) { 
				$img = str_replace('http://','',$img); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo wp_get_attachment_image( $img , 'full'); ?>
				</a>
			<?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
				}
			break;
		case 'gallery':
			$gallery_images = get_post_meta( get_the_ID(), 'upload_gallery', true ); 
			$slider_mode = get_post_meta( get_the_ID(), 'slider_mode', true ); 
			$slider_auto = get_post_meta( get_the_ID(), 'slider_auto', true ); 
			$slider_pause = get_post_meta( get_the_ID(), 'slider_pause', true ); 
			if (!empty($gallery_images)) { ?>
				<div class="post-slider" id="<?php echo 'post_' . get_the_ID(); ?>"
					data-auto="<?php echo ( $slider_auto == "on" ) ? 'true' : 'false'; ?>"
					data-pause="<?php echo ( $slider_pause == "0" ) ? '2000' : intval($slider_pause); ?>"			
					data-mode="<?php echo esc_attr($slider_mode); ?>"
				>
					<div class="controls">
						<p class="prev"><i class="flaticon-previous11"></i></p>
						<p class="next"><i class="flaticon-next15"></i></p>
					</div>
					<ul>
					<?php 
						$ids = explode(",", $gallery_images);	
						foreach ($ids as $id) {	
							$id = str_replace('http://','',$id);?>
							<li><?php echo wp_get_attachment_image($id,'full'); ?></li>
						<?php }
					?>
					</ul>
				</div>
			<?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		case 'video':
			$upload_video = get_post_meta( get_the_ID(), 'upload_video', true ); 
			if (!empty($upload_video)) {
				$upload_video = str_replace('<iframe','<iframe class="embed-responsive-item"', $upload_video); ?>
				<div class="embed-responsive embed-responsive-16by9">
					<?php echo balanceTags($upload_video); ?>
				</div>
			<?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		case 'audio':
			$upload_audio = get_post_meta( get_the_ID(), 'upload_audio', true );
			if (!empty($upload_audio)) {
				$code = trim($upload_audio);
				$url = wp_get_attachment_url(str_replace('http://','',$code));
				if (substr($code, 1,6) == "iframe") { ?>
					<?php echo balanceTags($code); ?>
				<?php }elseif (substr($url, 0,4)=="http") { ?>
					<audio src="<?php echo wp_get_attachment_url($code); ?>"></audio>
				<?php }else{
					echo balanceTags($code); 
				}
			}else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		case 'quote': 
			$quote_text = get_post_meta( get_the_ID(), 'quote_text', true );
			$quote_ref = get_post_meta( get_the_ID(), 'quote_ref', true ); 
			if (!empty($quote_text)) { ?>
				<div class="quote">
					<a href="<?php the_permalink(); ?>">
						<i class="fa fa-quote-left"></i>
					</a>
					<p><?php echo esc_attr($quote_text); ?></p>
					<?php if (!empty($quote_ref)): ?>
						<p class="quote-ref"><?php echo esc_attr($quote_ref); ?></p>
					<?php endif ?>
				</div>
			<?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;	
		case 'link': 
			$link_text = get_post_meta( get_the_ID(), 'link_text', true );
			$link_ref = get_post_meta( get_the_ID(), 'link_ref', true ); 
			if (!empty($link_ref)) { ?>
				<div class="quote">
					<a href="<?php the_permalink(); ?>">
						<i class="fa fa-link"></i>
					</a>
					<p><a href="<?php echo esc_attr($link_ref); ?>"><?php echo esc_attr($link_ref); ?></a></p>
					<?php if (!empty($link_text)): ?>
						<p class="link-text"><?php echo esc_attr($link_text); ?></p>
					<?php endif ?>
				</div>
			<?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		case 'status':
			$status_embed_code = get_post_meta( get_the_ID(), 'status_embed_code', true );
			if (!empty($status_embed_code)) { 
				echo balanceTags($status_embed_code);
			}else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		case 'chat':
			$chat = get_post_meta( get_the_ID(), 'chat_list', true );
    		if (!empty($chat)) { ?>
    			<div class="quote">
	    			<a href="<?php the_permalink(); ?>">
						<i class="fa fa-comments"></i>
					</a>
			    	<ul class="chat">
			    	<?php 
			    		$chat_list = trim($chat, " ");
			    		$replies = explode("\n", $chat_list); 
			    		foreach ($replies as $reply) { 
			    			$reply = explode(":", $reply);
			    			?>
			    			<li>
			    				<p><?php echo balanceTags($reply[0]); ?></p>
			    				<p class="msg"><?php echo balanceTags($reply[1]); ?></p>
			    			</li>
			    		<?php }
			    	?>
			        </ul>
		        </div>
		    <?php }else{
				if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				<?php }
			}
			break;
		default:
			if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			<?php }
			break;
	}
 ?>