<?php
/**
 * Header file for the awpbusinesspress WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package    WordPress
 * @subpackage awpbusinesspress
 * @since      awpbusinesspress 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<?php wp_head(); ?>
</head>
<?php
	$awpbusinesspress_layout_style = get_theme_mod( 'awpbusinesspress_layout_style', 'wide' );
if ( $awpbusinesspress_layout_style == 'boxed' ) {
	$class_layout = 'boxed';
} else {
	$class_layout = 'wide';
}
?>

<body id="remove_blog_class" <?php body_class( esc_attr( $class_layout ) ); ?>>
<?php wp_body_open(); ?>

<!--Loading-Icon-->
<?php
	$awpbusinesspress_loading_icon_disabled = get_theme_mod( 'awpbusinesspress_loading_icon_disabled', true );
if ( $awpbusinesspress_loading_icon_disabled == true ) {
	?>
	<div class="page-loader">
		<div class="loader">
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			<div class="bar4"></div>
			<div class="bar5"></div>
			<div class="bar6"></div>
		</div>
	</div>
<?php } ?>

<div id="wrapper">
	<?php get_template_part( 'template-parts/site-top-bar' ); ?>

	<div class="clearfix"></div>

	<?php
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
	if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ) {
		$awpbusinesspress_menu_container_size = get_theme_mod( 'awpbusinesspress_menu_container_size', 'container-full' );
	} else {
		$awpbusinesspress_menu_container_size = get_theme_mod( 'awpbusinesspress_menu_container_size', 'container' );
	}

		$awpbusinesspress_menu_style   = get_theme_mod( 'awpbusinesspress_menu_style', 'static' );
		$awpbusinesspress_menu_overlap = get_theme_mod( 'awpbusinesspress_menu_overlap', true );
	?>

	<header class="header-section navbar-custom not-sticky 
	<?php
	if ( $awpbusinesspress_menu_overlap != false ) {
		?>
			navbar-overlap <?php } ?> 
		<?php
		if ( $awpbusinesspress_menu_style == 'sticky' ) {
			echo 'header-sticky'; }
		?>
		" role="navigation">
		<div id="header" class="site-header">
			<div class="site-menu-content">
				<div class="<?php echo esc_attr( $awpbusinesspress_menu_container_size ); ?> padding-0">
					<div class="site-menu-content__wrap wrapper">
						<?php
						echo esc_html( awpbusinesspress_header_logo() );
						?>

							<!-- Nav Menu -->
							<nav id="site-navigation" class="main-navigation">

								<button type="button" id="hamburger-menu" class="open-nav-btn" aria-label="<?php esc_attr_e( 'open navigation', 'awpbusinesspress' ); ?>" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
								<div id="slide-nav" class="slide-content navbar-collapse">
									<button type="button" id="close" class="close-btn" aria-label="<?php esc_attr_e( 'close navigation', 'awpbusinesspress' ); ?>"><i class="fas fa-times"></i></button>
										<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'awpbusinesspress' ); ?></span>
										<span class="main-navigation__icon">
											<span class="main-navigation__icon__middle"></span>
										</span>
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary-menu',
											'depth'       => 5,
											'menu_id'     => 'primary-menu',
											'container_class' => 'primary-menu-container',
											'fallback_cb' => 'awpbusinesspress_Navwalker::fallback',
											'walker'      => new awpbusinesspress_Navwalker(),
										)
									);
									?>
								</div>
							</nav>
							<!-- Nav Menu -->
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header Section 
	<div id="content" class="site-content">-->
