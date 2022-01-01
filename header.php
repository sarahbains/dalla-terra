<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dalla_Terra
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dalla-terra' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			if (has_custom_logo()) : 
				the_custom_logo();
			else : ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			<?php endif;?>
		</div><!-- .site-branding -->

		<nav id="primary-navigation" class="main-navigation">
			<?php

			wp_nav_menu(
				array(
					'theme_location' => 'header',
					'menu_id'        => 'header-menu',
				)
			);
			?>
		</nav><!-- #site-main-navigation -->

		<nav id="hamburger-navigation" class="hamburger-navigation">
			<button title="open menu" class="menu-toggle open" aria-label="open menu" aria-controls="hamburger-menu" aria-expanded="false"><i data-feather="menu"></i></button>
			<button title="close menu" class="menu-toggle close" aria-label="close menu" aria-controls="hamburger-menu" aria-expanded="false"><i data-feather="x"></i></button>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'hamburger',
				)
			);
			?>
		</nav><!-- #site-hamburger-navigation -->
	</header><!-- #masthead -->
