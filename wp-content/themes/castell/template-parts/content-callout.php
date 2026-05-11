<?php
$castell_enable_callout_section = get_theme_mod( 'castell_enable_callout_section', false );
$castell_callout_image = get_theme_mod( 'castell_callout_image' );

if($castell_enable_callout_section == true ) {
   
$castell_callout_title = get_theme_mod( 'castell_callout_title');
$castell_callout_content = get_theme_mod( 'castell_callout_content');
$castell_callout_button_label1 = get_theme_mod( 'castell_callout_button_label1');
$castell_callout_button_link1 = get_theme_mod( 'castell_callout_button_link1');


?>
<section class="cta-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 text-lg-left text-center">
				<h3 class="c-white text-capitalize"><?php echo esc_html($castell_callout_title); ?></h3>
				<p class="c-white mb-0"><?php echo esc_html($castell_callout_content); ?></p>
			</div>
			<div class="col-lg-3 text-lg-right text-center">
				<?php if(!empty($castell_callout_button_label1 && $castell_callout_button_link1)): ?>
					<a href="<?php echo esc_url($castell_callout_button_link1); ?>" class="btn btn-two mt-3"><?php echo esc_html($castell_callout_button_label1); ?></a>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</section>

<?php } ?>