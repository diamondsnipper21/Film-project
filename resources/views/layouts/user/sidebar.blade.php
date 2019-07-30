<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="/admin" class="sidebar-brand">
                <i class="gi gi-flash"></i>
                <span class="sidebar-nav-mini-hide"><strong>Film</strong></span>
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="">
                        <img src="/user/img/img_avatar.png" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-user-links">
                    <a href="{{ route('user.information') }}" data-toggle="tooltip" data-placement="bottom" title="Profile">
                        <i class="gi gi-user"></i>
                    </a>
                    
                    <a href="{{ route('logout') }}" data-confirm="Are you sure to logout?" method="POST" data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <i class="gi gi-exit"></i>
                    </a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
            @foreach (Cache::get('categories') as $index => $category)
                <li>
                    <a href="{{ route('user.categories.show', ['slug' => $category->slug]) }}"  class="{{ starts_with(url()->current(), route('user.categories.show', ['slug' => $category->slug])) ? 'active' : '' }}">
                        <i class="gi gi-list sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">{{ $category->name }}</span>
                    </a>
                </li>
            @endforeach
            </ul>
            <!-- END Sidebar Navigation -->
            
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>