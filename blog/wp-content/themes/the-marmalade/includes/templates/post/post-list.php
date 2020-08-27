<?php 
	$custom_settings_meta = get_post_meta( get_the_ID(), 'custom_settings', true );
	$custom_settings = (empty($custom_settings_meta)) ? false : $custom_settings_meta;
	if ($custom_settings) {
		$show_title_meta = get_post_meta( get_the_ID(), 'show_title', true );
		$show_content_meta = get_post_meta( get_the_ID(), 'show_content', true );
		$show_counters_meta = get_post_meta( get_the_ID(), 'show_counters', true );
		$show_share_meta = get_post_meta( get_the_ID(), 'show_share', true );
		$show_related_meta = get_post_meta( get_the_ID(), 'show_related', true );

		$show_title = (empty($show_title_meta)) ? 'always' : $show_title_meta;
		$show_content = (empty($show_content_meta)) ? 'always' : $show_content_meta;
		$show_counters = (empty($show_counters_meta)) ? 'always' : $show_counters_meta;
		$show_share = (empty($show_share_meta)) ? 'always' : $show_share_meta;
		$show_related = (empty($show_related_meta)) ? 'post' : $show_related_meta;
	}else{
		$show_title = get_option('show_title');
		$show_content = get_option('show_content');
		$show_counters = get_option('show_counters');
		$show_share = get_option('show_share');
		$show_related = get_option('show_related');
	}	

	$spotlight_meta = get_post_meta( get_the_ID(), 'spotlight', true );
	$spotlight_content_color_meta = get_post_meta( get_the_ID(), 'spotlight_content_color', true );

	$spotlight = (empty($spotlight_meta)) ? false : $spotlight_meta;
	$spotlight_content_color = (empty($spotlight_content_color_meta)) ? 'dark' : $spotlight_content_color_meta;
?>
<?php if ( $spotlight && (is_home() || is_category())): ?>
	<?php if ( has_post_thumbnail() ) { ?>
		<a class="bg-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php }else{ ?>
		<a class="bg-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	<?php } ?>
	<article class="spotlight <?php echo esc_attr($spotlight_content_color); ?>">
<?php else: ?>
	<article>
<?php endif ?>
	<?php if ($show_title == 'always'): ?>
		<header>
			<div class="post-categories">
				<?php $post_categories = wp_get_post_categories( get_the_ID() );	
					foreach($post_categories as $c){
						$cat = get_category( $c );
						$id = get_cat_ID($cat->name); ?>
						<a href="<?php echo get_category_link( $id ); ?>"><?php echo esc_attr($cat->name); ?></a>
				<?php } ?>
			</div>
			<a href="<?php the_permalink(); ?>">
				<h2><?php the_title() ?></h2>
			</a>
			<a class='post-date' href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time(get_option( 'date_format' )); ?></a>
		</header>
	<?php endif ?>
	<?php 
		if ( !$spotlight ) {
			if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			<?php }else{ ?>
				<?php get_template_part( 'includes/templates/post/post','type'); ?>
			<?php }
	} ?>
	<?php if ($show_content == 'always'): ?>
		<?php the_excerpt(); ?>
	<?php endif ?>
	<?php if ($show_content == 'always' || $show_counters == 'always' || $show_share == 'always'): ?>
		<footer>
		<?php if ($show_content == 'always' || $show_title == 'never' || $show_title == 'post'): ?>
			<a href="<?php the_permalink(); ?>" class="btn btn-default btn-hover read-more"><?php _e('Read more', 'pryaniktheme' ); ?></a>
		<?php endif ?>
		<?php if ($show_counters == 'always'): ?>
			<ul class="list-inline post-counters">
				<li>
					<a href="<?php echo get_permalink(); ?>#comments"><i class="fa fa-comment-o"></i><?php comments_number('0','1','%'); ?></a>
				</li><li>
					<?php echo getPostLikeLink( get_the_ID() ); ?>
				</li>
			</ul>
		<?php endif ?>
		<?php if ($show_share == 'always'): ?>
			<div class="share-btn">
				<p><i class="fa fa-share-alt"></i><?php _e('Share','pryaniktheme'); ?></p>
				<ul class="list-inline">
					<li>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink($post->ID); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-facebook"></i></a>
					</li>
					<li>
						<a href="https://twitter.com/home?status=<?php echo get_permalink($post->ID); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="https://plus.google.com/share?url=<?php echo get_permalink($post->ID); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"><i class="fa fa-google-plus"></i></a>
					</li>
				</ul>
			</div>
		<?php endif ?>
		</footer>
	<?php endif ?>
</article>
<?php if ($show_related == 'always'): ?>
	<div class="related">
		<h3><?php _e('Related posts', 'pryaniktheme'); ?></h3>
		<?php  
			$orig_post = $post;  
			global $post;
			$tags = wp_get_post_tags($post->ID);
			if ($tags) {
				$tag_ids = array();  
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
					$args=array(  
						'tag__in' => $tag_ids,  
						'post__not_in' => array($post->ID), 
						'ignore_sticky_posts' => true
					);
				$query = new wp_query( $args );
				if ($query->found_posts > 3) { ?>
					<ul class="related-slider"> 
				<?php }else{ ?>
					<ul class="related-slider deactivated"> 
				<?php }
				while( $query->have_posts() ) {  
					$query->the_post(); ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<li style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
						<?php }else{ ?>
						<li class="no-featured">
						<?php } ?>
						<a href="<?php the_permalink(); ?>">
							<div>
								<p><?php the_title() ?></p>
								<p><?php the_time(get_option( 'date_format' )); ?></p>
							</div>
						</a>
					</li>
				<?php } ?>
				</ul>
			<?php }  
			$post = $orig_post;
		?>
	</div>
<?php endif ?>