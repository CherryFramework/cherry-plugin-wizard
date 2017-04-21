<?php
/**
 * Template for service notice step.
 */
?>
<h2><?php esc_html_e( 'Installation Wizard', 'cherry-plugin-wizard' ); ?></h2>
<div class="cherry-plugin-wizard-msg"><?php esc_html_e( 'Demo data import wizard will guide you through the process of demo content import and recommended plugins installation. Before gettings started make sure your server complies with', 'cherry-plugin-wizard' ); ?> <b><?php esc_html_e( 'WordPress minimal requirements.', 'cherry-plugin-wizard' ); ?></b></div>
<h4><?php esc_html_e( 'Your system information:', 'cherry-plugin-wizard' ); ?></h4>
<?php echo cherry_plugin_wizard_interface()->server_notice(); ?>
<?php
	$errors = wp_cache_get( 'errors', 'cherry-plugin-wizard' );
	if ( $errors ) {
		printf(
			'<div class="tm-warning-notice">%s</div>',
			esc_html__( 'Not all of your server parameters met requirements. You can continue the installation process, but it will take more time and can probably drive to bugs.', 'cherry-plugin-wizard' )
		);
	}
?>

<a href="<?php echo cherry_plugin_wizard()->get_page_link( array( 'step' => 1, 'advanced-install' => 1 ) ); ?>" data-loader="true" class="btn btn-primary start-install">
	<span class="text"><?php esc_html_e( 'Next', 'cherry-plugin-wizard' ); ?></span>
	<span class="cherry-plugin-wizard-loader"><span class="cherry-plugin-wizard-loader__spinner"></span></span>
</a>