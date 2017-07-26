<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Motta
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>

  <script src="https://use.fontawesome.com/533c632a54.js"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/dist/app.bundle.css">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">

  <style>
    :root .EmbedHeader {
      display: none !important;
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">

    <header id="masthead" class="site-header">

      <nav id="site-navigation" class="main-navigation" role="navigation">
        <div class="container-fluid">
          <div class="row" style="margin-top: 0">
            <div class="col-xs-2 col-sm-1">
              <a class="menu-toggle burger"><span class="burger-icon"></span></a>
            </div>
            <div class="col-xs-7 col-sm-10 text-center site-branding">
              <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
            </div>
            <div class="col-xs-2 col-sm-1">
              <a class="menu-cart" href="<?php echo site_url(); ?>/cart"><span class="shopping-cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="count"><?php echo  WC()->cart->get_cart_contents_count(); ?></span>
              </span></a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <div class="col-xs-12">
                <div class="container-fluid">

                  <ul class="menu menu__items">
                    <!-- start input -->

                    <?php
                    $menu_items = wp_get_nav_menu_items('menu');

                    $dropdown_IDs = array();
                    $dropdown_items = array();
                    $categories = get_categories( array(
                        'orderby' => 'name',
                        'parent'  => 6
                    ));

                    $locations = array();
                    $about_page = get_page_by_title('About Motta');
                    $books_page = get_page_by_title('Books');

                    while (have_rows('about_section', $about_page->ID)) {
                      the_row();
                      array_push($locations, get_sub_field('about_location_name'));
                    }


                    foreach ($menu_items as $menu_item) {
                      if ($menu_item->menu_item_parent !== '0') {
                        array_push($dropdown_IDs, $menu_item->menu_item_parent);
                        array_push($dropdown_items, $menu_item);
                      }
                    }

                    $dropdown_IDs = array_unique($dropdown_IDs);
                    $html = '';

                    foreach ($menu_items as $menu_item) {
                      $title = $menu_item->title;
                      $slug = $menu_item->slug;
                      $url = $menu_item->url;

                      if ($menu_item->menu_item_parent === '0') {
                        if ($title == 'Books') {
                          $html .= '<li class="menu__item dropdown folded"><a href="' . get_the_permalink($books_page->ID) . '">' . $title . '</a><span class="toggle-button"><span class="fa fa-chevron-down"></span></span><ul class="submenu menu__items">';
                          foreach ($categories as $category) {
                            $c_title = $category->name;
                            $c_url = get_category_link( $category->cat_ID );

                            $html .= '<li class="menu__item"><a href="' . $c_url . '">' . $c_title . '</a></li>';
                          }
                          $html .= '</ul></li>';
                        } else if ($title == 'About Motta') {
                          $html .= '<li class="menu__item dropdown folded"><a href="' . get_the_permalink($about_page->ID) . '">' . $title . '</a><span class="toggle-button"><span class="fa fa-chevron-down"></span></span><ul class="submenu menu__items">';
                          foreach ($locations as $location) {
                            $l_slug = create_slug($location);
                            $l_url = get_the_permalink($about_page->ID);

                            $html .= '<li class="menu__item"><a href="' . $l_url . '/#' . $l_slug . '">' . $location . '</a></li>';
                          }
                          $html .= '</ul></li>';
                        } else if (in_array($menu_item->ID, $dropdown_IDs)) {
                          $html .= '<li class="menu__item dropdown folded"><a>' . $title . '</a><span class="toggle-button"><span class="fa fa-chevron-down"></span></span><ul class="submenu menu__items">';
                          foreach ($dropdown_items as $dropdown_item) {
                            $d_title = $dropdown_item->title;
                            $d_url = $dropdown_item->url;
                            if ($dropdown_item->menu_item_parent == $menu_item->ID) {
                              $html .= '<li class="menu__item"><a href="' . $d_url . '">' . $d_title . '</a></li>';
                            }
                          }
                          $html .= '</ul></li>';
                        } else {
                          $html .= '<li class="menu__item"><a href="' . $url . '">' . $title . '</a></li>';
                        }
                      }
                    }

                    echo $html;
                    ?>

                    <!-- end input -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <div class="col-xs-12">
                <div class="container-fluid">
                  <?php get_search_form() ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <div class="col-xs-12">
                <div class="container-fluid">
                  <ul class="menu__social">
                    <li><span class="fa fa-instagram" aria-hidden="true"></span></li>
                    <li><span class="fa fa-facebook" aria-hidden="true"></span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
