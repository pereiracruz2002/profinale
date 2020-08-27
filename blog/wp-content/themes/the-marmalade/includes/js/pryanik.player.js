;(function($){
	$.fn.pryanikPlayer = function(id){

		var controls = {
	        audio: $(id).find("audio"),
	        hasHours: false      
	    };

	    function formatTime(time, hours) {
		    if (hours) {
		        var h = Math.floor(time / 3600);
		        time = time - h * 3600;
		                    
		        var m = Math.floor(time / 60);
		        var s = Math.floor(time % 60);
		                    
		        return h.lead0(2)  + ":" + m.lead0(2) + ":" + s.lead0(2);
		    } else {
		        var m = Math.floor(time / 60);
		        var s = Math.floor(time % 60);
		                    
		        return m.lead0(2) + ":" + s.lead0(2);
		    }
		}
		            
		Number.prototype.lead0 = function(n) {
		    var nz = "" + this;
		    while (nz.length < n) {
		        nz = "0" + nz;
		    }
		    return nz;
		};

		var createControls = function(){
			controlsDiv = $("<div class='audio-controls'></div>");

			playpause = $("<span></span>");
			$("<i class='fa fa-play'></i>").appendTo(playpause);
			playpause.addClass("paused playpause").appendTo(controlsDiv);
			
			time = $("<span class='time'></span>");
			currenttime = $("<span class='currenttime'>00:00</span>");
			duration = $("<span class='duration'>00:00</span>");

			currenttime.appendTo(time);
			duration.appendTo(time);
			time.appendTo(controlsDiv);

			volume = $("<span class='volume'>");
			mute = $("<span class='mute'>");
			totalvolume = $("<span class='totalvolume'>");
			currentvolume = $("<span class='currentvolume'>");
			$("<i class='fa fa-volume-up'></i>").appendTo(mute);

			mute.appendTo(volume);
			currentvolume.appendTo(totalvolume);
			totalvolume.appendTo(volume);
			volume.appendTo(controlsDiv);

			progress = $("<span class='audio-progress'></span>");
			total = $("<span class='total'></span>");
			buffered = $("<span class='buffered'></span>");
			current = $("<span class='current'></span>");

			current.appendTo(buffered);
			buffered.appendTo(total);
			total.appendTo(progress);
			progress.appendTo(controlsDiv);

			$(id).find('audio').after(controlsDiv);

			controls["playpause"] = $(id).find(".playpause");
			controls["time"] = $(id).find(".time");
			controls["currentTime"] =  $(id).find(".currenttime");
			controls["duration"] =  $(id).find(".duration");			
			controls["volume"] = $(id).find(".volume");
			controls["mute"] = $(id).find(".mute");
			controls["totalvolume"] = $(id).find(".totalvolume");
			controls["currentvolume"] = $(id).find(".currentvolume");
			controls["progress"] = $(id).find(".progress");
			controls["total"] = $(id).find(".total");
			controls["buffered"] = $(id).find(".buffered");
			controls["current"] = $(id).find(".current");
		}

		createControls();
		
		var audio = controls.audio[0];
		audio.volume = 0.5;

		controls.hasHours = (audio.duration / 3600) >= 1.0;                    
		controls.duration.text(formatTime(audio.duration, controls.hasHours));
		controls.currentTime.text(formatTime(0),controls.hasHours);
               
	    controls.playpause.click(function(){
	        if (audio.paused) {
	            audio.play();
	            $(this).find(".fa-play").removeClass("fa-play").addClass("fa-pause") ;
	        } else {
	            audio.pause();
	            $(this).find(".fa-pause").removeClass("fa-pause").addClass("fa-play") ;
	        }
	                
	        $(this).toggleClass("paused"); 
	    });

	    audio.addEventListener("ended", function() {
		    audio.pause();
		    controls.playpause.find(".fa-pause").removeClass("fa-pause").addClass("fa-play") ;
		    controls.playpause.toggleClass("paused");
		    controls.current[0].style.width = 0;
		});

		audio.addEventListener("canplay", function() {
		    controls.hasHours = (audio.duration / 3600) >= 1.0;                    
		    controls.duration.text(formatTime(audio.duration, controls.hasHours));
		    controls.currentTime.text(formatTime(0),controls.hasHours);

		    controls.currentvolume[0].style.width = Math.floor(audio.volume * controls.totalvolume.width()) + "px";
		    
		}, false);

		controls.totalvolume.click(function(e) {

		    var x = (e.pageX - this.offsetLeft - $(this).closest('article').offset().left)/($(this).outerWidth());
		    audio.volume = x;
		   	controls.currentvolume[0].style.width = Math.floor(audio.volume * controls.totalvolume.outerWidth()) + "px";
		});


		audio.addEventListener("timeupdate", function() {
		    controls.currentTime.text(formatTime(audio.currentTime, controls.hasHours));
		                    
		    var progress = Math.floor(audio.currentTime) / Math.floor(audio.duration);
		    controls.current[0].style.width = Math.floor(progress * (controls.total.outerWidth()-controls.playpause.outerWidth() - controls.volume.outerWidth())) + "px";
		}, false);

		controls.total.click(function(e) {
		    var x = (e.pageX - this.offsetLeft - $(this).closest('article').offset().left)/($(this).outerWidth() - controls.playpause.outerWidth() - controls.volume.outerWidth());
		    audio.currentTime = x * audio.duration;
		});

		audio.addEventListener("progress", function() {
		    var buffered = Math.floor(audio.buffered.end(0)) / Math.floor(audio.duration);
		    controls.buffered[0].style.width =  Math.floor(buffered * controls.total.width()) + "px";
		}, false);

		controls.mute.click(function() {

			if (audio.muted) {
		    	$(this).find(".fa-volume-off")
		    			.removeClass("fa-volume-off")
		    			.addClass("fa-volume-up");
		    	$(this).css("padding-right","10px");
		    }else{
		    	$(this).find(".fa-volume-up")
		    			.removeClass("fa-volume-up")
		    			.addClass("fa-volume-off");
		    	$(this).css("padding-right","16px");

		    }             
		    audio.muted = !audio.muted;
		});

	    
		

	}
})(jQuery);
