<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Dalla_Terra
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function dalla_terra_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'dalla_terra_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function dalla_terra_woocommerce_scripts() {
	wp_enqueue_style( 'dalla-terra-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'dalla-terra-woocommerce-style', $inline_font );

	if (is_shop()) {
		wp_enqueue_script(
			'filter-scripts',
			get_template_directory_uri() . '/js/filter-toggle.js',
			array(),
			_S_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'dalla_terra_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function dalla_terra_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'dalla_terra_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function dalla_terra_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'dalla_terra_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'dalla_terra_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function dalla_terra_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'dalla_terra_woocommerce_wrapper_before' );

if ( ! function_exists( 'dalla_terra_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function dalla_terra_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'dalla_terra_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'dalla_terra_woocommerce_header_cart' ) ) {
			dalla_terra_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'dalla_terra_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function dalla_terra_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		dalla_terra_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dalla_terra_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'dalla_terra_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function dalla_terra_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dalla-terra' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'dalla-terra' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'dalla_terra_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function dalla_terra_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php dalla_terra_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

//Alter the hooks on the archive product template
function dalla_terra_archive_product_hooks() {

	add_action(
		'woocommerce_after_shop_loop_item',
		function () { 
			$categories = get_the_terms( $post->ID, 'product_cat' );	

			if (!empty($categories)) :
				$cat = $categories[0];
				$bg_colour = get_field('product_colour', 'product_cat_'.$cat->term_id ); ?>

				<div class="product-bg" style="background-color: <?php echo $bg_colour; ?>"></div>
			<?php endif; 
		},
		30
	);

	remove_action(
		'woocommerce_before_shop_loop',
		'woocommerce_output_all_notices',
		10,
	);

	remove_action(
		'woocommerce_before_shop_loop',
		'woocommerce_result_count',
		20,
	);

	remove_action(
		'woocommerce_before_shop_loop',
		'woocommerce_catalog_ordering',
		30,
	);
}
add_action( 'init', 'dalla_terra_archive_product_hooks' );


//Redirect to shop page instead of archive page for categories
function dalla_terra_redirect_to_shop() {

    if ( is_product_category() ) {
		$cat_id = get_queried_object()->term_id;
        wp_redirect( wc_get_page_permalink( 'shop' ) . '?filters=product_cat['. $cat_id .']' );
        exit();
    }
}
add_action( 'template_redirect', 'dalla_terra_redirect_to_shop');

function add_filter_button() {
	if (is_shop()) :
	
		remove_action(
			'woocommerce_before_main_content',
			'woocommerce_breadcrumb',
			20
		);
	
		add_action(
			'woocommerce_before_main_content',
			function () { ?>
				<div class="breadcrumb-container">
					<button id="open-filters" class="open-filters" aria-label="open filters"><i data-feather="filter"></i></button>
			<?php },
			15
		);
	
		add_action(
			'woocommerce_before_main_content',
			'woocommerce_breadcrumb',
			16
		);
	
		add_action(
			'woocommerce_before_main_content',
			function () { ?>
				</div>
			<?php },
			17
		);
	endif;
}
add_action( 'template_redirect', 'add_filter_button');

add_filter( 'single_product_archive_thumbnail_size', function( $size ) {
	return 'woocommerce_single';
});

add_filter( 'woocommerce_gallery_image_size', function( $size ) {
	return 'large';
});

function woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 5 );

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}

add_filter ( 'woocommerce_account_menu_items', 'woo_remove_my_account_links' );
function woo_remove_my_account_links( $menu_links ){
	
	unset( $menu_links['downloads'] ); // Disable Downloads
	
	return $menu_links;
}

remove_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_rating',
	10
);

add_action(
	'woocommerce_single_product_summary',
	'woocommerce_template_single_rating',
	15
);