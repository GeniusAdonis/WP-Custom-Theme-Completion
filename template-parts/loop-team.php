<?php
global $post;
$ind        = $args['ind'];
$categories = get_the_terms( $post->ID, 'team_category' );
$position   = get_field( 'position' );
$gallery    = get_field( 'gallery' );
?>
<article class="loop-team" num="<?php echo esc_attr( $ind ); ?>">
	<div class="loop-team__popup">+</div>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="loop-team__img">
			<?php the_post_thumbnail( 'team-image' ); ?>
		</div>
	<?php endif; ?>
	<div class="loop-team__title__wrapper">
		<h5 class="loop-team__title"><?php echo get_the_title(); ?></h5>
	</div> 
	<?php if ( $categories ) : ?>
	<div class="loop-team__category">
		<?php foreach ( $categories as $category ) : ?>
			<div class="loop-team__category__item p2"><?php echo esc_html( $category->name ); ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="loop-team__modal">
		<div class="close">-</div>
		<?php if ( $gallery ) : ?>
		<div class="loop-team__modal__gallery">
			<?php foreach ( $gallery as $item ) : ?>
			<div class="loop-team__modal__gallery__image">
				<img src="<?php echo esc_url( $item['url'] ); ?>" alt="gallery image">
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="loop-team__modal__content">
			<div class=wrapper>
				<div class="loop-team__modal__title"><?php the_title(); ?></div>
				<?php if ( $categories ) : ?>
				<div class="loop-team__modal__category">
					<?php foreach ( $categories as $category ) : ?>
						<div class="loop-team__modal__category__item p2"><?php echo esc_html( $category->name ); ?></div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<div class="loop-team__modal__description"><?php the_content(); ?></div>
			</div>
		</div>
	</div>
</article>
