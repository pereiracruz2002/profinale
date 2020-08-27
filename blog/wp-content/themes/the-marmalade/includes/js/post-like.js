jQuery(document).ready(function() {
	"use strict";
	jQuery('body').on('click','.jm-post-like',function(event){
		event.preventDefault();
		var heart = jQuery(this);
		var post_id = heart.data("post_id");
		heart.html("<i class='fa fa-heart'></i><i class='fa fa-spinner fa-spin'></i>");
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=jm-post-like&nonce="+ajax_var.nonce+"&jm_post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount === "0")
					{
						lecount = "Like";
					}
					heart.prop('title', 'Like');
					heart.removeClass("liked");
					heart.html("<i class='fa fa-heart-o '></i>&nbsp;"+lecount);
				}
				else
				{
					heart.prop('title', 'Unlike');
					heart.addClass("liked");
					heart.html("<i class='fa fa-heart'></i>&nbsp;"+count);
				}
			}
		});
	});
});
