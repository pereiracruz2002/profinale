( function( $ ) {

	//Genereal Settings

	//Customize Logo

	wp.customize( 'upload_logo', function( value ) {
		value.bind( function( newval ) {
			$( '.logo img' ).attr('src', newval);
			$( '.logo img' ).attr('srcset', newval);
		} );
	} );

	wp.customize( 'upload_logo2x', function( value ) {
		value.bind( function( newval ) {
			var srcset = $( '.logo img' ).attr('srcset');
			$( '.logo img' ).attr('srcset', srcset + ', ' +newval + ' 2x');
		} );
	} );

	wp.customize( 'logo_position', function( value ) {
		value.bind( function( newval ) {
			switch(newval) {
				case 'left':
					$('.logo-bar').removeClass('left center right').addClass('left');
					break;
				case 'center':
					$('.logo-bar').removeClass('left center right').addClass('center');
					break;
				case 'right':
					$('.logo-bar').removeClass('left center right').addClass('right');
					break;
				default:
					$('.logo-bar').removeClass('left center right').addClass('center');
			}
		} );
	} );

	wp.customize( 'logo_padding_top', function( value ) {
		value.bind( function( newval ) {
			$(".logo-bar .container").css('padding-top',newval+'px');
		} );
	} );

	wp.customize( 'logo_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$(".logo-bar .container").css('padding-bottom',newval+'px');
		} );
	} );

	wp.customize( 'logo_background_color', function( value ) {
		value.bind( function( newval ) {
			$(".logo-bar").css('background-color',newval);
			$(".logo-bar .container").css('background-color',newval);
		} );
	} );

	//Customize Menu

	wp.customize( 'menu_float', function( value ) {
		value.bind( function( newval ) {
			switch(newval) {
				case 'left':
					$('.menu-bar').removeClass('left center right').addClass('left');
					break;
				case 'center':
					$('.menu-bar').removeClass('left center right').addClass('center');
					break;
				case 'right':
					$('.menu-bar').removeClass('left center right').addClass('right');
					break;
				default:
					$('.menu-bar').removeClass('left center right').addClass('center');
			}
		} );
	} );
	wp.customize( 'menu_padding_top', function( value ) {
		value.bind( function( newval ) {
			$(".menu-bar .container").css('padding-top',newval+'px');
		} );
	} );
	wp.customize( 'menu_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$(".menu-bar .container").css('padding-bottom',newval+'px');
		} );
	} );
	wp.customize( 'menu_background_color', function( value ) {
		value.bind( function( newval ) {
			$(".menu-bar").css('background-color',newval);
			$(".menu-bar .container").css('background-color',newval);
		} );
	} );
	wp.customize( 'menu_li_padding', function( value ) {
		value.bind( function( newval ) {
			$(".header-menu li").css('padding-left',newval+'px');
			$(".header-menu li").css('padding-right',newval+'px');
		} );
	} );
	wp.customize( 'menu_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$(".header-menu li > a").css('font-family',newval);
		} );
	} );
	wp.customize( 'menu_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".header-menu li > a").css('font-weight','bold');
			}else{
				$(".header-menu li > a").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'menu_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".header-menu li > a").css('text-transform','uppercase');
			}else{
				$(".header-menu li > a").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'menu_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".header-menu li > a").css('font-style','italic');
			}else{
				$(".header-menu li > a").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'menu_font_size', function( value ) {
		value.bind( function( newval ) {
			$(".header-menu li > a").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'menu_lineheight', function( value ) {
		value.bind( function( newval ) {
			$(".header-menu li > a").css('line-height',newval+'em');
		} );
	} );
	wp.customize( 'menu_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$(".header-menu li > a").css('letter-spacing',newval+'px');
		} );
	} );
	wp.customize( 'menu_color', function( value ) {
		value.bind( function( newval ) {
			$(".header-menu li > a").css('color',newval);
		} );
	} );

	//Customize General Header Settings

	wp.customize( 'search_color', function( value ) {
		value.bind( function( newval ) {
			var last = $("head style").last().html();
			if (last.indexOf(".lines-button .lines:before") >= 0 && last.indexOf("/*- Logo Settings -*/") <= 0){
				$("head style").last().remove();
				$("head style").last().remove();
				$('head').append('<style>.lines-button .lines:before{background-color:' + newval + ' !important;}</style>');
				$('head').append('<style>.lines-button .lines:after{background-color:' + newval + ' !important;}</style>');
			}else{
				$('head').append('<style>.lines-button .lines:before{background-color:' + newval + ' !important;}</style>');
				$('head').append('<style>.lines-button .lines:after{background-color:' + newval + ' !important;}</style>');
			}
			$(".lines-button .lines").css('background-color',newval);
			$(".search.default i").css('color',newval);
		} );
	} );
	wp.customize( 'divider_color', function( value ) {
		value.bind( function( newval ) {
			$(".menu-bar:last-child .container").css('border-top', '1px solid ' + newval);
			$(".logo-bar:last-child .container").css('border-top', '1px solid ' + newval);
		} );
	} );

	//Customize Toggle Sidebar Settings

	wp.customize( 'toggle_sidebar_color', function( value ) {
		value.bind( function( newval ) {
			$(".toggle-sidebar").css('background-color',newval);
			$(".toggle-sidebar .widget h5").css('background-color',newval);
		} );
	} );
	wp.customize( 'toggle_sidebar_widgets_color', function( value ) {
		value.bind( function( newval ) {
			$(".toggle-sidebar").removeClass('dark').removeClass('light').addClass(newval);
		} );
	} );
	wp.customize( 'toggle_sidebar_width', function( value ) {
		value.bind( function( newval ) {
			$(".toggle-sidebar").css('width',newval+'px');
		} );
	} );

	//Customize Post Page Layout Settings

	wp.customize( 'post_title_padding_top', function( value ) {
		value.bind( function( newval ) {
			$(".custom-title").css('padding-top',newval+'px');
		} );
	} );

	wp.customize( 'post_title_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$(".custom-title").css('padding-bottom',newval+'px');
		} );
	} );

	//Background

	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$(".main").css('background-color',newval);
			$("body").css('background-color',newval);
		} );
	} );
	wp.customize( 'background_stretch', function( value ) {
		value.bind( function( newval ) {
			if (newval) {
				$(".main").css('background-size','cover');
				$("body").css('background-size','cover');
			}else{
				$(".main").css('background-size','auto');
				$("body").css('background-size','auto');
			}
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( newval ) {
			$(".main").css('background-image','url('+newval+')');
			$("body").css('background-image','url('+newval+')');
		} );
	} );
	wp.customize( 'background_repeat', function( value ) {
		value.bind( function( newval ) {
			$(".main").css('background-repeat',newval);
			$("body").css('background-repeat',newval);
		} );
	} );
	wp.customize( 'background_position', function( value ) {
		value.bind( function( newval ) {
			$(".main").css('background-position',newval);
			$("body").css('background-position',newval);
		} );
	} );
	wp.customize( 'background_attachment', function( value ) {
		value.bind( function( newval ) {
			$(".main").css('background-attachment',newval);
			$("body").css('background-attachment',newval);
		} );
	} );

	//Typography Settings

	wp.customize( 'body_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("p,a,table,li").css('font-family',newval);
		} );
	} );
	wp.customize( 'body_font_size', function( value ) {
		value.bind( function( newval ) {
			$("p,table,.post-content ul > li,.comment-text ul > li").css('font-size',newval+'px');
		} );
	} );

	wp.customize( 'h1_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h1").css('font-family',newval);
		} );
	} );
	wp.customize( 'h1_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h1").css('font-weight','bold');
			}else{
				$("h1").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h1_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h1").css('text-transform','uppercase');
			}else{
				$("h1").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h1_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h1").css('font-style','italic');
			}else{
				$("h1").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h1_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h1").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h1_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h1").css('letter-spacing',newval+'px');
		} );
	} );

	wp.customize( 'h2_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h2").css('font-family',newval);
		} );
	} );
	wp.customize( 'h2_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h2").css('font-weight','bold');
			}else{
				$("h2").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h2_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h2").css('text-transform','uppercase');
			}else{
				$("h2").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h2_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h2").css('font-style','italic');
			}else{
				$("h2").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h2_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h2").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h2_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h2").css('letter-spacing',newval+'px');
		} );
	} );

	wp.customize( 'h3_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h3").css('font-family',newval);
		} );
	} );
	wp.customize( 'h3_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h3").css('font-weight','bold');
			}else{
				$("h3").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h3_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h3").css('text-transform','uppercase');
			}else{
				$("h3").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h3_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h3").css('font-style','italic');
			}else{
				$("h3").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h3_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h3").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h3_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h3").css('letter-spacing',newval+'px');
		} );
	} );

	wp.customize( 'h4_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h4").css('font-family',newval);
		} );
	} );
	wp.customize( 'h4_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h4").css('font-weight','bold');
			}else{
				$("h4").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h4_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h4").css('text-transform','uppercase');
			}else{
				$("h4").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h4_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h4").css('font-style','italic');
			}else{
				$("h4").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h4_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h4").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h4_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h4").css('letter-spacing',newval+'px');
		} );
	} );

	wp.customize( 'h5_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h5").css('font-family',newval);
		} );
	} );
	wp.customize( 'h5_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h5").css('font-weight','bold');
			}else{
				$("h5").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h5_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h5").css('text-transform','uppercase');
			}else{
				$("h5").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h5_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h5").css('font-style','italic');
			}else{
				$("h5").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h5_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h5").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h5_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h5").css('letter-spacing',newval+'px');
		} );
	} );

	wp.customize( 'h6_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$("h6").css('font-family',newval);
		} );
	} );
	wp.customize( 'h6_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h6").css('font-weight','bold');
			}else{
				$("h6").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'h6_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h6").css('text-transform','uppercase');
			}else{
				$("h6").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'h6_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$("h6").css('font-style','italic');
			}else{
				$("h6").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'h6_font_size', function( value ) {
		value.bind( function( newval ) {
			$("h6").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'h6_letterspacing', function( value ) {
		value.bind( function( newval ) {
			$("h6").css('letter-spacing',newval+'px');
		} );
	} );

	//Buttons Settings

	wp.customize( 'buttons_font_family', function( value ) {
		value.bind( function( newval ) {
			$('head').append('<link href="http://fonts.googleapis.com/css?family='+newval+'" rel="stylesheet" type="text/css">');
			$(".btn").css('font-family',newval);
		} );
	} );
	wp.customize( 'buttons_font_weight', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".btn").css('font-weight','bold');
			}else{
				$(".btn").css('font-weight','normal');
			}
		} );
	} );
	wp.customize( 'buttons_text_transform', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".btn").css('text-transform','uppercase');
			}else{
				$(".btn").css('text-transform','none');
			}
		} );
	} );
	wp.customize( 'buttons_italic', function( value ) {
		value.bind( function( newval ) {
			if (newval==true) {
				$(".btn").css('font-style','italic');
			}else{
				$(".btn").css('font-style','normal');
			}
		} );
	} );
	wp.customize( 'buttons_xs_font_size', function( value ) {
		value.bind( function( newval ) {
			$(".btn-xs").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'buttons_sm_font_size', function( value ) {
		value.bind( function( newval ) {
			$(".btn-sm").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'buttons_font_size', function( value ) {
		value.bind( function( newval ) {
			$(".btn").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'buttons_lg_font_size', function( value ) {
		value.bind( function( newval ) {
			$(".btn-lg").css('font-size',newval+'px');
		} );
	} );
	wp.customize( 'buttons_border_radius', function( value ) {
		value.bind( function( newval ) {
			$(".btn").css('border-radius',newval+'px');
		} );
	} );
	wp.customize( 'buttons_border_width', function( value ) {
		value.bind( function( newval ) {
			$(".btn").css('border-width',newval+'px');
		} );
	} );

	//Customize Footer Settings

	wp.customize( 'footer_color', function( value ) {
		value.bind( function( newval ) {
			$("footer.footer").css('background-color',newval);
			$("footer.footer .widget h5").css('background-color',newval);
		} );
	} );
	wp.customize( 'footer_widgets_color', function( value ) {
		value.bind( function( newval ) {
			$("footer.footer").removeClass('dark').removeClass('light').addClass(newval);
		} );
	} );
	wp.customize( 'footer_layout', function( value ) {
		value.bind( function( newval ) {
			$(".footer .widget").each(function(){
				if (newval == '2col') {
					$(this).removeClass('col-md-4 col-md-3').addClass('col-md-6');
				};
				if (newval == '3col') {
					$(this).removeClass('col-md-6 col-md-3').addClass('col-md-4');
				};
				if (newval == '4col') {
					$(this).removeClass('col-md-6 col-md-4').addClass('col-md-3');
				};
			});
		} );
	} );
	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( newval ) {
			$( 'footer .copyright' ).html(newval);
		} );
	} );
	wp.customize( 'upload_footer_logo', function( value ) {
		value.bind( function( newval ) {
			$( 'footer .logo img' ).attr('src', newval);
			$( 'footer .logo img' ).attr('srcset', newval);
		} );
	} );
	wp.customize( 'upload_footer_logo2x', function( value ) {
		value.bind( function( newval ) {
			var srcset = $( '.footer-logo img' ).attr('srcset');
			$( 'footer .logo img' ).attr('srcset', srcset + ', ' +newval + ' 2x');
		} );
	} );


	function hexToRgb(hex) {
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
	}


} )( jQuery );