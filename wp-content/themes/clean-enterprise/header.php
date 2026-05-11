<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Clean_Enterprise
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' );  ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'clean-enterprise' ); ?></a>

		<header id="masthead" class="site-header">
				<?php get_template_part( 'template-parts/header/header', 'top' ); ?>

				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
		</header><!-- #masthead -->

		<?php get_template_part( 'template-parts/header/sec-navigation' ); ?>

		<div class="below-site-header">

			<div class="site-overlay"><span class="screen-reader-text"><?php esc_html_e( 'Site Overlay', 'clean-enterprise' ); ?></span></div>

			<?php clean_enterprise_sections(); ?>

			<div id="content" class="site-content">
				<div class="wrapper">
					<div class="content-box">
