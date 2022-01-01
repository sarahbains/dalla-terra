<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Dalla_Terra
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'dalla-terra' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Maybe try a link below', 'dalla-terra' ); ?></p>

				<div class="404-button">
					<?php
					
					echo '<a href="https://dallaterra.bcitwebdeveloper.ca">Back to Home</a>';
					?>

					<?php
					echo '<br>';
					echo '<a href="https://dallaterra.bcitwebdeveloper.ca/shop/">Back to Shop</a>';
					?>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
