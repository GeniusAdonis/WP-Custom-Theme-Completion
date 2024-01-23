</main>

<?php
$logos       = get_field( 'footer_logo', 'options' );
$extra_menu  = get_field( 'extra_menu', 'options' );
$footer_menu = get_field( 'footer_menu', 'options' );
$social_menu = get_field( 'social_menu', 'options' );
?>

<footer class="footer">
	<div class="container">
		<div class="footer-info">
			<?php if ( have_rows( 'address', 'options' ) ) : ?>
				<div class="footer-info__address">
					<?php
					while ( have_rows( 'address', 'options' ) ) :
						the_row();
						$address = get_sub_field('address');
						$url     = get_sub_field('url');
						?>
						<a href="<?php echo esc_url( $url ); ?>" class="footer-info__address__item p" target="_blank"><?php echo $address; ?></a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php
			$phone = get_field( 'phone', 'option' );
			$email = get_field( 'email', 'option' );
			?>
			<a href="tel:<?php echo esc_attr( $phone ); ?>" class="footer-info__phone p"><?php echo esc_html( $phone ); ?></a>
			<a href="mailto:<?php echo esc_attr( $email ); ?>" class="footer-info__email p"><?php echo esc_html( $email ); ?></a>
			<div class="footer-info__social_and_logo">
				<?php if ( $social_menu ) : ?>
				<ul class="footer-info__social">
					<?php foreach ( $social_menu as $social ) : ?>
					<li class="footer-info__social__item"><a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank"><img src="<?php echo esc_attr( $social['icon']['url'] ); ?>" alt=""></a></li></li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<div class="footer-logo">
					<?php if ( $logos ) :
						foreach ( $logos as $image ) :
						?>
						<a href="/" class="footer-logo__item">
							<img src="<?php echo esc_attr( $image['logo']['url'] ); ?>" alt="footer logo">
						</a>
					<?php
					endforeach;
				endif; ?>
				</div>
			</div>
			<?php if ( have_rows( 'footer_menu', 'options' ) ) : ?>
			<ul class="footer-info__menu">
				<?php
				while ( have_rows( 'footer_menu', 'options' ) ) :
					the_row();
					?>
					<li class="footer-info__menu__item">
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'menu-item__menu',
							)
						);
						?>
					</li>
					<li class="footer-info__menu__item">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'copyright',
							't'  => 'h6',
							'o'  => 'o',
							'tc' => 'footer-menu__copyright',
						)
					);
					?>
				</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		</div>
		<div class="footer-menu">
			<?php
			wp_nav_menu(
				array(
					'container'  => false,
					'menu'       => 'Main Menu',
					'menu_class' => 'footer-menu__main',
				)
			);
			?>
			<?php if ( have_rows( 'extra_menu', 'options' ) ) : ?>
			<ul class="footer-menu__extra">
				<?php
				while ( have_rows( 'extra_menu', 'options' ) ) :
					the_row();
					?>
					<li class="footer-menu__extra__item">
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'extra-item__menu',
							)
						);
						?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
			<?php if ( have_rows( 'footer_menu', 'options' ) ) : ?>
			<ul class="footer-menu__menu">
				<?php
				while ( have_rows( 'footer_menu', 'options' ) ) :
					the_row();
					?>
					<li class="footer-menu__menu__item">
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'cta',
								'c' => 'menu-item__menu',
							)
						);
						?>
					</li>
				<?php endwhile; ?>
				<li class="footer-menu__menu__item">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'copyright',
							't'  => 'h6',
							'o'  => 'o',
							'tc' => 'footer-menu__copyright',
						)
					);
					?>
				</li>
			</ul>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<!-- Tracking Footer -->
<?php
get_template_part_args(
	'template-parts/content-modules-text',
	array(
		'v' => 'tracking_foot',
		'o' => 'o',
	)
);
?>
<!-- /Tracking Footer -->
</body>
</html>
