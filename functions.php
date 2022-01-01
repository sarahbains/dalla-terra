<?php
/**
 * Dalla Terra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dalla_Terra
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'dalla_terra_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dalla_terra_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Dalla Terra, use a find and replace
		 * to change 'dalla-terra' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dalla-terra', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' 	=> esc_html__( 'Header Menu Location', 'dalla-terra' ),
				'hamburger' => esc_html__( 'Header Hamburger Menu Location', 'dalla-terra' ),
				'social' 	=> esc_html__( 'Social Menu Location', 'dalla-terra' ), 
				'footer' 	=> esc_html__( 'Footer Menu Location', 'dalla-terra' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'dalla_terra_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'dalla_terra_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dalla_terra_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dalla_terra_content_width', 640 );
}
add_action( 'after_setup_theme', 'dalla_terra_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dalla_terra_widgets_init() {
	
}
add_action( 'widgets_init', 'dalla_terra_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dalla_terra_scripts() {
	wp_enqueue_style( 'dalla-terra-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'dalla-terra-style', 'rtl', 'replace' );

	wp_enqueue_script( 'dalla-terra-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script(
		'expander-scripts',
		get_template_directory_uri() . '/js/expander.js',
		array( ),
		_S_VERSION,
		true
	);

	if (is_post_type_archive('dt-locations')) :
		wp_enqueue_script(
			'location-scripts',
			get_template_directory_uri() . '/js/locations-filtering.js',
			array( ),
			_S_VERSION,
			true
		);
	endif;

	wp_enqueue_style(
		'swiper-styles',
		get_template_directory_uri() . '/sass/swiper-bundle.min.css',
		array(),
		'7.2.0',
	);
	wp_enqueue_style(
        'dt-google-fonts', //handle
        'https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;700&family=Merriweather:ital,wght@0,400;0,700;1,300;1,400;1,700&display=swap', //src
        array(),            //dependencies
        null                //google fonts need to be null
    );
	wp_enqueue_script(
		'swiper-scripts',
		get_template_directory_uri() . '/js/swiper-bundle.min.js',
		array(),
		'7.2.0',
		true
	);
	wp_enqueue_script(
		'swiper-settings',
		get_template_directory_uri() . '/js/swiper-settings.js',
		array( 'swiper-scripts' ),
		_S_VERSION,
		true
	);
	wp_enqueue_script(
		'feather-icon-scripts',
		get_template_directory_uri() . '/js/feather.min.js',
		array(),
		'4.28.0',
		true
	);
	wp_enqueue_script(
		'feather-icon-scripts-init',
		get_template_directory_uri() . '/js/feather-init.js',
		array(),
		_S_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'dalla_terra_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

//Change Block Editor To Classic Editor
function dalla_terra_classic_editors( $use_block_editor, $post ) {

    $page_ids = array( 20, 24, 18, 26 );

    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'dalla_terra_classic_editors', 10, 2 );

//Create ACFs for Locations archive page
function dalla_terra_create_acf_pages() {
	if( function_exists('acf_add_options_page') ) {
	  acf_add_options_sub_page(
			array(
				'page_title'    => 'Locations Archive Settings',
				
				'parent_slug'   => 'edit.php?post_type=dt-locations',
				'capability' 	=> 'manage_options'
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'    => 'Filter Settings',
				
				'parent_slug'   => 'edit.php?post_type=product',
				'capability' 	=> 'manage_options'
			)
		);
	}
  }
  add_action('init', 'dalla_terra_create_acf_pages');

add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'header' ) :

		return $items 	. '<li class="menu-item">'
						. '<button title="search" id="search" class="search" aria-label="search"><i data-feather="search"></i></button>'
						. get_product_search_form($echo)
						. '</li>';

	endif;
        
 
    return $items;
}

// hide sku on product page
add_filter( 'wc_product_sku_enabled', '__return_false' );

function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );
function my_login_logo() { 
	wp_enqueue_style(
		'login-styles',
		get_template_directory_uri() . '/login-styles.css',
	);
}
add_action( 'login_enqueue_scripts', 'my_login_logo' ); 
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Dalla Terra';
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );

//Set Block Templates
function fwd_block_editor_templates() {

    if ( isset( $_GET['post'] ) && ('111' == $_GET['post'] || '11' == $_GET['post'])) {
        $post_type_object = get_post_type_object( 'page' );
        $post_type_object->template = array(
			array( '' ),
		);
		$post_type_object->template_lock = 'all';
    } 
}
add_action( 'init', 'fwd_block_editor_templates' );

function display_tutorial_content() { ?>
	
	<a href="<?php echo wp_get_attachment_url( 368 ); ?>">View Tutorial</a> 

	<?php
}

function wporg_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'tutorial', 'Tutorial', 'display_tutorial_content');
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );