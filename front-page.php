<?php
/**
 * The template for displaying the Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dalla_Terra
 */

get_header();
?>

	<main id="primary" class="site-main">
		<h1 class="screen-reader-text"><?php the_title(); ?></h1>

		<div class="home-intro-grid">
			<section class="view-single-product-home">
				<?php 
				if (function_exists('get_field')) :
					$featured_posts = get_field('view_single_product');
					if( $featured_posts ): ?>
					
						<?php foreach( $featured_posts as $post ): 
					
							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post); ?>
							<?php the_post_thumbnail() ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php endforeach; 
						
						wp_reset_postdata();
					endif; 
				endif; ?>
			</section>


			<section class="custom-cta-home"> 
				<?php
				if (function_exists('get_field')) :
					$custom_cta = get_field('custom_call_to_action');
					if( $custom_cta ): ?>
						<div class="custom-cta-content">
							<?php echo wp_get_attachment_image( $custom_cta['background_image'], 'full' ); ?>
							
							<a href="<?php echo esc_url( $custom_cta['link'] ); ?>">
								<?php echo esc_html( $custom_cta['button_text']); ?>
							</a>
							
						</div>
					<?php endif; 
				endif; ?>
			</section>

			<section class="view-shop-cta-home">
				<?php
					if (function_exists('get_field')) :
						$view_shop_CTA = get_field('view_shop_cta');
						if( $view_shop_CTA ): ?>
							<div class="custom-cta-content">
								<h2><?php echo esc_html( $view_shop_CTA['hero_text']); ?></h2>
								<?php echo wp_get_attachment_image( $view_shop_CTA['background_image'], 'full' ); ?>
								
								<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">
									<?php echo esc_html( $view_shop_CTA['button_text']); ?>
								</a>
								
							</div>
					<?php endif; 
				endif; ?>
			</section>
		</div>

		<section class="bestsellers-home">
			<?php 
			if (function_exists('get_field')) :
				$featured_posts = get_field('bestsellers');
				if( $featured_posts ) : ?>
					
					<div class="swiper">
						<div class="swiper-header">
							<h2>Bestsellers</h2>

							<div class="swiper-btns">
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
						</div>

						<ul class="swiper-wrapper bestsellers">
							<?php foreach( $featured_posts as $post ): 
								setup_postdata($post); 
								$categories = get_the_terms( $post->ID, 'product_cat' );	
							?>
								<li class='swiper-slide bestseller'>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
										<p class="view-product-cta">View Product</p>
										<?php
											if (!empty($categories)) :
												$cat = $categories[0];
												$bg_colour = get_field('product_colour', 'product_cat_'.$cat->term_id ); ?>
				
												<div class="product-bg" style="background-color: <?php echo $bg_colour; ?>"></div>
										<?php endif; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
				</div>
				<?php 
				wp_reset_postdata(); 
			 	endif; 
			endif; ?>
		</section>
	
		<section class="categories-section-home">
			<h2>Our Categories</h2>
			<?php
			if (function_exists('get_field')) :
				$terms = get_field('categories');

				if (!empty($terms)):
					set_query_var( 'categories', $terms ); 
					get_template_part( 'template-parts/content', 'dalla-terra-categories' );
				endif;
			endif;
			?>
		</section>


		<section class="about-us-banner-home">
			<?php
				if (function_exists('get_field')) :
					$about_us_banner = get_field('about_us_banner');
					if( $about_us_banner ): ?>
						<figure id="about-us-banner">

						<?php echo wp_get_attachment_image( $about_us_banner['background_image'], 'full' ); ?>
							
							<figcaption>
								<h2><?php echo esc_html( $about_us_banner['heading'] ) ?></h2>
								<a href="<?php echo esc_url( $about_us_banner['link'] ); ?>">
									<?php echo esc_html( $about_us_banner['button_text']); ?>
								</a>
							</figcaption>
						</figure>
					<?php endif; 
				endif; ?>
		</section>
	</main><!-- #main -->

<?php
get_footer();
