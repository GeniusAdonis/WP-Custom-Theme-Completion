<?php
global $post;
$url   = get_field( 'link' );
$color = get_field( 'background_color' );
$date  = get_the_date( 'm.d.o' );
?>
<article class="loop-post">
    <a href="<?php echo esc_url( $url ); ?>" target="_blank">
        <div class="loop-post__image">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="loop-post__back" style="background-color: <?php echo esc_attr( $color ); ?>"><img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/assets/img/post_back.png" alt=""></div>
        <h5 class="loop-post__title"><?php echo get_the_title(); ?></h5>
        <h6 class="loop-post__date"><?php echo esc_html( $date );?> </h6>
        <div class="loop-post__arrow" ><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/ico-arrow-right.svg' ); ?>" alt=""></div>
        <div class="loop-post__circle_arrow" ><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/ico-arrow-right.svg' ); ?>" alt=""></div>
    </a>
</article>