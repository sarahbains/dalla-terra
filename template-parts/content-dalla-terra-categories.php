<?php 

    $args = get_query_var( 'categories' );

    set_query_var( 'categories', null );
    

    $categories = get_categories([
        'taxonomy'      => 'product_cat',
        'parent'        => 0,
        'hide_empty'    => false,
        'exclude'       => array( '15' ),                   //Don't care about uncategorized category
        'include'       => empty($args) ? null : $args      //Include specified categories
    ]);

    foreach ($categories as $category) : 
        if (function_exists('get_field')) : 
            $bg_colour = get_field('card_colour', 'product_cat_'.$category->term_id ); ?>
            
            <article class="category-article" style="background-color: <?php echo $bg_colour  ?>">
                
                <div class="card-header">
                    <h2 class="category-name"><?php echo $category->name ?></h2>

                    <?php if ( get_field('caption', 'product_cat_'.$category->term_id )) : ?>
                        <p class="category-caption"><?php the_field('caption', 'product_cat_'.$category->term_id); ?></p>
                    <?php endif; ?>
                </div>

                
                <?php if ( $category->description ) : ?>
                    <p class="category-description"><?php echo $category->description; ?></p>
                <?php endif; ?>

                <?php 
                    $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );

                    if ( $thumbnail_id && !is_front_page()) : 
                        echo wp_get_attachment_image( $thumbnail_id, 'full' );

                    endif;
                ?>

                <?php 
                    $link_url = add_query_arg( 'filters', 'product_cat[' . $category->term_id . ']', get_permalink(11))
                ?>

                <a class="category-link" href="<?php echo $link_url ?>">View All</a>
            
            </article>
<?php   endif;
    endforeach; ?>