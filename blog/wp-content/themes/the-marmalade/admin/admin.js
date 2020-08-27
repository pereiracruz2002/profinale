jQuery(document).ready(function( $ ){

	var setDefaultSettingsForStandartPost = function(){
	   	var inputValues = {
  			"show-title": "always",
  			"show-content": "always",
  			"show-counters": "always",
  			"show-share": "always",
  			"spotlight-content-color": "light",
  			"show-related": "post"
		};
		$.each( inputValues, function( key, value ) {
		  	var val = $('input[name='+ key +']:checked').val();
			if (typeof val === "undefined") {
				$('input[name='+ key +'][value='+ value +']').attr('checked', 'checked');
			};
		});
	};

	var setDefaultSettingsForQoutePost = function(){
	   	var inputValues = {
  			"show-title": "never",
  			"show-content": "never",
  			"show-counters": "never",
  			"show-share": "never",
  			"spotlight-content-color": "light",
  			"show-related": "never"
		};
		$.each( inputValues, function( key, value ) {
		  	var val = $('input[name='+ key +']:checked').val();
			if (typeof val === "undefined") {
				$('input[name='+ key +'][value='+ value +']').attr('checked', 'checked');
			};
		});
	};

	var hideAllSettings = function(){
		$('#image-settings').hide();
		$('#gallery-settings').hide();
		$('#audio-settings').hide();
		$('#video-settings').hide();
		$('#quote-settings').hide();
		$('#link-settings').hide();
		$('#chat-settings').hide();
		$('#status-settings').hide();
	};

	if ($('#post_type').val() == 'post') {
		hideAllSettings();

		var val = $('#spotlight').prop('checked');
		if (val) {
			$("input[name=spotlight-content-color]").parent().parent().show();
		}else{
			$("input[name=spotlight-content-color]").parent().parent().hide();
		}
		$("#spotlight").change(function() {
			var val = $('#spotlight').prop('checked');
			if (val) {
				$("input[name=spotlight-content-color]").parent().parent().show();
			}else{
				$("input[name=spotlight-content-color]").parent().parent().hide();
			}
		});
		
		val = $('#show-custom-title').prop('checked');
		if (val) {
			$("#custom-post-title").parent().parent().show();
			$("#post-title-image").parent().parent().show();
		}else{
			$("#custom-post-title").parent().parent().hide();
			$("#post-title-image").parent().parent().hide();
		}
		$("#show-custom-title").change(function() {
			var val = $('#show-custom-title').prop('checked');
			if (val) {
				$("#custom-post-title").parent().parent().show();
				$("#post-title-image").parent().parent().show();
			}else{
				$("#custom-post-title").parent().parent().hide();
				$("#post-title-image").parent().parent().hide();
			}
		});

		$( "#formatdiv #post-formats-select .post-format" ).each(function( index ) {
		  	if ($(this).is(':checked')){
		  		type = $(this).val();
				switch (type){
					case "image"	: $("#image-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "gallery"	: $("#gallery-settings").show(); setDefaultSettingsForStandartPost();	break;
					case "quote"	: $("#quote-settings").show(); setDefaultSettingsForQoutePost();		break;
					case "video"	: $("#video-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "audio"	: $("#audio-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "link"		: $("#link-settings").show(); setDefaultSettingsForQoutePost();			break;
					case "status"	: $("#status-settings").show(); setDefaultSettingsForQoutePost();		break;
					case "chat"		: $("#chat-settings").show(); setDefaultSettingsForQoutePost();			break;
				}
		  	}
		});

		$('#formatdiv #post-formats-select .post-format').live('change', function( event ){
			if ($(this).is(':checked')){
				type = $(this).val();
				switch (type){
					case "image"	: hideAllSettings(); $("#image-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "gallery"	: hideAllSettings(); $("#gallery-settings").show(); setDefaultSettingsForStandartPost();	break;
					case "quote"	: hideAllSettings(); $("#quote-settings").show(); setDefaultSettingsForQoutePost();			break;
					case "video"	: hideAllSettings(); $("#video-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "audio"	: hideAllSettings(); $("#audio-settings").show(); setDefaultSettingsForStandartPost();		break;
					case "link"		: hideAllSettings(); $("#link-settings").show(); setDefaultSettingsForQoutePost();			break;
					case "status"	: hideAllSettings(); $("#status-settings").show(); setDefaultSettingsForQoutePost();		break;
					case "chat"		: hideAllSettings(); $("#chat-settings").show(); setDefaultSettingsForQoutePost();			break;
					case "0"		: hideAllSettings(); setDefaultSettingsForStandartPost();									break;
				}
				
			}

		});
	};

	if ($('#post_type').val() == 'page') {

		var val = $('#add-map').prop('checked');
		if (val) {
			$("#map-embed").parent().show();
		}else{
			$("#map-embed").parent().hide();
		}
		$("#add-map").change(function() {
			var val = $('#add-map').prop('checked');
			if (val) {
				$("#map-embed").parent().show();
			}else{
				$("#map-embed").parent().hide();
			}
		});
	}

});