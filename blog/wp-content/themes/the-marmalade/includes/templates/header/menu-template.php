<?php

	$menu_float = get_option('menu_float');
	$add_search = get_option('add_search');
	$search_type = get_option('search_type');
	$add_toggle = get_option('add_toggle');
	$search_position = get_option('search_position');

?>
	<div class="container">
		<nav class="header-menu">
			<?php
				$args = array(
					'theme_location' => 'header-menu',
					'menu_class' => 'list-inline'
				);
				wp_nav_menu( $args );
				?>
		</nav>
		<div class="select-container header-menu">
			<ul class="list-inline">
				<li><a href="#"><?php _e('Menu ','pryaniktheme'); ?><i class="fa fa-angle-down"></i></a></li>
			</ul>
		</div>
		<?php if ($search_position == 'menu' && ( $add_search || $add_toggle )) { ?>
			<div class="search-div">
				<?php if ($add_search) { ?>
					<?php if ($search_type == 'default'): ?>
						<div class="search default">
							<?php
								if ($menu_float == 'right') {
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