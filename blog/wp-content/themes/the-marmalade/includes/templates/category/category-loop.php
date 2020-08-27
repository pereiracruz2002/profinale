<?php 
	$category_sidebar_layout = get_option('category_sidebar_layout');
	$category_type = get_option('category_type');
	$category_layout = get_option('category_layout');
	$category_pagination= get_option('category_pagination');
?>
<?php if ( $category_sidebar_layout == 'none' ): ?>
	<div id="masonry" class="col-md-12 col-sm-12 col-xs-12 blog-<?php echo esc_attr($category_type); ?>">
<?php elseif ( $category_type == 'list' || ( $category_type == 'grid' && $category_layout == '2col' ) ): ?>
	<div id="masonry" class="col-md-8 col-sm-12 col-xs-12 blog-<?php echo esc_attr($category_type); ?>">
<?php else: ?>
	<div id="masonry" class="col-md-9 col-sm-12 col-xs-12 blog-<?php echo esc_attr($category_type); ?>">
<?php endif ?>

	<div class="row">
	
	<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		if ( $wp_query->have_posts() ) : 
			echo '<ul class="posts grid col-md-12 col-sm-12 col-xs-12">';
			while ( $wp_query->have_posts() ) : 
				$wp_query->the_post();

				$show_fullwidth_meta = get_post_meta( get_the_ID(), 'show_fullwidth', true );
				$spotlight_meta = get_post_meta( get_the_ID(), 'spotlight', true );
				$spotlight_content_color_meta = get_post_meta( get_the_ID(), 'spotlight_content_color', true );

				$show_fullwidth = (empty($show_fullwidth_meta)) ? false : $show_fullwidth_meta;
				$spotlight = (empty($spotlight_meta)) ? false : $spotlight_meta;
				$spotlight_content_color = (empty($spotlight_content_color_meta)) ? 'dark' : $spotlight_content_color_meta;
				$spotclass = ($spotlight) ? 'post-spotlight post-spotlight-' . $spotlight_content_color : '' ;
				
				if ( $category_type == 'list' || $show_fullwidth ) { ?>
					</ul>
					<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 col-xs-12 post-fullwidth '. $spotclass); ?>>
						<?php get_template_part( 'includes/templates/post/post','list'); ?>
					</div>
					<ul class="posts grid col-md-12 col-sm-12 col-xs-12">
				<?php }else{
					switch ($category_layout) {
						case '2col': ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 col-xs-12 post-grid '. $spotclass); ?>>
							<?php break;
						case '3col': ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-4 col-xs-12 post-grid '. $spotclass); ?>>
							<?php break;
						default: ?>
							<li id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-sm-6 col-xs-12 post-grid '. $spotclass); ?>>
							<?php break;
					}
					get_template_part( 'includes/templates/post/post','grid'); ?>
					</li>
				<?php } ?>
				
		<?php 
			endwhile; 
			echo '</ul>';?>
			<?php if ($wp_query->max_num_pages > 1): ?>
				<?php if ($category_pagination == 'default'): ?>
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