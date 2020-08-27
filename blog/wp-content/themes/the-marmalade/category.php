<?php get_header(); ?>
<?php 

	$category_sidebar_layout = get_option('category_sidebar_layout');
	$cat_id = get_queried_object_id();
	$term_meta = get_option( "taxonomy_$cat_id" );
	$img = $term_meta['title_img'];
	$img = str_replace('http://','',$img);
?>
<?php if ( $img ): ?>
	<div class="page-title custom-title" style="background-image: url(<?php echo wp_get_attachment_url($img); ?>)">
		<div class="container">
			<h1><?php echo get_cat_name( $cat_id ); ?></h1>
		</div>
	</div>
	<div class="container">
		<div class="row">
<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="page-title">
				<h1><?php echo get_cat_name( $cat_id ); ?></h1>
			</div>
<?php endif ?>
<?php 
	$sidebar = get_option('category_sidebar');
	$type = get_option('category_type');
	$layout = get_option('category_layout');
	switch ($category_sidebar_layout) {
		case 'left': ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php get_template_part( 'includes/templates/category/category','loop'); ?>
			<?php break;
		case 'right': ?>
			<?php get_template_part( 'includes/templates/category/category','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php break;
		case 'none': ?>
			<?php get_template_part( 'includes/templates/category/category','loop'); ?>
			<?php break;
		default: ?>
			<?php get_template_part( 'includes/templates/category/category','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php')); ?>
			<?php break;
	}
?>
	</div>
</div>
<?php get_footer(); ?>