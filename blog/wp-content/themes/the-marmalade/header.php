<!DOCTYPE html>
<!--[if IE 9]><html class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<link href="<?php echo esc_url(get_option( 'upload_favicon', '' )) ?>" rel="icon" type="image/png" />
	<link rel="shortcut icon" href="<?php echo esc_url(get_option( 'upload_favicon', '' )) ?>" type="image/x-icon" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_option( 'upload_apple_icon', '' )) ?>">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<meta charset="utf-8">
	<?php wp_enqueue_script("jquery"); ?>
	<?php wp_head(); ?>
</head>
<?php
	$site_layout = get_option('site_layout');
	$hide_menu = get_option('hide_menu');
	$menu_position = get_option('menu_position');
	$menu_float = get_option('menu_float');
	$logo_position = get_option('logo_position');

	$add_toggle = get_option('add_toggle');
	$select_toggle_sidebar = get_option('select_toggle_sidebar');
	$toggle_sidebar_widgets_color = get_option('toggle_sidebar_widgets_color');

	$search_position = get_option('search_position');
?>
<?php if ($site_layout=='boxed') { ?>
	<body <?php body_class('boxed'); ?>>
		<div class="container">
<?php }else{ ?>
	<body <?php body_class('fullwidth'); ?>>
<?php } ?>
	<?php if (get_option( 'add_loader') && is_home()) {?>
		<?php $upload_loader = get_option('upload_loader'); ?>
		<div id="loader">
		<?php if ($upload_loader): ?>
			<img src="<?php echo esc_url($upload_loader) ?>" alt="">
		<?php else: ?>
			<img src="<?php echo PRYANIK_INC_URI . 'img/loader.gif' ?>" alt="">
		<?php endif ?>

		</div>
	<?php } ?>
	<?php if ($add_toggle): ?>
		<?php if (($search_position == 'logo' && $logo_position == 'left') || ($search_position == 'menu' && $menu_float == 'left')): ?>
			<div class="toggle-sidebar toggle-right <?php echo esc_attr($toggle_sidebar_widgets_color) ?>" >
		<?php else: ?>
			<div class="toggle-sidebar toggle-left <?php echo esc_attr($toggle_sidebar_widgets_color) ?>" >
		<?php endif; ?>
			<?php if ( is_active_sidebar( $select_toggle_sidebar ) ) : ?>
				<ul class="grid">
					<?php dynamic_sidebar( $select_toggle_sidebar ); ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="toggle-overlay"></div>
	<?php endif ?>
	<header>
	<?php if ($hide_menu):
		switch ($logo_position) {
			case 'left':
				echo '<div class="logo-bar left">';
				break;
			case 'right':
				echo '<div class="logo-bar right">';
				break;
			case 'center':
				echo '<div class="logo-bar center">';
				break;
			default:
				echo '<div class="logo-bar center">';
				break;
		}
		get_template_part( 'includes/templates/header/logo','template');
	else:
		if ($menu_position == 'before') {
			switch ($menu_float) {
				case 'left':
					echo '<div class="menu-bar left">';
					break;
				case 'right':
					echo '<div class="menu-bar right">';
					break;
				case 'center':
					echo '<div class="menu-bar center">';
					break;
				default:
					echo '<div class="menu-bar center">';
					break;
			}
			get_template_part( 'includes/templates/header/menu','template');
			switch ($logo_position) {
				case 'left':
					echo '<div class="logo-bar left">';
					break;
				case 'right':
					echo '<div class="logo-bar right">';
					break;
				case 'center':
					echo '<div class="logo-bar center">';
					break;
				default:
					echo '<div class="logo-bar center">';
					break;
			}
			get_template_part( 'includes/templates/header/logo','template');
		}else{
			switch ($logo_position) {
				case 'left':
					echo '<div class="logo-bar left">';
					break;
				case 'right':
					echo '<div class="logo-bar right">';
					break;
				case 'center':
					echo '<div class="logo-bar center">';
					break;
				default:
					echo '<div class="logo-bar center">';
					break;
			}
			get_template_part( 'includes/templates/header/logo','template');
			switch ($menu_float) {
				case 'left':
					echo '<div class="menu-bar left">';
					break;
				case 'right':
					echo '<div class="menu-bar right">';
					break;
				case 'center':
					echo '<div class="menu-bar center">';
					break;
				default:
					echo '<div class="menu-bar center">';
					break;
			}
			get_template_part( 'includes/templates/header/menu','template');
		} ?>
	<?php endif ?>
	</header>
	<?php if (is_front_page()): ?>
		<?php
		$slider_shortcode = get_option('slider_shortcode');
		if (!empty($slider_shortcode)) {
			echo do_shortcode( $slider_shortcode );
		}
		?>
	<?php endif ?>
	<div class="main">
