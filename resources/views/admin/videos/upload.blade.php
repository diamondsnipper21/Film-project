
	<button class='btn btn-primary btn-primary' id="submit-all">Submit all</button>
	<button class='btn btn-primary btn-warning' id="clear-dropzone">Clear all</button>

	{!! Form::open(['id' =>'my-awesome-dropzone', 'route' => 'admin.videos.store', 'method' => 'post', 'files' => true, 'class' => 'dropzone form-horizontal']) !!}
			<div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->
	{!! Form::close() !!}


	<script type="text/javascript">
		Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

			// The configuration we've talked about above
			autoProcessQueue: false,
			uploadMultiple: true,
			parallelUploads: 2,
			maxFiles: 20,
			addRemoveLinks: true,
			//acceptedFiles: "*",
			// acceptedMimeTypes: "*.mp4", 

			// The setting up of the dropzone
			init: function() {
				var myDropzone = this;
				myDropzone = this; // closure

				document.querySelector("#submit-all").addEventListener("click", function(e) {
					// Make sure that the form isn't actually being sent.
					e.preventDefault();
					e.stopPropagation();
					myDropzone.processQueue();
				});

				var _this = this;
				document.querySelector("button#clear-dropzone").addEventListener("click", function() {
						// Using "_this" here, because "this" doesn't point to the dropzone anymore
						_this.removeAllFiles();
						// If you want to cancel uploads as well, you
						// could also call _this.removeAllFiles(true);
				});
				// Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
				// of the sending event because uploadMultiple is set to true.
				this.on("sendingmultiple", function() {
					// Gets triggered when the form is actually being sent.
					// Hide the success button or the complete form.
				});
				this.on("successmultiple", function(files, response) {
					// Gets triggered when the files have successfully been sent.
					// Redirect user or notify of success.
				});
				this.on("errormultiple", function(files, response) {
					// Gets triggered when there was an error sending the files.
					// Maybe show form again, and notify user of error
				});
			}
		 
		}
	</script>
