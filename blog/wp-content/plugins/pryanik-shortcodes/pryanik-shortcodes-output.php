<?php
	
	/*-----------------------------------------------------------------------------------*/
	/*
	/*  Define Shortcodes
	/*
	/*-----------------------------------------------------------------------------------*/	

	/*-- Columns ------------------------------------------------------------------------*/	
	/* 1/2 Column First */
	function pryanik_one_half_col_first_func( $atts, $content = null ) {
	   return '<div class="row"><div class="col-md-6 col-sm-6 col-xs-12">' . do_shortcode($content) . '</p></div>';
	}
	add_shortcode( 'one_half_col_first', 'pryanik_one_half_col_first_func' );
	/* 1/3 Column First */
	function pryanik_one_third_col_first_func( $atts, $content = null ) {
	   return '<div class="row"><div class="col-md-4 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_third_col_first', 'pryanik_one_third_col_first_func' );
	/* 1/4 Column First */
	function pryanik_one_fourth_col_first_func( $atts, $content = null ) {
	   return '<div class="row"><div class="col-md-3 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_fourth_col_first', 'pryanik_one_fourth_col_first_func' );
	/* 1/5 Column First */
	function pryanik_one_fifth_col_first_func( $atts, $content = null ) {
	   return '<div class="row"><div class="col-md-15 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_fifth_col_first', 'pryanik_one_fifth_col_first_func' );

	/* 1/2 Column */
	function pryanik_one_half_col_func( $atts, $content = null ) {
	   return '<div class="col-md-6 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_half_col', 'pryanik_one_half_col_func' );
	/* 1/3 Column */
	function pryanik_one_third_col_func( $atts, $content = null ) {
	   return '<div class="col-md-4 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_third_col', 'pryanik_one_third_col_func' );
	/* 1/4 Column */
	function pryanik_one_fourth_col_func( $atts, $content = null ) {
	   return '<div class="col-md-3 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_fourth_col', 'pryanik_one_fourth_col_func' );
	/* 1/5 Column */
	function pryanik_one_fifth_col_func( $atts, $content = null ) {
	   return '<div class="col-md-15 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'one_fifth_col', 'pryanik_one_fifth_col_func' );

	/* 1/2 Column Last */
	function pryanik_one_half_col_last_func( $atts, $content = null ) {
	   return '<div class="col-md-6 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'one_half_col_last', 'pryanik_one_half_col_last_func' );
	/* 1/3 Column Last */
	function pryanik_one_third_col_last_func( $atts, $content = null ) {
	   return '<div class="col-md-4 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'one_third_col_last', 'pryanik_one_third_col_last_func' );
	/* 1/4 Column Last */
	function pryanik_one_fourth_col_last_func( $atts, $content = null ) {
	   return '<div class="col-md-3 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'one_fourth_col_last', 'pryanik_one_fourth_col_last_func' );
	/* 1/5 Column Last */
	function pryanik_one_fifth_col_last_func( $atts, $content = null ) {
	   return '<div class="col-md-15 col-sm-6 col-xs-12">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'one_fifth_col_last', 'pryanik_one_fifth_col_last_func' );

	/*-- Alerts ------------------------------------------------------------------------*/	

	function pryanik_alert_success_func( $atts, $content = null ) {
	   return '<div class="alert alert-success"><p>' . do_shortcode($content) . '</p></div>';
	}
	add_shortcode( 'alert_success', 'pryanik_alert_success_func' );

	function pryanik_alert_info_func( $atts, $content = null ) {
	   return '<div class="alert alert-info"><p>' . do_shortcode($content) . '</p></div>';
	}
	add_shortcode( 'alert_info', 'pryanik_alert_info_func' );

	function pryanik_alert_warning_func( $atts, $content = null ) {
	   return '<div class="alert alert-warning"><p>' . do_shortcode($content) . '</p></div>';
	}
	add_shortcode( 'alert_warning', 'pryanik_alert_warning_func' );

	function pryanik_alert_danger_func( $atts, $content = null ) {
	   return '<div class="alert alert-danger"><p>' . do_shortcode($content) . '</p></div>';
	}
	add_shortcode( 'alert_danger', 'pryanik_alert_danger_func' );

	function pryanik_alert_success_dismiss_func( $atts, $content = null ) {
	   return '<div class="alert alert-success alert-dismissable">'
	   			. '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>' 
	   			. do_shortcode($content) 
	   			. '</p></div>';
	}
	add_shortcode( 'alert_success_dismiss', 'pryanik_alert_success_dismiss_func' );

	function pryanik_alert_info_dismiss_func( $atts, $content = null ) {
	   return '<div class="alert alert-info alert-dismissable">' 
	   			. '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'
	   			. do_shortcode($content) 
	   			. '</p></div>';
	}
	add_shortcode( 'alert_info_dismiss', 'pryanik_alert_info_dismiss_func' );

	function pryanik_alert_warning_dismiss_func( $atts, $content = null ) {
	   return '<div class="alert alert-warning alert-dismissable">' 
	   			. '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'
	   			. do_shortcode($content) 
	   			. '</p></div>';
	}
	add_shortcode( 'alert_warning_dismiss', 'pryanik_alert_warning_dismiss_func' );

	function pryanik_alert_danger_dismiss_func( $atts, $content = null ) {
	   return '<div class="alert alert-danger alert-dismissable">' 
	   			. '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>'
	   			. do_shortcode($content) 
	   			. '</p></div>';
	}
	add_shortcode( 'alert_danger_dismiss', 'pryanik_alert_danger_dismiss_func' );

	/*-- Tabs ------------------------------------------------------------------------*/	

	function pryanik_tab_headers_func( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'num' => ''
	    ), $atts));

	    STATIC $i = 0;
		$i++;

		preg_match_all( '/tab_content title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }

		$output = '';
		if( count($tab_titles) ){

			$output .= '<ul class="nav nav-tabs list-inline">';

			foreach ($tab_titles as $tab) {
				$output .= '<li><h4><a href="#' . sanitize_title($tab[0]) . '" data-toggle="tab">' . $tab[0] . '</a></h4></li>';
			}
			$output .= '</ul><div class="tab-content">';
			$output .= do_shortcode( $content );
			$output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}

	   	return $output;
	}
	add_shortcode( 'tab_headers', 'pryanik_tab_headers_func' );


	function pryanik_tab_content_func( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'tab'
	    ), $atts));
	   	return '<div class="tab-pane" id="' . sanitize_title($title) . '">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'tab_content', 'pryanik_tab_content_func' );

	/*-- Toggles ------------------------------------------------------------------------*/	

	function pryanik_accordion_func( $atts, $content = null ) {
	   return '<div class="panel-group" id="accordion">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'accordion', 'pryanik_accordion_func' );

	function pryanik_panel_func( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'num' => '1',
			'title' => 'Title'
	    ), $atts));

	   return '<div class="panel panel-default">'
					. '<div class="panel-heading">'
						. '<h4>'
							. '<a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $num . '" class = "collapsed">'
								. $title	          		
							. '</a>'
						. '</h4>'
					. '</div>'
					. '<div id="collapse' . $num . '" class="panel-collapse collapse">'
						. '<div class="panel-body">'
							. do_shortcode($content)
						. '</div>'
					. '</div>'
				.'</div>';
	}
	add_shortcode( 'panel', 'pryanik_panel_func' );

	/*-- Buttons ------------------------------------------------------------------------*/	

	function pryanik_button_func( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Button',
			'url' => 'http://',
			'color' => 'default',
			'size' => '',
			'icon' => '',
			'icon_align' => 'right',
			'rotate' => ' ',
			'target' => '_self'
	    ), $atts));
	    if ($color == 'default'){
	    	$output = '<a target="'. $target .'" href="'. $url .'" class="btn btn-hover btn-' . $color . ' ' . $size . '">';
	    }elseif ($color == 'disabled'){
	    	$output = '<a target="'. $target .'" href="'. $url .'" class="disabled btn btn-' . $color . ' ' . $size . '">';
	    }else{
	    	$output = '<a target="'. $target .'" href="'. $url .'" class="btn btn-' . $color . ' ' . $size . '">';
	    }
	    if ($icon) {
	    	if ($icon_align == 'left') {
	    		$output = $output . '<i class="left fa fa-' . $icon . ' ' . $rotate . '"></i>' . $title .'</a>';
	    	}else{
	    		$output = $output . $title . '<i class="right fa fa-' . $icon . ' ' . $rotate . '"></i>' . '</a>';
	    	}
	    }else{
	    	$output = $output . $title . '</a>';
	    }
	    return $output;
	   	
	}
	add_shortcode( 'button', 'pryanik_button_func' );

	/*-- Dividers ------------------------------------------------------------------------*/

	function pryanik_divider_func( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Divider',
			'style' => 'style1',
			'align' => 'left'
	    ), $atts));
	   	return '<div class="divider ' . $style . ' ' . $align . '" style="text-align:' . $align . '"><h5>' . $title . '</h5></div>';
	   	
	}
	add_shortcode( 'divider', 'pryanik_divider_func' );

	/*-- Services ------------------------------------------------------------------------*/	

	function pryanik_services_func( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => '',
			'url' => '',
			'icon' => '',
			'size' => '2x',
			'rotate' => '',
			'background_style' => '',
			'border_width' => '1',
			'border_color' => '#ddd',
			'background_color' => '#ddd',
			'icon_color' => ''
	    ), $atts));
	   	$output = "<div class='service-box box-". $size . ' ' . $background_style . "'>" . "<i class='fa fa-" . $icon . " fa-" . $size . " " . $rotate . "' style='border:". $border_width ."px solid ". $border_color .";background:". $background_color.";color:".$icon_color."'></i>";

	   	if ($title != '') {
	   		$output = $output . "<h4>";
	   		if ($url != '') {
		   		$output = $output . "<a href='" . $url  . "'>" . $title . "</a></h4>";
		   	}else{
		   		$output = $output . $title . "</h4>";
		   	}
	   	}

	   	$output = $output . '<p>' . do_shortcode($content) . "</p></div>";
	   	return $output;
	   	
	}
	add_shortcode( 'service', 'pryanik_services_func' );

?>