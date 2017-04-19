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
            <div class="col-xs-8 col-sm-10 text-center site-branding">
              <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <ul class="menu menu__items">
                <!-- start input -->

                <?php
                $menu_items = wp_get_nav_menu_items('menu');

                $dropdown_IDs = array();
                $dropdown_items = array();

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
                        if (in_array($menu_item->ID, $dropdown_IDs)) {
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
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <ul class="menu__social">
                <li><span class="fa fa-instagram" aria-hidden="true"></span></li>
                <li><span class="fa fa-facebook" aria-hidden="true"></span></li>
              </ul>
            </div>
          </div>
        </div>
      </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
