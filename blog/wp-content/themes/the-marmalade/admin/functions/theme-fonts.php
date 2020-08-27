<?php
/*-----------------------------------------------------------------------------------*/
/*
/*  Generate Font Name (current not needed)
/*
/*-----------------------------------------------------------------------------------*/

// Generate Name
function font_family($font) {

	$family = str_replace(" ", "+", $font);
	return $family;
}

/*-----------------------------------------------------------------------------------*/
/*
/*  Enqueue Standard & Create Array Of Custom
/*
/*-----------------------------------------------------------------------------------*/

// Enqueue Normal Fonts
function pryanik_enqueue_fonts() {

	// Create array of system fonts
	$default = array(
				'default',
				'Default',
				'arial',
				'Arial',
				'verdana',
				'Verdana',
				'trebuchet',
				'Trebuchet',
				'georgia',
				'Georgia',
				'times',
				'Times',
				'tahoma',
				'Tahoma',
				'helvetica',
				'Helvetica'
				);

	$fonts = array();

	$menu = get_option('menu_font_family');
	if($menu!='') { $fonts[] = $menu; }

	$body_font_family = get_option( 'body_font_family' );
	if($body_font_family!='') { $fonts[] = $body_font_family; }

	$h1_font_family = get_option( 'h1_font_family' );
	if($h1_font_family!='') { $fonts[] = $h1_font_family; }
	$h2_font_family = get_option( 'h2_font_family' );
	if($h2_font_family!='') { $fonts[] = $h2_font_family; }
	$h3_font_family = get_option( 'h3_font_family' );
	if($h3_font_family!='') { $fonts[] = $h3_font_family; }
	$h4_font_family = get_option( 'h4_font_family' );
	if($h4_font_family!='') { $fonts[] = $h4_font_family; }
	$h5_font_family = get_option( 'h5_font_family' );
	if($h5_font_family!='') { $fonts[] = $h5_font_family; }
	$h6_font_family = get_option( 'h6_font_family' );
	if($h6_font_family!='') { $fonts[] = $h6_font_family; }

	$buttons_font_family = get_option( 'buttons_font_family' );
	if($buttons_font_family!='') { $fonts[] = $buttons_font_family; }

	
	$fonts = array_unique($fonts);

	foreach($fonts as $font) {
		if(!in_array($font, $default)) {
			pryanik_enqueue_google_fonts($font);

		}
	}

}
add_action( 'wp_enqueue_scripts', 'pryanik_enqueue_fonts' );


/*-----------------------------------------------------------------------------------*/
/*
/*  Enqueue Custom Google Fonts
/*
/*-----------------------------------------------------------------------------------*/

function pryanik_enqueue_google_fonts($font) {

	$font = explode(',', $font);
	$font = $font[0];

	if ( $font == 'Open Sans' ){
		$font = 'Open Sans:400,600';
	} else {
		$font = $font . ':400,700';
	}

	$font = str_replace(" ", "+", $font);

	wp_enqueue_style( "google_$font", "http://fonts.googleapis.com/css?family=$font", false, null, 'all' );
} ?>