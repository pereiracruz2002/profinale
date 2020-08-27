<?php
	$logo_position = get_option('logo_position');
	$upload_logo = get_option('upload_logo');
	$upload_logo2x = get_option('upload_logo2x');
	$add_search = get_option('add_search');
	$search_type = get_option('search_type');
	$add_toggle = get_option('add_toggle');
	$search_position = get_option('search_position');
?>
	<div class="container">
		<a class="logo" href="<?php echo esc_url( home_url() ); ?>">
			<img
				src="<?php echo esc_url($upload_logo) ?>"
				srcset="<?php echo esc_url($upload_logo) . ' 1x ,' . esc_url($upload_logo2x) . ' 2x' ?>"
				alt="logo">
		</a>
		<?php if ($search_position == 'logo' && ( $add_search || $add_toggle )) { ?>
			<div class="search-div">
				<?php if ($add_search) { ?>
					<?php if ($search_type == 'default'): ?>
						<div class="search default">
							<?php
								if ($logo_position == 'right') {
									get_template_part( 'includes/templates/header/search','right');
								} else {
									get_template_part( 'includes/templates/header/search','left');
								}
							 ?>
						</div>
					<?php else: ?>
						<div class="search dropdown">
							<?php get_template_part( 'includes/templates/header/search','dropdown'); ?>
						</div>
					<?php endif; ?>
				<?php } ?>
				<?php if ($add_toggle) { ?>
					<button type="button" role="button" aria-label="Toggle Navigation" class="lines-button x toggle-sidebar-button">
						<span class="lines"></span>
					</button>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>