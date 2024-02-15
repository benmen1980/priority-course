
<div class="shop-of-course-priority">
    <img class="shop-backgrond" src="<?php echo plugins_url('my-course-priority/includes/img/shop-backgrond.jpg')?>" aria-hidden="false" alt="">

    <h1 class="title-shop">קורס תכנות בפריוריטי</h1>
    <h1 class="title-maslulim">מאת: רועי בן מנחם</h1>
    <div class="products-maslulim">
        <?php
        $maslul_sku=101;
        $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
        $maslul_title = get_the_title($maslul_id);
        $maslul_price = get_post_meta( $maslul_id, '_price', true );

        ?>
        <div class="maslul maslul-basis" data-set="<?php echo $maslul_id; ?>">
            <div class="container-maslul">
            <h2><?php echo $maslul_title; ?></h2>
            <h3><?php echo $maslul_price; ?> ש"ח</h3>

            <div class="all-text">
            <?php
                 if( have_rows('include',$maslul_id ) ):
                 while ( have_rows('include',$maslul_id) ) : the_row(); ?>
                    <p><?php the_sub_field('text'); ?></p>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
            </div>
            <button class="add-to-cart-button" data-sku="<?php echo $maslul_sku; ?>">הצטרפות</button>
        </div>
        <?php
        $maslul_sku=202;
        $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
        $maslul_title = get_the_title($maslul_id);
        $maslul_price = get_post_meta( $maslul_id, '_price', true );

        ?>
        <div class="maslul maslul-more" data-set="<?php echo $maslul_id; ?>">
            <div  class="container-maslul">
            <h2><?php echo $maslul_title; ?></h2>
            <h3><?php echo $maslul_price; ?> ש"ח</h3>
            <div class="all-text">
                <?php
                if( have_rows('include',$maslul_id ) ):
                    while ( have_rows('include',$maslul_id) ) : the_row(); ?>
                        <p><?php the_sub_field('text'); ?></p>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            </div>
            <button class="add-to-cart-button" data-sku="<?php echo $maslul_sku; ?>">הצטרפות</button>
        </div>
        <?php
        $maslul_sku=303;
        $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
        $maslul_title = get_the_title($maslul_id);
        $maslul_price = get_post_meta( $maslul_id, '_price', true );

        ?>
        <div class="maslul maslul-primum" data-set="<?php echo $maslul_id; ?>">
            <div  class="container-maslul">
            <h2><?php echo $maslul_title; ?></h2>
            <h3><?php echo $maslul_price; ?> ש"ח</h3>
            <div class="all-text">
                <?php
                if( have_rows('include',$maslul_id ) ):
                    while ( have_rows('include',$maslul_id) ) : the_row(); ?>
                        <p><?php the_sub_field('text'); ?></p>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            </div>
            <button class="add-to-cart-button" data-sku="<?php echo $maslul_sku; ?>">הצטרפות</button>
        </div>
        <?php
        $maslul_sku=404;
        $maslul_id = wc_get_product_id_by_sku( $maslul_sku );
        $maslul_title = get_the_title($maslul_id);
        $maslul_price = get_post_meta( $maslul_id, '_price', true );

        ?>
        <div class="maslul maslul-gold" data-set="<?php echo $maslul_id; ?>">
            <div  class="container-maslul">
            <h2><?php echo $maslul_title; ?></h2>
            <h3><?php echo $maslul_price; ?> ש"ח</h3>
            <div class="all-text">
                <?php
                if( have_rows('include',$maslul_id ) ):
                    while ( have_rows('include',$maslul_id) ) : the_row(); ?>
                        <p><?php the_sub_field('text'); ?></p>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            </div>
            <button class="add-to-cart-button" data-sku="<?php echo $maslul_sku; ?>">הצטרפות</button>
        </div>
    </div>

</div>
<?php
