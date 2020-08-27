<?php 

	function author_social_profile_fields( $user ) { ?>
		<h3>Social Settings</h3>
		<table class="form-table">
			<tr>
				<th><label for="facebook">Facebook</label></th>
				<td>
					<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="instagram">Instagram</label></th>
				<td>
					<input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="twitter2">Twitter</label></th>
				<td>
					<input type="text" name="twitter2" id="twitter2" value="<?php echo esc_attr( get_the_author_meta( 'twitter2', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="google_plus">Google+</label></th>
				<td>
					<input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="behance">Behance</label></th>
				<td>
					<input type="text" name="behance" id="behance" value="<?php echo esc_attr( get_the_author_meta( 'behance', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="dribbble">Dribbble</label></th>
				<td>
					<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="linkedin">LinkedIn</label></th>
				<td>
					<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="skype">Skype</label></th>
				<td>
					<input type="text" name="skype" id="skype" value="<?php echo esc_attr( get_the_author_meta( 'skype', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="pinterest">Pinterest</label></th>
				<td>
					<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="youtube">Youtube</label></th>
				<td>
					<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="tumblr">Tumblr</label></th>
				<td>
					<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="flickr">Flickr</label></th>
				<td>
					<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="rss">RSS</label></th>
				<td>
					<input type="text" name="rss" id="rss" value="<?php echo esc_attr( get_the_author_meta( 'rss', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="github">Github</label></th>
				<td>
					<input type="text" name="github" id="github" value="<?php echo esc_attr( get_the_author_meta( 'github', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="soundcloud">SoundCloud</label></th>
				<td>
					<input type="text" name="soundcloud" id="soundcloud" value="<?php echo esc_attr( get_the_author_meta( 'soundcloud', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="vk">VK</label></th>
				<td>
					<input type="text" name="vk" id="vk" value="<?php echo esc_attr( get_the_author_meta( 'vk', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th><label for="digg">Digg</label></th>
				<td>
					<input type="text" name="digg" id="digg" value="<?php echo esc_attr( get_the_author_meta( 'digg', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
				<th><label for="dropbox">Dropbox</label></th>
				<td>
					<input type="text" name="dropbox" id="dropbox" value="<?php echo esc_attr( get_the_author_meta( 'dropbox', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>

		</table>
<?php } 
	
	add_action( 'show_user_profile', 'author_social_profile_fields' );
	add_action( 'edit_user_profile', 'author_social_profile_fields' );

	function save_author_social_profile_fields( $user_id ) {
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;
		update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
		update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
		update_user_meta( $user_id, 'twitter2', $_POST['twitter2'] );
		update_user_meta( $user_id, 'google_plus', $_POST['google_plus'] );
		update_user_meta( $user_id, 'behance', $_POST['behance'] );
		update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
		update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
		update_user_meta( $user_id, 'skype', $_POST['skype'] );
		update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
		update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
		update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );
		update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
		update_user_meta( $user_id, 'rss', $_POST['rss'] );
		update_user_meta( $user_id, 'github', $_POST['github'] );
		update_user_meta( $user_id, 'soundcloud', $_POST['soundcloud'] );
		update_user_meta( $user_id, 'vk', $_POST['vk'] );
		update_user_meta( $user_id, 'digg', $_POST['digg'] );
		update_user_meta( $user_id, 'dropbox', $_POST['dropbox'] );
	}
	add_action( 'personal_options_update', 'save_author_social_profile_fields' );
	add_action( 'edit_user_profile_update', 'save_author_social_profile_fields' );

	function get_author_social() { ?>
		<ul class="social">
			<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'facebook' ); ?>"><i class="fa fa-facebook"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'instagram' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'instagram' ); ?>"><i class="fa fa-instagram"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'twitter2' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'twitter2' ); ?>"><i class="fa fa-twitter"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'google_plus' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'google_plus' ); ?>"><i class="fa fa-google-plus"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'behance' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'behance' ); ?>"><i class="fa fa-behance"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'dribbble' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'dribbble' ); ?>"><i class="fa fa-dribbble"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'linkedin' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'linkedin' ); ?>"><i class="fa fa-linkedin"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'skype' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'skype' ); ?>"><i class="fa fa-skype"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'pinterest' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'pinterest' ); ?>"><i class="fa fa-pinterest"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'youtube' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'youtube' ); ?>"><i class="fa fa-youtube"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'tumblr' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'tumblr' ); ?>"><i class="fa fa-tumblr"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'flickr' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'flickr' ); ?>"><i class="fa fa-flickr"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'rss' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'rss' ); ?>"><i class="fa fa-rss"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'github' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'github' ); ?>"><i class="fa fa-github"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'soundcloud' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'soundcloud' ); ?>"><i class="fa fa-soundcloud"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'vk' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'vk' ); ?>"><i class="fa fa-vk"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'digg' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'digg' ); ?>"><i class="fa fa-digg"></i></a>
				</li>
			<?php } ?>
			<?php if ( get_the_author_meta( 'dropbox' ) ) { ?>
				<li>
					<a href="<?php the_author_meta( 'dropbox' ); ?>"><i class="fa fa-dropbox"></i></a>
				</li>
			<?php } ?>
		</ul>
	<?php }
?>