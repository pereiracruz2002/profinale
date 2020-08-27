<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php 
	$custom_settings_meta = get_post_meta( get_the_ID(), 'custom_settings', true );
	$custom_settings = (empty($custom_settings_meta)) ? false : $custom_settings_meta;

	$post_page_sidebar_layout = get_option('post_page_sidebar_layout');

	$show_custom_title_meta = get_post_meta( get_the_ID(), 'show_custom_title', true ); 
	$custom_post_title_meta = get_post_meta( get_the_ID(), 'custom_post_title', true ); 
	$post_title_image_meta = get_post_meta( get_the_ID(), 'post_title_image', true ); 

	$show_custom_title = (empty($show_custom_title_meta)) ? false : $show_custom_title_meta;
	$custom_post_title = (empty($custom_post_title_meta)) ? '' : $custom_post_title_meta;
	$post_title_image = (empty($post_title_image_meta)) ? '' : $post_title_image_meta;
	$post_title_image = str_replace('http://','',$post_title_image);
?>
<?php if ($show_custom_title): ?>
	<div class="custom-title custom-post-title" style="background-image: url(<?php echo wp_get_attachment_url($post_title_image); ?>)">
		<h1><?php echo wp_kses_post($custom_post_title); ?></h1>
	</div>
<?php endif ?>
<div class="container">
	<div class="row">
		<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 col-sm-12 col-xs-12 post-fullwidth'); ?>>
			<div class="row">
			<?php 
				$sidebar = get_option('post_page_sidebar');
				$type = get_option('blog_type');
				$layout = get_option('blog_layout');
				switch ($post_page_sidebar_layout) {
					case 'left': ?>
						<?php include(locate_template('includes/templates/sidebar-template.php'));?>
						<?php get_template_part( 'includes/templates/post/post','page'); ?>
						<?php break;
					case 'right': ?>
						<?php get_template_part( 'includes/templates/post/post','page'); ?>
						<?php include(locate_template('includes/templates/sidebar-template.php'));?>
						<?php break;
					case 'none': ?>
						<?php get_template_part( 'includes/templates/post/post','page'); ?>
						<?php break;
					default: ?>
						<?php get_template_part( 'includes/templates/post/post','page'); ?>
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