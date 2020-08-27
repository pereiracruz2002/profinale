<?php
	function pryanik_custom_css(){

		//Logo

		$logo_padding_top = get_option( 'logo_padding_top' );
		$logo_padding_bottom = get_option( 'logo_padding_bottom' );
		$logo_background_color = get_option( 'logo_background_color' );

		//Menu

		$menu_padding_top = get_option( 'menu_padding_top' );
		$menu_padding_bottom = get_option( 'menu_padding_bottom' );
		$menu_background_color = get_option( 'menu_background_color' );

		$menu_li_padding = get_option( 'menu_li_padding' );
		$menu_font_family = get_option( 'menu_font_family' );
		$menu_font_weight = get_option( 'menu_font_weight' );
		$menu_text_transform = get_option( 'menu_text_transform' );
		$menu_italic = get_option( 'menu_italic' );
		$menu_font_size = get_option( 'menu_font_size' );
		$menu_letterspacing = get_option( 'menu_letterspacing' );
		$menu_lineheight = get_option( 'menu_lineheight' );
		$menu_color = get_option( 'menu_color' );

		// General Header Settings

		$search_color = get_option( 'search_color' );
		$divider_color = get_option( 'divider_color' );

		// Toggle Sidebar Settings

		$toggle_sidebar_color = get_option( 'toggle_sidebar_color' );
		$toggle_sidebar_width = get_option( 'toggle_sidebar_width' );

		// Post Page Settings

		$post_title_padding_top = get_option( 'post_title_padding_top' );
		$post_title_padding_bottom = get_option( 'post_title_padding_bottom' );

		// Background Settings

		$background_color = get_option( 'background_color' );
		$background_stretch = get_option( 'background_stretch' );
		$background_image = get_option( 'background_image' );
		$background_repeat = get_option( 'background_repeat' );
		$background_position = get_option( 'background_position' );
		$background_attachment = get_option( 'background_attachment' );

		//Colors Settings 

		$skin_color1 = get_option( 'skin_color1' );
		$skin_color2 = get_option( 'skin_color2' );
		$skin_color_font = get_option( 'skin_color_font' );

		//Buttons Style Settings 

		$buttons_border_radius = get_option( 'buttons_border_radius' );
		$buttons_border_width = get_option( 'buttons_border_width' );

		//Typography Settings

		$body_font_family = get_option( 'body_font_family' );
		$body_font_size = get_option( 'body_font_size' );

		$h1_font_family = get_option( 'h1_font_family' );
		$h1_font_weight = get_option( 'h1_font_weight' );
		$h1_text_transform = get_option( 'h1_text_transform' );
		$h1_italic = get_option( 'h1_italic' );
		$h1_font_size = get_option( 'h1_font_size' );
		$h1_letterspacing = get_option( 'h1_letterspacing' );

		$h2_font_family = get_option( 'h2_font_family' );
		$h2_font_weight = get_option( 'h2_font_weight' );
		$h2_text_transform = get_option( 'h2_text_transform' );
		$h2_italic = get_option( 'h2_italic' );
		$h2_font_size = get_option( 'h2_font_size' );
		$h2_letterspacing = get_option( 'h2_letterspacing' );

		$h3_font_family = get_option( 'h3_font_family' );
		$h3_font_weight = get_option( 'h3_font_weight' );
		$h3_text_transform = get_option( 'h3_text_transform' );
		$h3_italic = get_option( 'h3_italic' );
		$h3_font_size = get_option( 'h3_font_size' );
		$h3_letterspacing = get_option( 'h3_letterspacing' );

		$h4_font_family = get_option( 'h4_font_family' );
		$h4_font_weight = get_option( 'h4_font_weight' );
		$h4_text_transform = get_option( 'h4_text_transform' );
		$h4_italic = get_option( 'h4_italic' );
		$h4_font_size = get_option( 'h4_font_size' );
		$h4_letterspacing = get_option( 'h4_letterspacing' );

		$h5_font_family = get_option( 'h5_font_family' );
		$h5_font_weight = get_option( 'h5_font_weight' );
		$h5_text_transform = get_option( 'h5_text_transform' );
		$h5_italic = get_option( 'h5_italic' );
		$h5_font_size = get_option( 'h5_font_size' );
		$h5_letterspacing = get_option( 'h5_letterspacing' );

		$h6_font_family = get_option( 'h6_font_family' );
		$h6_font_weight = get_option( 'h6_font_weight' );
		$h6_text_transform = get_option( 'h6_text_transform' );
		$h6_italic = get_option( 'h6_italic' );
		$h6_font_size = get_option( 'h6_font_size' );
		$h6_letterspacing = get_option( 'h6_letterspacing' );

		//Buttons Font Settings

		$buttons_font_family = get_option( 'buttons_font_family' );
		$buttons_font_weight = get_option( 'buttons_font_weight' );
		$buttons_text_transform = get_option( 'buttons_text_transform' );
		$buttons_italic = get_option( 'buttons_italic' );
		$buttons_xs_font_size = get_option( 'buttons_xs_font_size' );
		$buttons_sm_font_size = get_option( 'buttons_sm_font_size' );
		$buttons_font_size = get_option( 'buttons_font_size' );
		$buttons_lg_font_size = get_option( 'buttons_lg_font_size' );

		//Footer

		$footer_color = get_option( 'footer_color' );

		ob_start(); ?>

        <style type="text/css">

        	/*- Logo Settings -*/

        	.logo-bar .container{
        		padding-top: <?php echo esc_attr($logo_padding_top) . 'px' ; ?>;
        		padding-bottom: <?php echo esc_attr($logo_padding_bottom) . 'px' ; ?>;
        		background-color: <?php echo esc_attr($logo_background_color) ; ?>;
        	}
			.logo-bar{
				background-color: <?php echo esc_attr($logo_background_color) ; ?>;
			}

        	/*- Menu Settings -*/

        	.menu-bar .container{
        		padding-top: <?php echo esc_attr($menu_padding_top) . 'px' ; ?>;
        		padding-bottom: <?php echo esc_attr($menu_padding_bottom) . 'px' ; ?>;
        		background-color: <?php echo esc_attr($menu_background_color) ; ?>;
        	}
			.menu-bar{
				background-color: <?php echo esc_attr($menu_background_color) ; ?>;
			}
			.header-menu .list-inline > li{
				padding-left: <?php echo esc_attr($menu_li_padding) . 'px' ; ?>;
				padding-right: <?php echo esc_attr($menu_li_padding) . 'px' ; ?>;
			}
			.header-menu .sub-menu{
				left: <?php echo esc_attr($menu_li_padding) . 'px' ; ?>;
			}
        	.header-menu .list-inline > li > a{
        		font-family: <?php echo esc_attr($menu_font_family) ; ?>;
        		font-size: <?php echo esc_attr($menu_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($menu_letterspacing) . 'px' ; ?>;
        		line-height: <?php echo esc_attr($menu_lineheight) ; ?>;
        		color: <?php echo esc_attr($menu_color) ; ?>;
        	}

        	<?php if($menu_font_weight){ ?> .header-menu .list-inline > li > a { font-weight: bold; } <?php }else{ ?>
													.header-menu .list-inline > li > a { font-weight: normal; }<?php } ?>

			<?php if($menu_text_transform){ ?> .header-menu .list-inline > li > a { text-transform: uppercase; } <?php }else{ ?>
											   		.header-menu .list-inline > li > a { text-transform: none; }<?php } ?>
			<?php if($menu_italic){ ?> .header-menu .list-inline > li > a { font-style: italic; } <?php }else{ ?>
								   			.header-menu .list-inline > li > a { font-style: normal ; }<?php } ?>

			/*- General Header Settings -*/

			.lines-button .lines,
			.lines-button .lines:before,
			.lines-button .lines:after{
				background-color: <?php echo esc_attr($search_color) ; ?>;
			}
			.search.default i, .search.dropdown .btn i{
				color: <?php echo esc_attr($search_color) ; ?>;
			}
			.menu-bar:last-child .container,
			.logo-bar:last-child .container{
				border-top: 1px solid <?php echo esc_attr($divider_color) ; ?>;
			}

			/*- Toggle Sidebar Settings -*/

			.toggle-sidebar{
				width: <?php echo esc_attr($toggle_sidebar_width) . 'px' ; ?>;
				background-color: <?php echo esc_attr($toggle_sidebar_color) ; ?>;
			}
			.toggle-sidebar .widget h5 {
  				background-color: <?php echo esc_attr($toggle_sidebar_color) ; ?>;
  			}

  			/*- Post Page Settings -*/

			.custom-post-title{
				padding-top: <?php echo esc_attr($post_title_padding_top) . 'px' ; ?>;
        		padding-bottom: <?php echo esc_attr($post_title_padding_bottom) . 'px' ; ?>;
			}

			/*- Background Settings -*/

			body,
			.main{
        		background-color: <?php echo '#' . esc_attr($background_color); ?>;
        		background-image: <?php echo "url(" . esc_attr($background_image) . ")"; ?>;
        		background-repeat: <?php echo esc_attr($background_repeat); ?>;
        		background-position: <?php echo esc_attr($background_position); ?>;
        		background-attachment: <?php echo esc_attr($background_attachment); ?>;
        	}
				
			/*- Colors Settings -*/

			a:hover,
			a:focus,
			.header-menu .list-inline > li:hover > a,
			.post-categories a,
			.share-btn:hover p,
			.spotlight.light .share-btn:hover p,
			.share-btn a:hover,
			.post-slider .controls .prev:hover,
			.post-slider .controls .next:hover,
			.post .quote i,
			.related-slider .owl-controls .owl-prev:hover i:before,
			.related-slider .owl-controls .owl-next:hover i:before,
			.comment-reply-link:hover:before,
			.page-title span,
			.nav-tabs > li.active  a,
			.nav-tabs > li.active  a:hover,
			.nav-tabs > li.active  a:focus,
			.panel-heading h4 a,
			.dark .recent article .post-title:hover,
			.post-content p a,
			.comment-text p a
			 {
				color: <?php echo esc_attr($skin_color1); ?>;
			}

			.search.dropdown .input-group .btn:hover,
			.header-menu .list-inline > li > a:before,
			.audio-controls .current,
			.tagcloud a:hover,
			.widget ul > li > a:hover:before,
			.widget.widget_recent_entries ul > li:hover > a:before,
			.widget .input-group-btn .btn-default:hover,
			.dark .widget .input-group-btn .btn-default:hover,
			.recent article img,
			.recent article .img,
			.btn-hover::before,
			.btn-default:hover,
			.btn-default:active,
			.btn-default.active,
			.open > .dropdown-toggle.btn-default,
			.dark .widget .btn-default:hover,
			.btn-default.btn-hover::before,
			.btn-primary,
			.btn-primary::before,
			.btn-success::before,
			.btn-info::before,
			.btn-warning::before,
			.btn-danger::before,
			.btn-disabled::before,
			.page-numbers.current,
			.page-numbers.current:hover
			{
				background-color: <?php echo esc_attr($skin_color1); ?>;
			}

			.blog-pagination a:hover,
			.tagcloud a:hover,
			.post-nav a:hover,
			.widget ul > li > a:before,
			.widget.widget_recent_entries ul > li > a:before,
			.widget .input-group-btn .btn-default:hover,
			.dark .widget .input-group-btn .btn-default:hover,
			.btn-default:hover,
			.btn-default:active,
			.btn-default.active,
			.open > .dropdown-toggle.btn-default,
			.dark .widget .btn-default:hover,
			.btn-default.btn-hover:hover,
			.btn-default.btn-hover:active,
			.btn-default.btn-hover.active,
			.open > .dropdown-toggle.btn-default.btn-hover,
			.btn-primary,
			.nav-tabs > li.active  a,
			.nav-tabs > li.active  a:hover,
			.nav-tabs > li.active  a:focus,
			.panel-heading h4 a,
			.post-content ul > li:before,
			.comment-text ul > li:before			
			{
					border-color: <?php echo esc_attr($skin_color1); ?>;
			}
			
			.post-date:hover,
			.spotlight.light .post-date:hover,
			.spotlight.dark .post-date:hover
			{
				color: <?php echo esc_attr($skin_color2); ?>;
			}
			.audio-controls .volume .currentvolume{
				background-color: <?php echo esc_attr($skin_color2); ?>;
			}
			blockquote{
				border-color: <?php echo esc_attr($skin_color2); ?>;
			}

			/*- Typography Settings -*/

			p,a,table,li{
				font-family: <?php echo esc_attr($body_font_family); ?>;
			}
			p,table,
			.post-content ul > li, 
			.comment-text ul > li{
				font-size: <?php echo esc_attr($body_font_size) . 'px' ; ?>;
			}
			h1{
        		font-family: <?php echo esc_attr($h1_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h1_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h1_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h1_font_weight){ ?> h1 { font-weight: bold; } <?php }else{ ?>
											h1 { font-weight: normal; }<?php } ?>

			<?php if($h1_text_transform){ ?>  h1 { text-transform: uppercase; } <?php }else{ ?>
											   	h1 { text-transform: none; }<?php } ?>
			<?php if($h1_italic){ ?>  h1 { font-style: italic; } <?php }else{ ?>
								   		h1 { font-style: normal ; }<?php } ?>
			h2{
        		font-family: <?php echo esc_attr($h2_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h2_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h2_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h2_font_weight){ ?> h2 { font-weight: bold; } <?php }else{ ?>
											h2 { font-weight: normal; }<?php } ?>

			<?php if($h2_text_transform){ ?>  h2 { text-transform: uppercase; } <?php }else{ ?>
											   	h2 { text-transform: none; }<?php } ?>
			<?php if($h2_italic){ ?>  h2 { font-style: italic; } <?php }else{ ?>
								   		h2 { font-style: normal ; }<?php } ?>
			h3{
        		font-family: <?php echo esc_attr($h3_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h3_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h3_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h3_font_weight){ ?> h3 { font-weight: bold; } <?php }else{ ?>
											h3 { font-weight: normal; }<?php } ?>

			<?php if($h3_text_transform){ ?>  h3 { text-transform: uppercase; } <?php }else{ ?>
											   	h3 { text-transform: none; }<?php } ?>
			<?php if($h3_italic){ ?>  h3 { font-style: italic; } <?php }else{ ?>
								   		h3 { font-style: normal ; }<?php } ?>
			h4{
        		font-family: <?php echo esc_attr($h4_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h4_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h4_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h4_font_weight){ ?> h4 { font-weight: bold; } <?php }else{ ?>
											h4 { font-weight: normal; }<?php } ?>

			<?php if($h4_text_transform){ ?>  h4 { text-transform: uppercase; } <?php }else{ ?>
											   	h4 { text-transform: none; }<?php } ?>
			<?php if($h4_italic){ ?>  h4 { font-style: italic; } <?php }else{ ?>
								   		h4 { font-style: normal ; }<?php } ?>
			h5{
        		font-family: <?php echo esc_attr($h5_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h5_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h5_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h5_font_weight){ ?> h5 { font-weight: bold; } <?php }else{ ?>
											h5 { font-weight: normal; }<?php } ?>

			<?php if($h5_text_transform){ ?>  h5 { text-transform: uppercase; } <?php }else{ ?>
											   	h5 { text-transform: none; }<?php } ?>
			<?php if($h5_italic){ ?>  h5 { font-style: italic; } <?php }else{ ?>
								   		h5 { font-style: normal ; }<?php } ?>
			h6{
        		font-family: <?php echo esc_attr($h6_font_family) ; ?>;
        		font-size: <?php echo esc_attr($h6_font_size) . 'px' ; ?>;
        		letter-spacing: <?php echo esc_attr($h6_letterspacing) . 'px' ; ?>;
        	}

        	<?php if($h6_font_weight){ ?> h6 { font-weight: bold; } <?php }else{ ?>
											h6 { font-weight: normal; }<?php } ?>

			<?php if($h6_text_transform){ ?>  h6 { text-transform: uppercase; } <?php }else{ ?>
											   	h6 { text-transform: none; }<?php } ?>
			<?php if($h6_italic){ ?>  h6 { font-style: italic; } <?php }else{ ?>
								   		h6 { font-style: normal ; }<?php } ?>


			/*- Buttons Settings -*/

			.btn{
				font-family: <?php echo esc_attr($buttons_font_family); ?>;
				font-size: <?php echo esc_attr($buttons_font_size) . 'px' ; ?>;
				border-radius: <?php echo esc_attr($buttons_border_radius) . 'px' ; ?>;
				border-width: <?php echo esc_attr($buttons_border_width) . 'px' ; ?>;
			}
			<?php if($buttons_font_weight){ ?> 	.btn { font-weight: bold; } <?php }else{ ?>
												.btn { font-weight: normal; }<?php } ?>

			<?php if($buttons_text_transform){ ?> 	.btn { text-transform: uppercase; } <?php }else{ ?>
											   		.btn { text-transform: none; }<?php } ?>
			<?php if($buttons_italic){ ?> 	.btn { font-style: italic; } <?php }else{ ?>
								   			.btn { font-style: normal ; }<?php } ?>

			.btn-lg,
			.btn-group-lg > .btn {
			  	font-size: <?php echo esc_attr($buttons_lg_font_size) . 'px' ; ?>;
			  	border-radius: <?php echo esc_attr($buttons_border_radius) . 'px' ; ?>;
			}
			.btn-sm,
			.btn-group-sm > .btn {
			  	font-size: <?php echo esc_attr($buttons_sm_font_size) . 'px' ; ?>;
			  	border-radius: <?php echo esc_attr($buttons_border_radius) . 'px' ; ?>;
			}	
			.btn-xs,
			.btn-group-xs > .btn {
			  	font-size: <?php echo esc_attr($buttons_xs_font_size) . 'px' ; ?>;
			  	border-radius: <?php echo esc_attr($buttons_border_radius) . 'px' ; ?>;
			}

			/*- Footer Settings -*/

			footer.footer{
				background-color: <?php echo esc_attr($footer_color) ; ?>;
			}
			footer.footer .widget h5{
				background-color: <?php echo esc_attr($footer_color) ; ?>;
			}

		</style><?php
	} ?>