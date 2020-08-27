<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
	$show_title_meta = get_post_meta( get_the_ID(), 'show_title', true );
	$sidebar_layout_meta = get_post_meta( get_the_ID(), 'sidebar_layout', true );
	$sidebar_meta = get_post_meta( get_the_ID(), 'sidebar', true );
	$add_map_meta = get_post_meta( get_the_ID(), 'add_map', true );
	$map_embed_meta = get_post_meta( get_the_ID(), 'map_embed', true );
	$add_slider_meta = get_post_meta( get_the_ID(), 'add_slider', true );

	$show_title = (empty($show_title_meta)) ? false : $show_title_meta;
	$sidebar_layout = (empty($sidebar_layout_meta)) ? 'right' : $sidebar_layout_meta;
	$sidebar = (empty($sidebar_meta)) ? 'blog_sidebar1' : $sidebar_meta;
	$add_map = (empty($add_map_meta)) ? false : $add_map_meta;
	$map_embed = (empty($map_embed_meta)) ? '' : $map_embed_meta;
	$add_slider = (empty($add_slider_meta)) ? '' : $add_slider_meta;
?>
<?php if ($show_title || $add_map || !empty($add_slider)): ?>
	<?php if ($add_map): ?>
		<?php if (!empty($map_embed)): ?>
			<div class="embed-map"><div class="map-overlay"></div><?php echo balanceTags($map_embed); ?></div>
		<?php endif ?>
	<?php endif ?>
	<?php if (!empty($add_slider)) {
			echo do_shortcode( $add_slider );
	} ?>
	<?php if ($show_title): ?>
		<?php if ( has_post_thumbnail() ): ?>
			<div class="page-title custom-title" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>)">
				<div class="container">
					<h1><?php echo the_title(); ?></h1>
				</div>
			</div>
			<div class="container">
				<div class="row">
		<?php else: ?>
			<div class="container">
				<div class="row">
					<div class="page-title">
						<h1><?php echo the_title(); ?></h1>
					</div>
		<?php endif ?>
	<?php else: ?>
		<div class="container">
			<div class="row">
	<?php endif ?>
<?php else: ?>
	<div class="container">
		<div class="row">
<?php endif ?>
	<div id="page-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 col-xs-12 post-fullwidth'); ?>>
			<div class="row">
			<?php 
				$sidebar = get_post_meta( get_the_ID(), 'select_sidebar', true ); 
				$type = get_option('blog_type');
				$layout = get_option('blog_layout');
				switch ($sidebar_layout) {
					case 'left': ?>
						<?php include(locate_template('includes/templates/sidebar-template.php'));?>
						<?php get_template_part( 'includes/templates/post/page','page'); ?>
						<?php break;
					case 'right': ?>
						<?php get_template_part( 'includes/templates/post/page','page'); ?>
						<?php include(locate_template('includes/templates/sidebar-template.php'));?>
						<?php break;
					case 'none': ?>
						<?php get_template_part( 'includes/templates/post/page','page'); ?>
						<?php break;
					default: ?>
						<?php get_template_part( 'includes/templates/post/page','page'); ?>
						<?php include(locate_template('includes/templates/sidebar-template.php'));?>
						<?php break;
				}
			?>
			</div>
		</div>
	</div>
</div>
<?php endwhile; else: ?>

	<h3><?php _e('Sorry, no posts found.','pryaniktheme'); ?></h3>

<?php endif; ?>
<?php get_footer(); ?>