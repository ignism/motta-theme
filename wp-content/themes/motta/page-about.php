<?php
/**
* Template Name: About page
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package Motta
*/

get_header();

$page_id = get_the_ID();

setup_postdata($page_id);
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container-fluid">

      <!--  Skeleton -->
      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">

          <div class="container-fluid"><!--  center-body -->
            <?php
            $html = '';
            // check if the repeater field has rows of data
            if (have_rows('about_section')) {

              // loop through the rows of data
              while (have_rows('about_section')) {
                  the_row();

                  $header_image = get_sub_field('about_header_image');
                  $location_name = get_sub_field('about_location_name');
                  $content = get_sub_field('about_content');
                  $email_button = get_sub_field('about_email_button');
                  $information = get_sub_field('about_information');

                  $slug = create_slug($location_name); ?>
                <div  id="<?php echo $slug ?>" class="row entry-content">
                  <div class="col-xs-12">
                    <div class="lazy__image lazy" data-original="<?php echo $header_image['sizes']['large'] ?>">
                      <img src="<?php echo $header_image['sizes']['large']?>" style="visibility: hidden">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <h1 class="entry-title"><?php echo $location_name ?></h1>
                  </div>
                </div>
                <div class="row entry-content">
                  <div class="col-sm-10 col-sm-offset-1">
                    <?php echo $content ?>
                    <div class="block__action">
                      <a href="mailto://<?php echo $email_button?>"><?php echo $email_button ?></a>
                    </div>
                  </div>
                </div>
                <div class="row entry-content">
                  <div class="col-xs-4 entry-details block__text">
                    <?php echo $information ?>
                  </div>
                  <?php
                  if (have_rows('about_pictures')) {
                      while (have_rows('about_pictures')) {
                          the_row();
                          $picture = get_sub_field('about_picture');
                          $size = get_sub_field('about_picture_size');
                          $html = '';

                          switch ($size) {
                        case 'sm':
                        $html .= '<div class="col-xs-3">';
                        break;
                        case 'lg':
                        $html .= '<div class="col-xs-6">';
                        break;
                        default:
                        $html .= '<div class="col-xs-4">';
                        break;
                      }
                      //log_to_page($picture[sizes]);

                      $html .= '<div class="block__image lazy" data-original="' . $picture['sizes']['medium_large'] . '">';
                          $html .= '<img class="lazy" src="' . $picture['sizes']['medium_large'] . '" style="visibility: hidden">';
                          $html .= '</div>';
                          $html .= '</div>';

                          echo $html;
                      }
                  } ?>
                </div>
                <div class="row">
                  <div class="col-xs-12"><br><br></div>
                </div>
                <?php

              }
            }
            ?>
          </div>

        </div>
      </div>

    </div>
  </main>
</div>

<?php

get_footer();
