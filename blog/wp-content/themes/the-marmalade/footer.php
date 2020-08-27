<?php 
	$footer_widgets_color = get_option('footer_widgets_color');
	$footer_widgets = get_option('footer_widgets');
	$footer_layout = get_option('footer_layout');
	$copyright_text = get_option('copyright_text');
	$upload_footer_logo = get_option('upload_footer_logo');
	$upload_footer_logo2x = get_option('upload_footer_logo2x');

	$add_instagram_fullwidth = get_option('add_instagram_fullwidth');
 ?>
		</div>
		<?php if ($add_instagram_fullwidth) {
			get_template_part( 'includes/templates/instagram','footer');
		} ?>
		<?php if (( is_active_sidebar( $footer_widgets ) && is_dynamic_sidebar( $footer_widgets ) ) || !empty($copyright_text) || $upload_footer_logo): ?>
			<footer class="footer <?php echo esc_attr($footer_widgets_color) . ' ' . esc_attr($footer_layout); ?>">
				<div class="container">
					<?php if ( is_active_sidebar( $footer_widgets ) && is_dynamic_sidebar( $footer_widgets ) ) : ?>	
						<div class="widgets" >
							<div class="row">
								<ul class="grid">
									<?php dynamic_sidebar( $footer_widgets ); ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
					<?php if (!empty($copyright_text)): ?>
						<p class="copyright"> <?php echo wp_kses_post($copyright_text); ?> </p>
					<?php endif ?>
					<?php if ($upload_footer_logo): ?>
						<a class="logo" href="<?php echo esc_url( home_url() ); ?>">
							<img
								src="<?php echo esc_url($upload_footer_logo) ?>"
								srcset="<?php echo esc_url($upload_footer_logo) . ' 1x ,' . esc_url($upload_footer_logo2x) . ' 2x' ?>"
								alt="logo">
						</a>
					<?php endif ?>
				</div>
			</footer>
		<?php endif ?>
		<?php wp_footer(); ?>
	</body>
</html>