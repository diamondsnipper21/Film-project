<div class='container-fluid'>
	<div class="row">
		<div class="col-sm-12">
			<video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" 
				width="100%" 
				height="500px"
		      	poster="http://video-js.zencoder.com/oceans-clip.png"
		      	data-setup="{}">
		    	<source src="{{ $movie->play->videos->first()->url }}" type='video/mp4' />
		    	<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
		    	<track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
		  	</video>
		</div>
	</div>
</div>