jQuery('#upload-image-button').live('click', function( event ){

	event.preventDefault();

	var file_frame;
	input = jQuery(this).next();

	if ( file_frame ) {
	  file_frame.open();
	  return;
	}

	file_frame = wp.media.frames.file_frame = wp.media({
		editing:    true,
		multiple: 	false,
		library: {
			type: 'image'
		}
	});

	file_frame.on('open',function() {
		var selection = file_frame.state().get('selection');
		ids = input.val().replace('http://','').split(',');
		ids.forEach(function(id) {
			attachment = wp.media.attachment(id);
			attachment.fetch();
			selection.add( attachment ? [ attachment ] : [] );
		});
	});
 
	file_frame.on( 'select', function() {
		var url = "";
		var selection = file_frame.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			input.val(attachment.id);
		});
	  });
	
	file_frame.open();
});

jQuery('#upload-gallery-button').live('click', function( event ){

	event.preventDefault();

	var file_frame, input;
	input = jQuery(this).next();
   
	var val = input.val().replace('http://','');
	attr = {};
	attr.include = val;

	var shortcode = new wp.shortcode({
		 tag:     'gallery',
		 attrs:   attr
	});
	var attachments, selection,
	defaultPostId = wp.media.gallery.defaults.id;

	if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) )
		shortcode.set( 'id', defaultPostId  );
 
	attachments = wp.media.gallery.attachments( shortcode );
	selection = new wp.media.model.Selection( attachments.models, {
		props:    attachments.props.toJSON(),
		multiple: true
	});
	 
	selection.gallery = attachments.gallery;
 
	selection.more().done( function() {
		selection.props.set({ query: false });
		selection.unmirror();
		selection.props.unset('orderby');
	});
 
	if ( file_frame ) {
	  file_frame.open();
	  return;
	}

	file_frame = wp.media.frames.file_frame = wp.media({
		frame:      'post',
		state:      'gallery-edit',
		title:      wp.media.view.l10n.editGalleryTitle,
		editing:    true,
		multiple: 	true,
		selection:  selection,
		library: {
			type: 'image'
		}
	});

	file_frame.on( 'update', function() {
		var controller = file_frame.states.get('gallery-edit');
		var library = controller.get('library');
		var ids = library.pluck('id');
		input.val(ids.toString().replace('http://',''));
	});
 
	file_frame.open();
});

jQuery('#upload-audio-button').live('click', function( event ){

	event.preventDefault();

	var file_frame;
	input = jQuery('#upload-audio');

	if ( file_frame ) {
	  file_frame.open();
	  return;
	}

	file_frame = wp.media.frames.file_frame = wp.media({
		multiple: 	false,
		library: {
			type: 'audio'
		}
	});

	file_frame.on('open',function() {
		var selection = file_frame.state().get('selection');
		ids = input.val().replace('http://','').split(',');
		ids.forEach(function(id) {
			attachment = wp.media.attachment(id);
			attachment.fetch();
			selection.add( attachment ? [ attachment ] : [] );
		});
	});
 
	file_frame.on( 'select', function() {
		var url = "";
		var selection = file_frame.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			input.val(attachment.id);
		});
	  });
	
	file_frame.open();
});
jQuery('#remove-media').live('click', function( event ){
	event.preventDefault();

	jQuery(this).prev().val('');
});