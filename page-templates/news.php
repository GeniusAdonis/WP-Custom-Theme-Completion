<?php
/**
 * Template Name: News
 */

get_header();
?>
<section class="news-archieve">
	<?php
	$paged = get_query_var( 'paged' );
	$args  = array(
		'post_type'      => 'post',
		'posts_per_page' => 12,
		'paged'          => $paged,
	);
	$query = new WP_Query( $args );
	?>
	<div class="container">
		<h1 class="news-archieve__title a-up"><?php the_title(); ?></h1>
		<div class="news-archieve__description a-up a-delay-1"><?php the_content(); ?></div>
		<div class="news-archieve__content">
			<?php if ( $query->have_posts() ) : ?>
				<div class="news-archieve__grid"
					data-cat=""
					data-post-type="post"
					data-paged=""
					data-posts-per-page="-1"
				>
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						get_template_part( 'template-parts/loop', 'post' );
						?>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="pagination">
					<?php
					echo paginate_links(
						array(
							'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $query->max_num_pages,
							'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 11 8" fill="none"><path d="M0.646446 3.64645C0.451184 3.84171 0.451184 4.15829 0.646446 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659729 4.53553 0.464467C4.34027 0.269205 4.02369 0.269205 3.82843 0.464467L0.646446 3.64645ZM11 3.5L1 3.5L1 4.5L11 4.5L11 3.5Z" fill="#191919"/></svg>',
							'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 11 8" fill="none">                        <path d="M10.3536 4.35355C10.5488 4.15829 10.5488 3.84171 10.3536 3.64645L7.17157 0.464465C6.97631 0.269203 6.65973 0.269203 6.46447 0.464465C6.2692 0.659728 6.2692 0.97631 6.46447 1.17157L9.29289 4L6.46447 6.82843C6.2692 7.02369 6.2692 7.34027 6.46447 7.53553C6.65973 7.7308 6.97631 7.7308 7.17157 7.53553L10.3536 4.35355ZM3.99712e-08 4.5L10 4.5L10 3.5L-3.99712e-08 3.5L3.99712e-08 4.5Z" fill="#191919"/></svg>',
						)
					);
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
get_footer();
