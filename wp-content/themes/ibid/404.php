<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package ibid
 */

global $ibid_redux;
get_header(); ?>
   
	<!-- Page content -->
	<div id="primary" class="content-area">
	    <main id="main" class="container blog-posts high-padding site-main">
	        <div class="col-md-12 main-content">
				<section class="error-404 not-found">
					<div class="page-content">
						<?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
							<img src="<?php echo esc_url($ibid_redux['img_404']['url']); ?>" alt="<?php echo esc_attr__('Not Found','ibid'); ?>">
						<?php } else { 
							?> <img src="<?php echo esc_url(get_template_directory_uri() . '/images/404.png'); ?>" alt="<?php echo esc_attr__('Not Found','ibid'); ?>">
						<?php } ?>
					</div>
				</section>
			</div>
		</main>
	</div>

<?php get_footer(); ?>