            // initialize video.js
            
//note in the data-src's above that there are no file extensions, e.g., .m4v
videojs("#video-playlist", {"height":"auto", "width":"auto"}).ready(function(event){
    var myPlayer=this;

    console.log(myPlayer.el().id);
    myPlayer.playlist({
        'continuous': false
    });

    //if(typeof myPlayer.L!="undefined") myPlayer.id_=myPlayer.L;
    
    function resizeVideoJS(){
      var width = document.getElementById(myPlayer.el().id).parentElement.offsetWidth;
      var aspectRatio=8/12;
      myPlayer.width(width).height( width * aspectRatio); 
    }

    resizeVideoJS(); // Initialize the function
    window.onresize = resizeVideoJS; // Call the function on resize   
});


