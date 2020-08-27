<?php 
	$search_sidebar_layout = get_option('search_sidebar_layout');
	$search_type = get_option('search_grid_type');
	$search_layout = get_option('search_layout');
	$blog_pagination= get_option('blog_pagination');
?>
<?php if ( $search_sidebar_layout == 'none' ): ?>
	<div id="masonry" class="col-md-12 col-sm-12 col-xs-12 blog-<?php echo esc_attr($search_type); ?>">
<?php elseif ( $search_type == 'list' || ( $search_type == 'grid' && $search_layout == '2col' ) ): ?>
	<div id="masonry" class="col-md-8 col-sm-12 col-xs-12 blog-<?php echo esc_attr($search_type); ?>">
<?php else: ?>
	<div id="masonry" class="col-md-9 col-sm-12 col-xs-12 blog-<?php echo esc_attr($search_type); ?>">
<?php endif ?>

	<div class="row">
	
	<?php 
		if ( $wp_query->have_posts() ) : 
			echo '<ul class="posts grid col-md-12 col-sm-12 col-xs-12">';
			while ( $wp_query->have_posts() ) : 
				$wp_query->the_post();	
				$type = get_post_type(get_the_ID());
				if ($type=="post") { 
					if ( $search_type == 'list') { ?>
						</ul>
						<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 col-xs-12 post-fullwidth'); ?>>
							<?php get_template_part( 'includes/templates/post/post','list'); ?>
						</div>
						<ul class="posts grid col-md-12 col-sm-12 col-xs-12">
					<?php }else{
						switch ($search_layout) {
							case '2col': ?>
								<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 col-xs-12 post-grid'); ?>>
								<?php break;
							case '3col': ?>
								<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 col-xs-12 post-grid'); ?>>
								<?php break;
							default: ?>
								<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 col-xs-12 post-grid'); ?>>
								<?php break;
						}
						get_template_part( 'includes/templates/post/post','grid'); ?>
						</li>
					<?php } 
				} ?>
		<?php 
			endwhile; 
			echo '</ul>';?>
			<?php if ($wp_query->max_num_pages > 1): ?>
				<?php if ($blog_pagination == 'default'): ?>
					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<p class="pagination">
						<?php echo paginate_links( array(
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'mid_size' => 1,
						'prev_text'    => __('<', 'pryaniktheme'),
						'next_text'    => __('>', 'pryaniktheme'),
						) ); ?>
						</p>
					</div>
				<?php else: ?>
					<div class="blog-pagination col-md-12 col-sm-12 col-xs-12"> 
						<?php echo str_replace('<a ', '<a class="prev" ', get_next_posts_link( __( 'Older posts', 'pryaniktheme' ) ) ); ?>
						<?php echo str_replace('<a ', '<a class="next" ', get_previous_posts_link( __( 'Newer posts', 'pryaniktheme' ) ) ); ?>
					</div>
				<?php endif ?>	
			<?php endif ?>
			<?php else: ?>
			<h3><?php _e('Sorry, no posts found.','pryaniktheme'); ?></h3>
		<?php endif; ?>
		
	</div>
</div>