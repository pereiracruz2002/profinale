<?php 
	$sidebar_layout_meta = get_post_meta( get_the_ID(), 'sidebar_layout', true );

	$sidebar_layout = (empty($sidebar_layout_meta)) ? 'right' : $sidebar_layout_meta;
	$blog_type = get_option('blog_type');
	$blog_layout = get_option('blog_layout');
?>
<?php if ( $sidebar_layout == 'none' ): ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
<?php elseif ( $blog_type == 'list' || ( $blog_type == 'grid' && $blog_layout == '2col' ) ): ?>
	<div class="col-md-8 col-sm-12 col-xs-12">
<?php else: ?>
	<div class="col-md-9 col-sm-12 col-xs-12">
<?php endif ?>

	<article class="main-post">
		<div class="post-content">
			<?php echo the_content(); ?>
		</div>
	</article>
	
	<?php if (!post_password_required()): ?>
		<?php comments_template( '/includes/templates/comments.php'); ?>
	<?php endif ?>

</div>