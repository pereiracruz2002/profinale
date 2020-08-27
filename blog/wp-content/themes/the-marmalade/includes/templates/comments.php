<?php $num = get_comments_number(); ?>
<?php if ($num > 0) { ?>
	<div class="comments" id="comments">
		<h3><?php _e('Comments','pryaniktheme'); ?></h3>
		<ul>
			<?php
				$comments = get_comments(array(
					'post_id' => get_the_ID(),
					'status' => 'approve' 
				));
				$pages = get_comment_pages_count( $comments );

				wp_list_comments(array( 
					'reverse_top_level' => false,
					'callback' => 'pryanik_comment_callback'
				), $comments);
			?>
    	</ul>
		<?php 
			if ($pages > 1) { ?>
				<div class="pagination">
					<p>
	    			<?php paginate_comments_links(array(
	    								'prev_text'    => __('<' , 'pryaniktheme'),
										'next_text'    => __('>', 'pryaniktheme'))); ?>
					</p>
				</div>
		<?php  } ?>
	</div>
<?php } ?>
<?php if (comments_open()): ?>
	<?php comment_form(); ?>
<?php endif ?>