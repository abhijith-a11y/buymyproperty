<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Buy My Property
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			
            <div class="error-container" style="padding-top: 205px;">
                
                <!-- Use the 404 code with the large, primary color style -->
                <div class="error-code">404</div>
                
                <!-- Use the branded title style -->
                <h1 class="error-title">
                    <?php esc_html_e( 'Page Not Found', 'Buy My Property' ); ?>
                </h1>
                
                <!-- Branded message -->
                <p class="error-message">
                    <?php esc_html_e( 'We couldn\'t find the page you were looking for. The link may be broken or the page may have been removed.', 'Buy My Property' ); ?>
                </p>

                <!-- Branded Home Button -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary btn">
                    <?php esc_html_e( 'Go to Homepage', 'Buy My Property' ); ?>
                </a>

            </div><!-- .error-container -->


			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
