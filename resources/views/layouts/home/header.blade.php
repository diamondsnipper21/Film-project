<?php
/**
 * config.php
 *
 * Author: pixelcave
 *
 * Configuration file. It contains variables used in the template as well as the primary navigation array from which the navigation is created
 *
 */

/* Template variables */
$template = array(
    'name'          => 'Film',
    'author'        => 'Film',
    'robots'        => 'noindex, nofollow',
    'title'         => 'Film - Promoting & Selling Films Site ',
    'description'   => 'Film is a movie selling Site created by pixelcave.',
    // true             for a boxed layout
    // false            for a full width layout
    'boxed'         => false,
    'active_page'   => url()->current()
);

$categories_menu = [];

foreach (Cache::get('categories') as $category) {    
    $categories_menu[] = ['name' => $category->name,
                     'url'  => route('home.category.show', $category->slug)];
}

$primary_nav = array(
    array(
        'name'  => 'Home',
        'url'   => url('')
    ),
  
    array(
        'name'  => 'Categories',
        'sub'   => $categories_menu
    ),

    array(
        'name'  => 'Pricing',
        'url'   => url('pages/pricing')
    ),

    array(
        'name'  => 'About Us',
        'url'   => url('/pages/about')
    ),

    array(
        'name'  => 'Contact Us',
        'url'   => url('/pages/contact')
    ),

    array(
        'name' => 'Login', 
        'url' => route('user.login')
    ),

    array(
        'name' => 'Register', 
        'url' => route('user.register')
    )
);
?>
<header>
        <div class="container">
            <!-- Site Logo -->
            <a href={{ url("") }} class="site-logo">
                <i class="gi gi-flash"></i> <strong>Film</strong>
            </a>
            <!-- Site Logo -->

            <!-- Site Navigation -->
            <nav>

                <!-- Menu Toggle -->
                <!-- Toggles menu on small screens -->
                <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- END Menu Toggle -->

                <!-- Main Menu -->
                <?php if ($primary_nav) { ?>
                <ul class="site-nav">
                    <li>
                        <a href="javascript:void(0);" id="link-search"><i class="fa fa-search"></i></a>
                    </li>
                    <!-- Toggles menu on small screens -->
                    <li class="visible-xs visible-sm">
                        <a href="javascript:void(0)" class="site-menu-toggle text-center">
                            <i class="fa fa-times"></i>
                        </a>
                    </li>
                    <!-- END Menu Toggle -->
                    <?php foreach( $primary_nav as $key => $link ) {
                        $link_class = '';
                        $li_active  = '';
                        $menu_link  = '';

                        // Get 1st level link's vital info
                        $url        = (isset($link['url']) && $link['url']) ? $link['url'] : '';
                        $active     = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? 'active' : '';

                        // Check if the link has a submenu
                        if (isset($link['sub']) && $link['sub']) {
                            // Since it has a submenu, we need to check if we have to add the class active
                            // to its parent li element (only if a 2nd level link is active)
                            foreach ($link['sub'] as $sub_link) {
                                if (in_array($template['active_page'], $sub_link)) {
                                    $li_active = ' class="active"';
                                    break;
                                }
                            }

                            $menu_link = 'site-nav-sub';
                        }

                        // Create the class attribute for our link
                        if ($menu_link && $active) {
                            $link_class = ' class="'. $menu_link . ' ' . $active .'"';
                        } else if ($menu_link) {
                            $link_class = ' class="'. $menu_link .'"';
                        } else if ($active) {
                            $link_class = ' class="'. $active .'"';
                        }
                    ?>
                    <li<?php echo $li_active; ?>>
                        <a href="<?php echo url($url); ?>"<?php echo $link_class; ?>><?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?><i class="fa fa-angle-down site-nav-arrow"></i><?php } echo $link['name']; ?></a>
                        <?php if (isset($link['sub']) && $link['sub']) { // if the link has a submenu ?>
                        <ul>
                            <?php foreach ($link['sub'] as $sub_link) {
                                $link_class = '';
                                $li_active = '';

                                // Get 2nd level link's vital info
                                $url        = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                                $active     = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? 'active' : '';

                                if ($active) {
                                    $link_class = ' class="'. $active .'"';
                                }
                            ?>
                            <li<?php echo $li_active; ?>>
                                <a href="<?php echo url($url); ?>"<?php echo $link_class; ?>><?php echo $sub_link['name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
                <!-- END Main Menu -->
            </nav>
            <!-- END Site Navigation -->
        </div>
    </header>
<!-- END Site Header -->
