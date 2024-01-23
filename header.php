<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link rel="shortcut icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.png' ); ?>">

	<?php wp_head(); ?>
	<!-- Tracking Head -->
	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'tracking_head',
			'o' => 'o',
		)
	);
	?>
	<!-- /Tracking Head -->
</head>

<?php
$image       = get_field( 'header_logo', 'options' );
$social_menu = get_field( 'social_menu', 'options' );
$extra_menu  = get_field( 'extra_menu', 'options' );
$menu_style  = get_field( 'menu_style' ) ? get_field( 'menu_style' ) : 'blue';
?>

<body <?php body_class(); ?>>

<!-- Tracking Body -->
<?php
get_template_part_args(
	'template-parts/content-modules-text',
	array(
		'v' => 'tracking_body',
		'o' => 'o',
	)
);
?>
<!-- /Tracking Body -->

<header class="header" id="header">
	<div class="container">
		<div class="header-logo">
			<?php if ( $image ) : ?>
			<a href="/">
				<img src="<?php echo esc_attr( $image['url'] ); ?>" alt="header logo">
			</a>
			<?php endif; ?>
		</div>
		<div class="hamburger style--<?php echo esc_attr( $menu_style ); ?>">
			<span></span>
		</div>
		<div class="header-nav style--<?php echo esc_attr( $menu_style ); ?>">
			<div class="container">
				<div class="header-nav__info">
					<?php if ( have_rows( 'address', 'options' ) ) : ?>
						<div class="header-nav__info__address">
							<?php
							$ind = 0;
							while ( have_rows( 'address', 'options' ) ) :
								the_row();
								$address = get_sub_field('address');
								$url     = get_sub_field('url');
								$ind ++;
								?>
								<a href="<?php echo esc_url( $url ); ?>" class="header-nav__info__address__item p a-up a-delay-<?php echo $ind?>"><?php echo $address; ?></a>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
					<?php
					$phone = get_field( 'phone', 'option' );
					$email = get_field( 'email', 'option' );
					?>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" class="header-nav__info__phone p a-up a-delay-3"><?php echo esc_html( $phone ); ?></a>
					<a href="mailto:<?php echo esc_attr( $email ); ?>" class="header-nav__info__email p a-up a-delay-3"><?php echo esc_html( $email ); ?></a>
					<?php if ( $social_menu ) : ?>
					<ul class="header-nav__info__social a-up a-delay-4">
						<?php foreach ( $social_menu as $social ) : ?>
						<li class="header-nav__info__social__item"><a href="<?php echo esc_url( $social['url'] ); ?>"><img src="<?php echo esc_attr( $social['icon']['url'] ); ?>" alt=""></a></li></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<div class="header-nav__menus">
					<?php
					wp_nav_menu(
						array(
							'container'  => false,
							'menu'       => 'Main Menu',
							'menu_class' => 'header-nav__menu a-up a-delay-3',
						)
					);
					?>
					<?php if ( have_rows( 'extra_menu', 'options' ) ) : ?>
					<ul class="header-nav__extra">
						<?php
						while ( have_rows( 'extra_menu', 'options' ) ) :
							the_row();
							?>
							<li class="header-nav__extra__item a-up a-delay-4">
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
				</div>
			</div>
			<div class="header-nav__close"></div>
		</div>
	</div>
</header>

<main class="main">
