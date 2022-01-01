<?php
/**
 * The template for displaying About Us Page
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
        <div class="about-us-page-content">
            <section class="about-us-banner">
                <?php
                if (function_exists('get_field')) :
                    $aboutUsBanner = get_field('banner');
                    if( $aboutUsBanner ): ?>
                        <div id="custom-cta-content">
                            <?php echo wp_get_attachment_image($aboutUsBanner['background_image'], 'full' ); ?>
                            <div class="banner-text">
                                <h1><?php the_title(); ?></h1>
                                <p><?php echo $aboutUsBanner['text']; ?></p>
                            </div>
                        </div>
                    <?php endif; 
                endif; ?>
            </section>

            <section class="about-us-quote">
                <?php 
                    if (function_exists('get_field')) : 
                        $quote = get_field('quote'); ?>
                        <blockquote><?php the_field('quote'); ?></blockquote>
                    <?php endif; ?>
            </section>
        
            <section class="about-us-farm-gallery">
            <?php
                if (function_exists('get_field')) : 
                    $farmGallery = get_field('farm_gallery');
                    $images = $farmGallery['images'];

                    if( $farmGallery): ?>
                        <div class="gallery-heading">
                            <h2><?php echo $farmGallery['text']; ?></h2>
                            <p><?php echo $farmGallery['gallery_caption']; ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="farm-gallery">
                        <?php
                        if( $images ): ?>
                            <ul>
                                <?php foreach( $images as $image ): ?>
                                    <li>
                                        <?php echo $image['url']; ?>
                                        <?php echo wp_get_attachment_image($image, 'full' ); ?>
                                        <p><?php echo $image['caption']; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </section>

            <div class="about-us-mission-history-vision">
                <section class="about-us-mission">
                    <?php 
                        if (function_exists('get_field_object')) : 
                            $field = get_field_object('our_mission'); 
                            
                            if ($field) : ?>
                                <h2><?php echo $field['label']; ?></h2>
                            <?php endif; 
                        endif; 
                    ?>
                    <?php 
                        if (function_exists('get_field')) : 
                            $mission = get_field('our_mission');

                            if ($mission) : ?>
                                <p><?php echo $mission; ?></p>
                            <?php endif;
                        endif; ?>
                </section>

                <section class="about-us-history">
                    <?php
                        if (function_exists('get_field_object')) :  
                            $field = get_field_object('our_history'); 

                            if ($field) : ?>
                                <h2><?php echo $field['label']; ?></h2>
                            <?php endif; 
                        endif; 
                        
                        if (function_exists('get_field')) : 
                            $history =  get_field('our_history');

                            if ($history) : ?>
                                <p><?php echo $history; ?></p>
                            <?php endif;
                        endif; ?>
                </section>
            </div>

            <section class="about-us-winery-gallery">
                <?php
                    if (function_exists('get_field')) : 
                        $wineryGallery = get_field('winery_gallery');
                        $images = $wineryGallery['images'];

                        if( $wineryGallery ): ?>
                            <div class="gallery-heading">
                                <h2><?php echo $wineryGallery['gallery_heading']; ?></h2>
                                <p><?php echo $wineryGallery['gallery_caption']; ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="winery-gallery">
                            <?php if( $images ): ?>
                                <ul>
                                    <?php foreach( $images as $image ): ?>
                                        <li>
                                            <?php echo $image['url']; ?>
                                            <?php echo wp_get_attachment_image($image, 'full' ); ?>
                                            <p><?php echo $image['caption']; ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                <?php endif;?>
            </section>
            
            <div class="about-us-mission-history-vision">
                <section class="about-us-vision">
                    <?php 
                        if (function_exists('get_field_object')) : 
                            $vision_object = get_field_object('our_vision'); 

                            if ($vision_object) : ?>
                                <h2><?php echo $vision_object['label']; ?></h2>
                            <?php endif;
                        endif;

                        if (function_exists('get_field')) : 
                            $vision = get_field('our_vision'); 
                            
                            if ($vision) : ?>
                                <p><?php echo $vision;  ?></p>
                    <?php   endif;
                        endif; ?>
                </section>

                <section class="link-cta">
                    <?php
                        if (function_exists('get_field')) : 
                            $shopLink= get_field('link');

                            if( $shopLink ): ?>
                                <a class="view-our-shop" href="<?php echo $shopLink['link']; ?>">
                                    <?php echo esc_html( $shopLink['text']); ?>
                                </a>
                    <?php   endif; 
                        endif; 
                    ?>
                        
                    <nav id="social-navigation" class="social-navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'social')); ?>
                    </nav>
                </section>
            </div>
        </div>
	</main><!-- #main -->
<?php
get_footer();
