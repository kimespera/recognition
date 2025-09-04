<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'recognition' ); ?></a>

	<header id="header" class="header">
		<div class="header-container container">
			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php
						$logo = get_field('logo','option');
						echo wp_get_attachment_image($logo, 'full');
					?>
				</a>
			</div>
			<?php
				wp_nav_menu(array(
					'link_after' => '<span class="link-border"></span>',
					'container' => 'nav',
					'container_id' => 'main-nav',
					'container_class' => 'main-nav',
					'menu' => 'Main Menu',
					'menu_id' => 'main-menu',
					'menu_class' => 'main-menu'
				));
			?>
		</div>
	</header>
