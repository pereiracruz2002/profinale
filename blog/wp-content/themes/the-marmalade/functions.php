<?php
	$dir_path = dirname( __FILE__ );
	// PryanikFramework Core Admin Initialization
	require_once ( trailingslashit( $dir_path ) . 'admin/admin-init.php' );

	// Theme Initialization
	require_once ( trailingslashit( $dir_path ) . 'admin/theme-init.php' );
	/*-----------------------------------------------------------------------------------*/
	/* You can add custom functions below */
	/*-----------------------------------------------------------------------------------*/
?>