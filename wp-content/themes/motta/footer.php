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
					<div class="col-xs-10 burger-offset">
						<a class="colophon-toggle">information</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="container-fluid">

							<div class="row">
								<?php dynamic_sidebar('footer'); ?>
							</div>
			        <div class="row">
								<div class="col-xs-3">
									<a href="<?php echo get_the_permalink(9) ?>" class="colophon--small">overige winkels</a>
								</div>
			          <div class="col-xs-3">
									<a href="<?php echo get_the_permalink(159) ?>" class="colophon--small">disclaimer</a>
								</div>
			          <div class="col-xs-3">
									<a href="<?php echo get_the_permalink(163) ?>" class="colophon--small">conditions</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/commons.js?v=1.1" charset="utf-8"></script>
<script src="<?php echo get_template_directory_uri();  ?>/dist/app.bundle.js?v=1.1" charset="utf-8"></script>

</body>
</html>
