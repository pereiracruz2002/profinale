<?php get_header(); ?>
<?php 
	$search_sidebar_layout = get_option('search_sidebar_layout');
?>
<div class="container">
	<div class="row">
		<div class="page-title">
		<?php
			$author = '';
			if(is_author()) {
				$id = get_query_var('author');
				$author = get_userdata( $id );
				} ?>

			<h1><?php 
				if (is_category()) {
					_e('All posts in ', 'pryaniktheme');echo '<span>';echo single_cat_title('',false);echo '</span>';

				} elseif (is_tag()) {
					__('All posts tagged %s', 'pryaniktheme');echo '<span>';echo single_tag_title('',false);echo '</span>';

				} elseif (is_day()) {
					_e('Archive for ', 'pryaniktheme');echo '<span>'; the_time('F jS, Y');echo '</span>';

				} elseif (is_month()) { 
					_e('Archive for ', 'pryaniktheme');echo '<span>'; the_time('F, Y');echo '</span>';

				} elseif (is_year()) { 
					_e('Archive for ', 'pryaniktheme');echo '<span>'; the_time('Y');echo '</span>';

				} elseif (is_author()) { 
					_e('All posts by ', 'pryaniktheme');echo '<span>'; echo esc_attr($author->display_name);echo '</span>';

				} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
					__('All items in %s', 'pryaniktheme');echo '<span>';echo single_cat_title('',false); echo '</span>';
				}else{
					__('All posts in %s', 'pryaniktheme');echo '<span>';echo  get_post_format();echo '</span>';
				}
			?></h1>
		</div>
<?php 
	$sidebar = get_option('search_sidebar');
	$type = get_option('search_grid_type');
	$layout = get_option('search_layout');
	switch ($search_sidebar_layout) {
		case 'left': ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php break;
		case 'right': ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php break;
		case 'none': ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php break;
		default: ?>
			<?php get_template_part( 'includes/templates/archive/archive','loop'); ?>
			<?php include(locate_template('includes/templates/sidebar-template.php'));?>
			<?php break;
	}
?>
	</div>
</div>
<?php get_footer(); ?>