<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group">

			<div class="header-inner section-inner">

				<div class="header-titles-wrapper">

					<div class="header-titles">
						<?php
							// Site title or logo.
							twentytwenty_site_logo();

							if ( DISPLAY_DESCRIPTION ) {
								twentytwenty_site_description();
							}
						?>

					</div><!-- .header-titles -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-mobile-menu-toggle">
					<label class="toggle-mobile-menu" for="mobile-toggle"><?php twentytwenty_the_theme_svg( 'sandwich' ); ?></label>
				</div>

				<div class="header-navigation-wrapper">

					<input type="checkbox" id="mobile-toggle" />
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						?>
							<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>">
								<ul class="primary-menu reset-list-style">
									<?php
										wp_nav_menu(
											array(
												'container'      => '',
												'items_wrap'     => '%3$s',
												'theme_location' => 'primary',
												'walker'         => new Walker_SubMenu_Modifier(),
											)
										);
									?>
								</ul>
							</nav><!-- .primary-menu-wrapper -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->
			
		</header><!-- #site-header -->
