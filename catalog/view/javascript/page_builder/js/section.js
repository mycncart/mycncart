jQuery(document).ready(function ($) {
	// Section video adding script
	$('.bg-video').each(function () {
		var data = $(this).data();
			id = $(this).data('id'),
			selector = '#' + id;
			var globalEasyVideo = new video_background(selector, {
			"position": 'absolute',	
			"z-index": '0',		
			"loop": data.loop, 			
			"autoplay": data.autoplay,		
			"muted": data.muted,			
			"mp4": ((typeof data.mp4==="undefined")?false:data.mp4),
			"webm": ((typeof data.webm==="undefined")?false:data.webm),
			"ogg": ((typeof data.ogg==="undefined")?false:data.ogg),
			"flv": ((typeof data.flv==="undefined")?false:data.flv),
			"vimeo": (typeof data.vimeo==="undefined")?false:data.vimeo,
			"youtube": (typeof data.youtube==="undefined")?false:data.youtube,	
			"video_ratio": data.ratio, 		
			"swfpath": data.swfpath,
			"sizing": data.sizing,
			"overlayOpacity": 0.5,
			"fallback_image": false,
			"enableOverlay": (data.overlay=="")?false:true
		});
	});
});