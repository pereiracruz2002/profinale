<?php get_header(); ?>
<div class="error-404">
	<div class="container">
		<img src="<?php echo PRYANIK_INC_URI . 'img/404.png' ?>" alt="404">
		<div class="content">
			<h2><?php _e('404. That&#8217;s an error.','pryaniktheme') ?> </h2>
			<h3><?php _e('The requirest URL was not found on this server.', 'pryaniktheme') ?></h3>
			<p><?php _e('That&#8217;s all we know.', 'pryaniktheme') ?></p>
			<a href="<?php echo esc_url(site_url()); ?>" class="btn btn-default btn-hover"><?php _e('Home Page', 'pryaniktheme') ?></a>
		</div>
	</div>		
</div>
<?php get_footer(); ?>