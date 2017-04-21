<?php
/**
 * Skin item template
 */

$skin = cherry_plugin_wizard_interface()->get_skin_data( 'slug' );

?>
<div class="cherry-plugin-wizard-skin-item">
	<?php if ( cherry_plugin_wizard_interface()->get_skin_data( 'thumb' ) ) : ?>
	<div class="cherry-plugin-wizard-skin-item__thumb">
		<img src="<?php echo cherry_plugin_wizard_interface()->get_skin_data( 'thumb' ); ?>" alt="">
	</div>
	<?php endif; ?>
	<div class="cherry-plugin-wizard-skin-item__summary">
		<h4 class="cherry-plugin-wizard-skin-item__title"><?php echo cherry_plugin_wizard_interface()->get_skin_data( 'name' ); ?></h4>
		<h5 class="cherry-plugin-wizard-skin-item__plugins-title"><?php esc_html_e( 'Recommended Plugins', 'cherry-plugin-wizard' ); ?></h5>
		<div class="cherry-plugin-wizard-skin-item__plugins">
			<div class="cherry-plugin-wizard-skin-item__plugins-content">
				<?php echo cherry_plugin_wizard_interface()->get_skin_plugins( $skin ); ?>
			</div>
		</div>
		<div class="cherry-plugin-wizard-skin-item__actions">
			<?php echo cherry_plugin_wizard_interface()->get_install_skin_button( $skin ); ?>
			<a href="<?php echo cherry_plugin_wizard_interface()->get_skin_data( 'demo' ) ?>" data-loader="true" class="btn btn-default"><span class="text"><?php
				esc_html_e( 'View Demo', 'cherry-plugin-wizard' );
			?></span><span class="cherry-plugin-wizard-loader"><span class="cherry-plugin-wizard-loader__spinner"></span></span></a>
		</div>
	</div>
</div>