<?php 
	$custom_settings_meta = get_post_meta( get_the_ID(), 'custom_settings', true );
	$custom_settings = (empty($custom_settings_meta)) ? false : $custom_settings_meta;
	if ($custom_settings) {
		$show_title_meta = get_post_meta( get_the_ID(), 'show_title', true );
		$show_content_meta = get_post_meta( get_the_ID(), 'show_content', true );
		$show_counters_meta = get_post_meta( get_the_ID(), 'show_counters', true );
		$show_share_meta = get_post_meta( get_the_ID(), 'show_share', true );
		$show_related_meta = get_post_meta( get_the_ID(), 'show_related', true );
		$show_author_meta = get_post_meta( get_the_ID(), 'show_author', true ); 
		$hide_nav_meta = get_post_meta( get_the_ID(), 'hide_nav', true ); 

		$show_title = (empty($show_title_meta)) ? 'always' : $show_title_meta;
		$show_content = (empty($show_content_meta)) ? 'always' : $show_content_meta;
		$show_counters = (empty($show_counters_meta)) ? 'always' : $show_counters_meta;
		$show_share = (empty($show_share_meta)) ? 'always' : $show_share_meta;
		$show_related = (empty($show_related_meta)) ? 'post' : $show_related_meta;
		$show_author = (empty($show_author_meta)) ? true : $show_author_meta;
		$hide_nav = (empty($hide_nav_meta)) ? false : $hide_nav_meta;
	}else{
		$show_title = get_option('show_title');
		$show_content = get_option('show_content');
		$show_counters = get_option('show_counters');
		$show_share = get_option('show_share');
		$show_related = get_option('show_related');
		$show_author = get_option('show_author');
		$hide_nav = get_option('hide_nav');
	}	

	$spotlight_meta = get_post_meta( get_the_ID(), 'spotlight', true );
	$spotlight_content_color_meta = get_post_meta( get_the_ID(), 'spotlight_content_color', true );

	$spotlight = (empty($spotlight_meta)) ? false : $spotlight_meta;
	$spotlight_content_color = (empty($spotlight_content_color_meta)) ? 'dark' : $spotlight_content_color_meta;
?>

<?php 
	$post_page_sidebar_layout = get_option('post_page_sidebar_layout');
	$blog_type = get_option('blog_type');
	$blog_layout = get_option('blog_layout');
?>
<?php if ( $post_page_sidebar_layout == 'none' ): ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
<?php elseif ( $blog_type == 'list' || ( $blog_type == 'grid' && $blog_layout == '2col' ) ): ?>
	<div class="col-md-8 col-sm-12 col-xs-12">
<?php else: ?>
	<div class="col-md-9 col-sm-12 col-xs-12">
<?php endif ?>

	<article class="main-post">
		<?php if ($show_title == 'always' || $show_title == 'post'): ?>
			<header>
				<div class="post-categories">
					<?php $post_categories = wp_get_post_categories( get_the_ID() );	
						foreach($post_categories as $c){
							$cat = get_category( $c );
							$id = get_cat_ID($cat->name); ?>
							<a href="<?php echo get_category_link( $id ); ?>"><?php echo esc_attr($cat->name); ?></a>
					<?php } ?>
				</div>
				<h2><?php the_title(); ?></h2>
				<a class='post-date' href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time(get_option( 'date_format' )); ?></a>
			</header>
		<?php endif ?>
		<?php get_template_part( 'includes/templates/post/post','type'); ?>

		<?php if ($show_content == 'always' || $show_content == 'post'): ?>
			<div class="post-content">
				<?php echo the_content(); ?>
			</div>
			<?php $links = wp_link_pages(array(
								'before'           => '<div class="pagination"><p>',
								'after'            => '</p></div>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
								'next_or_number'   => 'number',
								'separator'        => '',
								'nextpagelink'     => __('>', 'pryaniktheme'),
								'previouspagelink' => __('<' , 'pryaniktheme'),
								'pagelink'         => '%',
								'echo'             => 0
							)); 
			$links = str_replace ('<a' , '<a class="page-numbers" ' , $links );
			$links = str_replace ('<div class="pagination"><p><span>' , '<div class="pagination"><p><span class="page-numbers current">' , $links );
			$links = str_replace ('<div class="pagination"><p> <span>' , '<div class="pagination"><p><span class="page-numbers current">' , $links );
			$links = str_replace ('</a><span>' , '</a><span class="page-numbers current">' , $links );

			echo balanceTags($links);

			?>
		<?php endif ?>
		<footer>
			<div class="row ">
				<div class="tagcloud col-md-6 col-sm-6">
					<h4><?php _e( 'Tags', 'pryaniktheme' ); ?></h4>
					<?php the_tags('', '', '' ); ?>
				</div>
				<div class="post-meta">
					<?php if ($show_share == 'always' || $show_share == 'post'): ?>
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
					<?php if ($show_counters == 'always' || $show_counters == 'post'): ?>
						<ul class="list-inline post-counters">
							<li>
								<a href="#comments"><i class="fa fa-comment-o"></i><?php comments_number('0','1','%'); ?></a>
							</li><li>
								<?php echo getPostLikeLink( get_the_ID() ); ?>
							</li>
						</ul>
					<?php endif ?>
				</div>
			</div>
		</footer>
	</article>
	<?php if ($show_author): ?>
		<div class="author-block">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 512 ); ?>
			<div class="about-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><h4><?php echo get_the_author_meta( 'display_name' ); ?></h4></a>
				<p><?php echo get_the_author_meta( 'description' ); ?></p>
				<?php get_author_social(); ?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($show_related == 'always' || $show_related == 'post'): ?>
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
	<?php if (!post_password_required()): ?>
		<?php comments_template( '/includes/templates/comments.php'); ?>
	<?php endif ?>
	<?php if (	!$hide_nav ){ ?> 
		<div class="post-nav">
			<div class="post-nav-prev">
				<?php previous_post_link('%link', __('Previous post','pryaniktheme') ); ?>
				<?php $prev_post = get_adjacent_post(false, '', true); ?>
				<?php if ( !empty( $prev_post ) ): ?>
					<p class="post-nav-title"><?php echo wp_kses_post($prev_post->post_title); ?></p>
				<?php endif; ?>
			</div>
			<div class="post-nav-next">
				<?php next_post_link('%link', __('Next post','pryaniktheme') ); ?>
				<?php $next_post = get_adjacent_post( false, '', false); ?>
				<?php if ( !empty( $next_post ) ): ?>
					<p class="post-nav-title"><?php echo wp_kses_post($next_post->post_title); ?></p>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
</div>