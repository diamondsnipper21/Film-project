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

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ starts_with(url()->current(), route('admin.dashboard')) ? 'active' : '' }}">
                        <i class="gi gi-dashboard sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Dashboard</span>
                    </a>
                </li>        
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-shopping_cart sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Store</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="{{ starts_with(url()->current(), route('admin.categories.index')) ? 'active' : '' }}">
                                <i class="gi gi-list sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Categories</span>
                            </a>
                        </li>        
                        <li>
                            <a href="{{ route('admin.products.index') }}" class="{{ starts_with(url()->current(), route('admin.products.index')) ? 'active' : '' }}">
                                <i class="gi gi-shopping_bag sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reviews.index') }}" class="{{ starts_with(url()->current(), route('admin.reviews.index')) ? 'active' : '' }}">
                                <i class="fa fa-cloud sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Reviews</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="fa fa-usd sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Plans</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.plans.index') }}" class="{{ starts_with(url()->current(), route('admin.plans.index')) ? 'active' : '' }}">
                                <i class="fa fa-cc-stripe sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Site Plan</span>
                            </a>
                        </li>        
                        <li>
                            <a href="{{ route('admin.product_plans.index') }}" class="{{ starts_with(url()->current(), route('admin.product_plans.index')) ? 'active' : '' }}">
                                <i class="gi gi-shopping_bag sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Product Plan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu">
                        <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="gi gi-film sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Media</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.movies.index') }}" class="{{ starts_with(url()->current(), route('admin.movies.index')) ? 'active' : '' }}">
                                <i class="gi gi-film sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Movies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.series.index') }}" class="{{ starts_with(url()->current(), route('admin.series.index')) ? 'active' : '' }}">
                                <i class="fa fa-paperclip sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Series</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.images.index') }}" class="{{ starts_with(url()->current(), route('admin.images.index')) ? 'active' : '' }}">
                                <i class="gi gi-picture sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Images</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.videos.index') }}" class="{{ starts_with(url()->current(), route('admin.videos.index')) ? 'active' : '' }}">
                                <i class="gi gi-facetime_video sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Videos</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subtitles.index') }}" class="{{ starts_with(url()->current(), route('admin.subtitles.index')) ? 'active' : '' }}">
                                <i class="fa fa-file-text sidebar-nav-icon"></i> 
                                <span class="sidebar-nav-mini-hide">Subtitles</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.users.index') }}" class="{{ starts_with(url()->current(), route('admin.users.index')) ? 'active' : '' }}">
                        <i class="gi gi-user sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Users</span>
                    </a>
                </li>

               <!--  <li>
                    <a href="{{ route('admin.subscriptions.index') }}" class="{{ starts_with(url()->current(), route('admin.subscriptions.index')) ? 'active' : '' }}">
                        <i class="gi gi-user sidebar-nav-icon"></i> 
                        <span class="sidebar-nav-mini-hide">Subscriptions</span>
                    </a>
                </li> -->

            </ul>
            <!-- END Sidebar Navigation -->
            
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<script type="text/javascript">
    var activeMenuItem = $('.sidebar-nav a.active').parents('li');

    activeMenuItem.children('a').addClass('open');
    activeMenuItem.children('ul').show();
</script>