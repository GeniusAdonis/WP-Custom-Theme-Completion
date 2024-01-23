<?php
global $post;
?>
<!-- Section Portfolio Hero -->
<section class="portfolio-hero">
	<div class="container">
		<div class="portfolio-hero__info section-intro">
			<?php if ( get_field( 'year_built' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Year Built</h6>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'year_built',
						't'  => 'h5',
						'o'  => 'f',
						'tc' => 'item-content p a-up a-delay-1',
					)
				);
				?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'type' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Type</h6>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'type',
						't'  => 'h5',
						'o'  => 'f',
						'tc' => 'item-content p a-up a-delay-1',
					)
				);
				?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'square_footage' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Square Footage</h6>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'square_footage',
						't'  => 'h5',
						'o'  => 'f',
						'tc' => 'item-content p a-up a-delay-1',
					)
				);
				?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'cost' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Cost</h6>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'cost',
						't'  => 'h5',
						'o'  => 'f',
						'tc' => 'item-content p a-up a-delay-1',
					)
				);
				?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'units' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Units</h6>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'units',
						't'  => 'h5',
						'o'  => 'f',
						'tc' => 'item-content p a-up a-delay-1',
					)
				);
				?>
			</div>
			<?php endif; ?>
			<?php if ( get_field( 'website' ) ) : ?>
			<div class="portfolio-hero__info__item">
				<h6 class="item-title a-up a-delay-1">Website</h6>
				<a href="https://<?php echo esc_url( the_field( 'website' ) ); ?>" target="_blank" class="item-content h5 p a-up a-delay-1"><?php echo esc_html( the_field( 'website' ) ); ?></a>
			</div>
			<?php endif; ?>
		</div>
		<h5 class="mobile-show a-up a-delay-1">Project Details</h5>
		<div class="portfolio-hero__main section-content">
		<?php
		get_template_part_args(
			'template-parts/content-modules-text',
			array(
				'v'  => 'position',
				't'  => 'h6',
				'o'  => 'f',
				'tc' => 'portfolio-hero__position p2 a-up a-delay-1',
			)
		);
		?>
		<h1 class="portfolio-hero__title a-up a-delay-1"><?php the_title(); ?></h1>
		<div class="portfolio-hero__content a-up a-delay-2"><?php the_content(); ?></div>
	</div>
	</div>
</section>
<!-- Gallery Carousel -->
<section class="portfolio-gallery">
	<?php
	$gallery = get_field( 'gallery' );
	if ( $gallery ) :
		?>
	<div class="portfolio-gallery__carousel">
		<?php foreach ( $gallery as $ind => $image ) : ?>
		<div class="gallery-image">
			<img src="<?php echo esc_attr( $image['url'] ); ?>" alt="">
			<div class="gallery-image__info">
				<h4 class="info-number"><?php echo esc_html( $ind + 1 . '/' . count( $gallery ) ); ?></h4>
				<p class="info-caption"><?php echo esc_html( $image['caption'] ); ?></p>
			</div>
			<!-- <div class="buttons">
				<div class="button-prev">
					<div class="button-btn">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/ico-arrow-right-green.svg' ); ?>" alt="">
					</div>
				</div>
				<div class="button-next">
					<div class="button-btn">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/ico-arrow-right-green.svg' ); ?>" alt="">
					</div>
				</div>
			</div> -->
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</section>
<!-- Team Section -->
<section class="portfolio-team">
	<div class="container">
		<h6 class="portfolio-team__title section-intro">Team</h6>
		<div class="portfolio-team__content section-content">
			<ul class="portfolio-team__info">
				<?php if ( get_field( 'developer' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Developer</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'developer',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'architect' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Architect</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'architect',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'general_contractor' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">General Contractor</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'general_contractor',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'interior_designer' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Interior Designer</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'interior_designer',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'landscape_architect' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Landscape Architect</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'landscape_architect',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'structural_engineer' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Structural Engineer</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'structural_engineer',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'mechanical_engineer' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Mechanical Engineer</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'mechanical_engineer',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php if ( get_field( 'civil_engineer' ) ) : ?>
				<li class="portfolio-team__info__item">
					<h6 class="item-title a-up a-delay-1 p2">Civil Engineer</h6>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'civil_engineer',
							't'  => 'h5',
							'o'  => 'f',
							'tc' => 'item-content a-up a-delay-2',
						)
					);
					?>
				</li>
				<?php endif; ?>
				<?php
				$extra = get_field( 'additional_field' );
				if ( $extra ) :
					foreach ( $extra as $item ) :
				?>
					<li class="portfolio-team__info__item">
						<h6 class="item-title a-up a-delay-1 p2"><?php echo $item['title']?></h6>
						<h5 class="item-content a-up a-delay-2"><?php echo $item['content']?></h5>
					</li>
				<?php
					endforeach;
				endif;
				?>
			</ul>
		</div>
	</div>
</section>
