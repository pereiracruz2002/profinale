<?php get_header(); ?>
<?php 
	$blog_sidebar_layout = get_option('blog_sidebar_layout');
?>
<div class="container">
	<div class="row">
<?php 
	$sidebar = get_option('blog_sidebar');
	$type = get_option('blog_type');
	$layout = get_option('blog_layout');
	switch ($blog_sidebar_layout) {
		case 'left': ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php get_template_part( 'includes/templates/blog/blog','loop'); ?>
			<?php break;
		case 'right': ?>
			<?php get_template_part( 'includes/templates/blog/blog','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php break;
		case 'none': ?>
			<?php get_template_part( 'includes/templates/blog/blog','loop'); ?>
			<?php break;
		default: ?>
			<?php get_template_part( 'includes/templates/blog/blog','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php break;
	}
?>
	</div>
</div>
<?php get_footer(); ?>