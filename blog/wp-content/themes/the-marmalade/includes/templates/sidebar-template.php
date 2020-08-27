<?php if ( $type == 'list' || ( $type == 'grid' && $layout == '2col' ) ): ?>
	<div class="col-md-4 col-sm-12 col-xs-12">
<?php else: ?>
	<div class="col-md-3 col-sm-12 col-xs-12">
<?php endif ?>
		<aside class="light">
			<ul class="grid">
			<?php if ( is_active_sidebar( $sidebar ) ) : ?>	
					<?php dynamic_sidebar( $sidebar ); ?>
			<?php endif; ?>
			</ul>
		</aside>
	</div>