
<div class='container-fluid' data-spy="scroll" data-target=".playlist" data-offset="20">
	<div class="row">
		<div class="col-sm-10">
			<video id="video-playlist" class="video-js vjs-default-skin" autoplay controls preload="none" width="100%" height="500px" data-setup="{}">
		    	<source src="http://www.film.com/storage/videos/1.mp4" type='video/mp4' />
		    	<track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
		    	<track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
		    	<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
		  	</video>

		</div>
		<div class="col-sm-2 playlist">
			<div id="video-playlist-vjs-playlist" class='vjs-playlist' style='width:100%'>
		      <ul>
		      	@foreach ($series->movies as $index => $movie)
		         <li >
		          <a class='vjs-track' href='#episode-0' data-index='0' data-src='http://www.film.com/storage/videos/1'>
		           	{{ $movie->title }}
		           </a>
		        </li>
		        @endforeach
		      </ul>
		    </div>
		</div>
	</div>

</div>
