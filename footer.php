<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dalla_Terra
 */

?>

	<footer id="colophon" class="site-footer">

		<nav id="footer-navigation">
			<?php 
				wp_nav_menu( 
					array( '
						theme_location' => 'footer',
						'depth' 		=> 1
					)	
				); 
			?>
		</nav>

		<?php
			$address = get_field('address', '24');
			$email = get_field('email', '24');
			$phone = get_field('phone_number', '24');
			if ( $address || $email || $phone ):
		?>
			<address class="contact-information">
				<?php if ($address) : ?>
					<p class="address"><?php echo $address; ?></p>
				<?php endif; ?>
				<?php if ($email) : ?>
					<a href="mailto:<?php echo $email; ?>"><p class="email"><?php echo $email; ?></p></a>
				<?php endif; ?>
				<?php if ($phone) : ?>
					<a href="tel:<?php echo $phone; ?>"><p class="phone"><?php echo $phone; ?></p></a>
				<?php endif; ?>
			</address>
		<?php endif; ?>

		<nav id="social-navigation" class="social-navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'social')); ?>
		</nav>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
