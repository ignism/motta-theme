<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Motta
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<a class="colophon-toggle">colophon</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1">
						&nbsp;
					</div>
					<?php dynamic_sidebar('footer'); ?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/dist/commons.js" charset="utf-8"></script>
<script src="<?php echo get_template_directory_uri();  ?>/dist/app.bundle.js" charset="utf-8"></script>

</body>
</html>
