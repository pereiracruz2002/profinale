jQuery(document).ready(function( $ ){
  "use strict";

  	$('p:empty').remove();
  	$(".main").fitVids();

    $('.header-menu li:not(.menu-item-has-children) a').on('touchend', function(e) {
        var el = $(this);
        var link = el.attr('href');
        window.location = link;
    });

	//--------------- Init Footer Contact Form Widget ------------------//

  	$(".wpcf7-submit").each(function(){
		var value = $(this).val();
		var button = '<button type="submit" class="btn btn-default btn-hover">'+value+'</button>'
		if ($(this).parents('.dark').length) {
			$(this).parents('.widget').addClass('spotlight light');
		}
		$(this).after(button);
		$(this).remove();
	});

	//--------------- Init Instagram Widget ------------------//

    $(".instagram-feed li").each(function(){
  		var width = $(this)[0].getBoundingClientRect().width;
  		$(this).css('height', width + 'px');
  	});

  	//--------------- Init Facebook Widget ------------------//

	$(".widget_facebook").each(function(){
		var height = 130;
		height = height + $(this).find('.widget-title').outerHeight(true);
		if ($(this).find('.fb-page').data("show-posts")) {
			height = height + 369;
		}else{
			if ($(this).find('.fb-page').data("show-facepile")) {
				height = height + 94;
			};
		}

		$(this).css('height',height+'px');
	});

	//--------------- Init Category Widget ------------------//

	$(".widget .cat-item").each(function(){
		var value = $(this).text().split('\n');
		$(this).find('> a').html(value[0]);
	});

	//--------------- Init Footer Widget Area ------------------//

	$(".footer .widget").each(function(){
		if ($('footer.footer').hasClass('3col')) {
			$(this).removeClass('col-md-12').addClass('col-md-4');
		};
		if ($('footer.footer').hasClass('2col')) {
			$(this).removeClass('col-md-12').addClass('col-md-6');
		};
		if ($('footer.footer').hasClass('4col')) {
			$(this).removeClass('col-md-12').addClass('col-md-3');
		};
	});

	//--------------- Header Search Margin Top ------------------//

	var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
	if(width>=768){
		var searchParentHeight = $('.search-div').parent().parent().outerHeight();
		var searchHeight = $('.search-div').outerHeight();
		$('.search-div').css('top',(searchParentHeight-searchHeight)/2 +'px');
	}
	if(width<768){
		$('.post-spotlight').find('article').removeClass('spotlight');
	}

	//--------------- Mobile Spotlight Posts Fix ------------------//

	jQuery(window).on('resizestop', function () {
	    width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		if(width<768){
	    	$('.post-spotlight').find('article').removeClass('spotlight');
	    }else{
    		$('.post-spotlight').find('article').addClass('spotlight');

    		var searchParentHeight = $('.search-div').parent().parent().outerHeight();
			var searchHeight = $('.search-div').outerHeight();
			$('.search-div').css('top',(searchParentHeight-searchHeight)/2 +'px');
	    }
	});

	//--------------- Header Search Margin Top ------------------//

	$('header .logo img').load(function(){
		var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		if(width>=768){
			var searchParentHeight = $('.search-div').parent().parent().outerHeight();
			var searchHeight = $('.search-div').outerHeight();
			$('.search-div').css('top',(searchParentHeight-searchHeight)/2 +'px');
		}
	});

	$(window).load(function(){

		//--------------- Loader ------------------//

		$('#loader').delay(300).fadeOut(200);

		//--------------- Header Search Margin Top ------------------//

		var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
		if(width>=768){
			var searchParentHeight = $('.search-div').parent().parent().outerHeight();
			var searchHeight = $('.search-div').outerHeight();
			$('.search-div').css('top',(searchParentHeight-searchHeight)/2 +'px');
		}

		//--------------- Spotlight Post Height ------------------//

		$( ".bg-img" ).each(function() {
		  	if ( $(this).children().length <= 0 ) {
		    	var height = $(this).siblings('article').outerHeight();
		    	$(this).css('height',height);
			}
		});

		//--------------- Grid Init ------------------//
		if ($('#masonry').length) {
			new CBPGridGallery( document.getElementById( 'masonry' ) );
		}
	});

	//--------------- Nav Icon Animation ------------------//

	var toggle_open = false;
	$('.toggle-sidebar-button').click(function(event) {
		event.preventDefault();
		if(!toggle_open){
			toggle_open = true;
			$(this).addClass('open');
			$('.toggle-sidebar').addClass('toggle-in');
			$('.toggle-overlay').addClass('toggle-in');
		}
		else{
			toggle_open = false;
			$(this).removeClass('open');
			$('.toggle-sidebar').removeClass('toggle-in');
			$('.toggle-overlay').removeClass('toggle-in');
		}
	});
	$('.toggle-overlay').click(function(event) {
		event.preventDefault();
		if(!toggle_open){
			toggle_open = true;
			$('.toggle-sidebar-button').addClass('open');
			$('.toggle-sidebar').addClass('toggle-in');
			$('.toggle-overlay').addClass('toggle-in');
		}
		else{
			toggle_open = false;
			$('.toggle-sidebar-button').removeClass('open');
			$('.toggle-sidebar').removeClass('toggle-in');
			$('.toggle-overlay').removeClass('toggle-in');
		}
	});

	//-----------Creating mobile menu---------------//

	$("<select class='nav-mobile'/>").appendTo("header .select-container");

	$("<option />", {
	   "selected": "selected",
	   "text"    : "Menu"
	}).appendTo(".select-container select");

	$("nav div>ul>li").each(function() {
		if ($(this).hasClass('menu-item-has-children')) {
			subMmenu($(this),1);
		}else{
			var el = $(this).find('> a');
			 $("<option />", {
			     "value"   : el.attr("href"),
			     "text"    : el.text()
			 }).appendTo(".select-container select");
		}
	});

	function subMmenu(elem, level){
		var el = elem.find('> a');
		var str = new Array(level).join('-');
	 	 $("<option />", {
		     "value"   : el.attr("href"),
		     "text"    : str+' '+el.text()
		}).appendTo(".select-container select");
	 	elem.find('> ul > li').each(function() {
	 		if ($(this).hasClass('menu-item-has-children')) {
				subMmenu($(this),level+1);
			}else{
				var el = $(this).find('> a');
				str = new Array(level + 1).join('-');
				$("<option />", {
				    "value"   : el.attr("href"),
				    "text"    : str+' '+el.text()
				}).appendTo(".select-container select");
			}
	 	});
	}

	$(".select-container select").change(function() {
	  	window.location = $(this).find("option:selected").val();
	});

	//----------------- Twitter Init ----------------------//

	!function(d,s,id){
		var js, fjs=d.getElementsByTagName(s)[0], p=/^http:/.test(d.location)?'http':'https';
		if(!d.getElementById(id)){
			js=d.createElement(s);
			js.id=id;
			js.src=p+"://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);
		}
	}
	(document,"script","twitter-wjs");

	//----------------- Tabs Init -----------------//

	$(".nav.nav-tabs li:first-child").addClass("active");
	$(".tab-content .tab-pane").first().addClass("active");
	$("#accordion .panel").first().find(".collapsed").removeClass("collapsed");
	$("#accordion .panel").first().find(".panel-collapse").addClass("in");

	//---------------- Blog Init ------------------//

	$(".post-slider").each(function(){
		var slider_auto, slider_pause, slider_mode;
		slider_auto = $(this).data('auto');
		slider_pause = $(this).data('pause');
		slider_mode = $(this).data('mode');
		if (!($(this).find('.bx-wrapper').length)) {
			var slider = $(this).find('ul').bxSlider({
				auto: slider_auto,
			  	infiniteLoop: true,
			  	touchEnabled: true,
			  	pause: slider_pause,
			  	mode: slider_mode,
			  	adaptiveHeight: true,
			  	nextSelector: $(this).find('.controls .next'),
				prevSelector: $(this).find('.controls .prev'),
				nextText: "",
			  	prevText: "",
			  	pager: false
			});
		};
	});
	$(".post.format-audio").each(function(){
		if ($(this).find('audio').length) {
			if (!($(this).find('.controls').length)){
				var id = $(this).attr('id');
				$(this).pryanikPlayer('#'+id);
			}
		}
	});
	$(".post").each(function(){
		if($(this).find('article').children().length == 1){
			$(this).find('article').css({
				'border-bottom' : 'none',
				'padding-bottom' : '0'
			});
		}
		if($(this).find('audio').length == 1 && $(this).find('article').children().length == 2){
			$(this).find('article').css({
				'border-bottom' : 'none',
				'padding-bottom' : '0'
			});
		}
	});
	if ($('.single .related-slider').length) {
		$('.single .related-slider').owlCarousel({
		    loop:true,
		    margin:30,
		    nav:true,
		    navText: ['<i class="flaticon-previous11"></i>','<i class="flaticon-next15"></i>'],
		    responsive:{
		        0:{
		            items:1,
		            loop:false
		        },
		        768:{
		            items:3
		        },
		        992:{
		            items:3
		        }
		    }
		});
	}
	if ($('.blog .related-slider').length) {
		$('.blog .related-slider').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:true,
		    navText: ['<i class="flaticon-previous11"></i>','<i class="flaticon-next15"></i>'],
		    responsive:{
		        0:{
		            items:1,
		            loop:false
		        },
		        768:{
		            items:3
		        },
		        992:{
		            items:3
		        }
		    }
		});
	}
	if ($('.category .related-slider').length) {
		$('.category .related-slider').owlCarousel({
		    loop:true,
		    margin:10,
		    nav:true,
		    navText: ['<i class="flaticon-previous11"></i>','<i class="flaticon-next15"></i>'],
		    responsive:{
		        0:{
		            items:1,
		            loop:false
		        },
		        768:{
		            items:3
		        },
		        992:{
		            items:3
		        }
		    }
		});
	}
	$(".flickr").each(function(){
		var id = $(this).data('flickrid');
		var limit = $(this).data('limit');
		var col = $(this).data('col');
		var random = $(this).data('random');
		$(this).flickrush({
			limit:limit,
			col:col,
			id:id,
			random:random
		});
	});

});
