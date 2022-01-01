<?php
/**
 * The sidebar containing the shop filters
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dalla_Terra
 */

if ( is_shop()) :
?>

<aside id="secondary" class="widget-area">
	<?php 
		$intro_text = null;
		$use_cat_filter = null;
		$use_rating_filter = null;
		$use_price_filter = null;

		if (function_exists('get_field')) :

			$intro_text = get_field('intro_text', 'option');
			$use_cat_filter = get_field('category_filter', 'option');
			$use_rating_filter = get_field('rating_filter', 'option');
			$use_price_filter = get_field('price_filter', 'option');

		endif;
	
	?>

	<div class="sidebar-wrapper">
		<button id="close-filter" class="close-filters" aria-label="close filters"><i data-feather="x"></i></button>

		<?php if($intro_text) : ?>
			<p><?php echo $intro_text ?></p>
		<?php endif; ?>

		<?php if($use_cat_filter) : ?>
			<section class="filter">
				<?php echo do_shortcode('[br_filter_single filter_id=134]'); ?>
			</section>
		<?php endif; ?>

		<?php if($use_rating_filter) : ?>
			<section class="filter">
				<?php echo do_shortcode('[br_filter_single filter_id=186]'); ?>
			</section>
		<?php endif; ?>

		<?php if($use_price_filter) : ?>
			<section class="filter">
				<?php echo do_shortcode('[br_filter_single filter_id=145]'); ?>
			</section>
		<?php endif; ?>

		<section class="filter-controls">
			<?php echo do_shortcode('[br_filter_single filter_id=188]') ?>
			<?php echo do_shortcode('[br_filter_single filter_id=187]') ?>
		</section>
	</div>
</aside><!-- #secondary -->

<?php endif; ?>