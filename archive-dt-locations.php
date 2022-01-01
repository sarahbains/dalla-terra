<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dalla_Terra
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					if ( function_exists('get_field') && get_field('title', 'option') ) : ?>
						<h1><?php echo get_field('title', 'option'); ?></h1>
					<?php else : ?>
						<h1><?php echo 'Locations'; ?></h1>
				<?php endif; 
					if (function_exists('get_field') && get_field('introduction', 'option') ) :
						echo get_field('introduction', 'option');
					endif;
				?>
			</header><!-- .page-header -->

			<?php 

				$location_sort = 'all';

				if( isset($_GET['location'] ) ){
					$location_sort = trim($_GET["location"]);
				}
			
			?>

			<section class="location-types">
				<p>What kind of location?</p>
				<nav>
					<?php 

						$categories = get_categories([
							'taxonomy'      => 'dt-location-category',
							'parent'        => 0,
							'hide_empty'    => false
						]);

						foreach ($categories as $cat) : 
							
						?>
							<button class="location-filter" data-location="<?php echo $cat->term_id ?>"><?php echo $cat->name; ?></button>
						<?php endforeach; ?>
				</nav>
			</section>
			<div class="map-wrapper">
				<?php echo do_shortcode('[leaflet-map fitbounds]'); ?>
			</div>
			<?php
			if ( have_posts() ) : ?>
				<div class="locations-wrapper">
				
				<?php while ( have_posts() ) : the_post(); 
					$terms = get_the_terms($post->ID, 'dt-location-category');
				?>
					<section class="expander location" 
							data-locations=
							<?php 	
								$last_key = end(array_keys($terms));

								echo "[";
								foreach($terms as $key => $term) 
									echo $term->term_id;
									echo $key !== $last_key ? ',' : ''; 
								echo "]";
							?>
						>
						<h2><?php the_title() ?></h2>
						
						<?php
							$address;
							$phone;
							
							if (function_exists('get_field')) :
								$address = get_field('address');
								$phone = get_field('phone_number');
							endif;

							if ($address || $phone): ?>
								<address>
									<?php echo $address ?>
									<?php if ($phone) : ?>
										<p><?php echo $phone ?></p>
									<?php endif ?>
								</address>
						<?php endif;
						
						if (function_exists('have_rows')) :
							if( have_rows('store_hours') ): ?>

								<table>
									<tbody>
										<?php while( have_rows('store_hours') ) : the_row();
									
											$day = get_sub_field('day');
											$hours = get_sub_field('hours');
											?>

											<tr>
												<td><?php echo $day ?></td>
												<td><?php echo $hours ?></td>
											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
						<?php endif; 
						endif; ?>
						<button class="expand-btn">See More</button>
					</section>
				<?php endwhile; ?>
				</div>
			<?php endif;
		 endif; ?>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
