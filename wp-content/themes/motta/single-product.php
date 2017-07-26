<?php
/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package Motta
*/


while (have_posts()) {
  the_post();

  $linked_book_merchandise = get_field('linked_book_merchandise');

  $url = get_the_permalink($linked_book_merchandise[0]->ID);

  header("Location: " . $url);
  die();

}
?>
