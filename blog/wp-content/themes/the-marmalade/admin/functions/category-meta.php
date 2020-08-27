<?php 

	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Category Meta
	/*
	/*-----------------------------------------------------------------------------------*/

	function category_add_new_meta_field() { ?>
		<div class="form-field term-img-wrap">
			<label for="term_meta[title_img]"><?php _e( "Featured Image", 'pryaniktheme' ); ?></label>
			<input 	id="upload-image-button"
						class="button button-primary" 
						type="button"
						value="<?php _e("Select image", 'pryaniktheme' ); ?>" />
			<input 	id="term_meta[title_img]"
						name="term_meta[title_img]"
						style="display:none"
						value=""/>
			<p><?php _e( "You could upload featured image for each category.", 'pryaniktheme' ); ?></p>
		</div>
	<?php }
	add_action( 'category_add_form_fields', 'category_add_new_meta_field', 10, 2 );


	function category_edit_meta_field($term) {
		$t_id = $term->term_id;
	 
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<?php $l = $term_meta['title_img']; ?>
		<tr class="form-field term-img-wrap">
			<th scope="row"><label for="term_meta[title_img]"><?php _e( "Featured Image", 'pryaniktheme' ); ?></label></th>
			<td>
				<input 	id="upload-image-button"
						class="button button-primary" 
						type="button"
						value="<?php _e("Select image", 'pryaniktheme' ); ?>" />
				<input 	id="term_meta[title_img]"
						name="term_meta[title_img]"
						style="display:none"
						value="<?php echo esc_attr( $term_meta['title_img'] ) ? esc_attr( $term_meta['title_img'] ) : ''; ?>"/>
				<a href="#" id="remove-media"><?php esc_html_e("Remove image",'pryaniktheme'); ?></a>
				<p><?php _e( "You could upload featured image for each category.", 'pryaniktheme' ); ?></p>
			</td>
		</tr>
	<?php
	}
	add_action( 'category_edit_form_fields', 'category_edit_meta_field', 10, 2 );

	function save_taxonomy_custom_meta( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}  
	add_action( 'edited_category', 'save_taxonomy_custom_meta', 10, 2 );  
	add_action( 'create_category', 'save_taxonomy_custom_meta', 10, 2 );
?>