<!DOCTYPE html>
<html lang="en">
<head>
  @yield('title')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="/user/css/bootstrap.min.css">
  <link rel="stylesheet" href="/user/css/plugins.css">
  <link rel="stylesheet" href="/user/css/main.css">
  <link rel="stylesheet" href="/user/css/themes.css">
  <link rel="stylesheet" href="/user/css/user.css">
  <script src="/user/js/jquery-3.2.1.min.js"></script>
  <script src="/user/js/bootstrap.min.js"></script>
  <script src="/user/js/plugins.js"></script>
  <script src="/user/js/user.js"></script>
  <link rel="stylesheet" href="/user/custom/app.css">
  <link rel="stylesheet" href="/user/custom/vendor.css">
  <link rel="stylesheet" href="/user/custom/fonts.css">
  <script src="/user/custom/vendor.js"></script>
  <script src="/user/custom/app.js"></script>

</head>
<body>
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

  <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
            <!-- Modal Header -->
        <div class="modal-header text-center">
          <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
        </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
        <div class="modal-body">
          <form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
            <fieldset>
              <legend>Vital Info</legend>
              <div class="form-group">
                <label class="col-md-4 control-label">Username</label>
                <div class="col-md-8">
                  <p class="form-control-static">Admin</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                <div class="col-md-8">
                  <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                <div class="col-md-8">
                  <label class="switch switch-primary">
                    <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                    <span></span>
                  </label>
                </div>
              </div>
            </fieldset>
            <fieldset>
              <legend>Password Update</legend>
              <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                <div class="col-md-8">
                  <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                <div class="col-md-8">
                  <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                </div>
              </div>
            </fieldset>
            <div class="form-group form-actions">
              <div class="col-xs-12 text-right">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
              </div>
            </div>
          </form>
        </div>
            <!-- END Modal Body -->
      </div>
    </div>
  </div>

  <script src="/user/custom/vendor.js"></script>
  <script src="/user/custom/app.js"></script>
  <script src="/user/js/plugins.js"></script>
  @yield('script');

  <script type="text/javascript">
      App.sidebar('close-sidebar');
  </script>
</body>
</html>
