<!DOCTYPE html>
<html lang="en">
<head>
  @yield('title')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/user/css/bootstrap.min.css">

  <link rel="stylesheet" href="/user/css/plugins.css">
  <link rel="stylesheet" href="/user/css/main.css">
  <link rel="stylesheet" href="/user/css/style.css">
  <link href="/user/css/video-js.css" rel="stylesheet" type="text/css">
  <link href="/user/css/videojs.playlist.css" rel="stylesheet"> 
</head>
<body class="layout-play">
  <div id="page-wrapper">
    <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">

      @include('user.layouts.sidebar')

      <div id="main-container">

        @include('user.layouts.header')

        <div id="page-content">
          @yield('content')
        </div>

      </div>
    </div>
  </div>

  <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

  <script src="/user/js/jquery-3.2.1.min.js"></script>
  <script src="/user/js/bootstrap.min.js"></script>
  <script src="/user/js/plugins.js"></script>
  <script src="/user/js/admin.js"></script>
  <script src="/user/js/app.js"></script>
  <script src="/user/js/vue.js"></script>
  <script src="/user/js/video-js/video.js"></script>
  <script src='/user/js/videojs.playlist.js'></script>
  <script src='/user/js/demo.js'></script>    
  @yield('script');
  <script type="text/javascript">
    $(function(){
      App.sidebar('close-sidebar');
    });
  </script>
</body>
</html>

