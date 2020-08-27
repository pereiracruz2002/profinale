<?php get_header(); ?>
<?php 
	$search_sidebar_layout = get_option('search_sidebar_layout');
?>
<div class="container">
	<div class="row">
	<div class="page-title">
		<h1><?php _e('Search results for', 'pryaniktheme'); ?> <span><?php echo the_search_query(); ?></span></h1>
	</div>
<?php 
	switch ($search_sidebar_layout) {
		case 'left': ?>
			<?php get_template_part( 'includes/templates/archive/sidebar','template'); ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php break;
		case 'right': ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php get_template_part( 'includes/templates/archive/sidebar','template'); ?>
			<?php break;
		case 'none': ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php break;
		default: ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php get_template_part( 'includes/templates/archive/sidebar','template'); ?>
			<?php break;
	}
?>
	</div>
</div>
<?php get_footer(); ?>