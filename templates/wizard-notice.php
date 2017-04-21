<?php
/**
 * Wizard notice template.
 */

$theme = cherry_plugin_wizard_settings()->get( array( 'texts', 'theme-name' ) );
?>
<div class="cherry-plugin-wizard-notice notice">
	<div class="cherry-plugin-wizard-notice__content"><?php
		printf( esc_html__( 'This wizard will help you to select skin, install plugins and import demo data for your %s theme. To start the install click the button below!', 'cherry-plugin-wizard' ), '<b>' . $theme . '</b>' );
	?></div>
	<div class="cherry-plugin-wizard-notice__actions">
		<a class="cherry-plugin-wizard-btn" href="<?php echo cherry_plugin_wizard()->get_page_link(); ?>"><?php
			esc_html_e( 'Start Install', 'cherry-plugin-wizard' );
		?></a>
		<a class="notice-dismiss" href="<?php echo add_query_arg( array( 'cherry_plugin_wizard_dismiss' => true, '_nonce' => cherry_plugin_wizard()->nonce() ) ); ?>"><?php
			esc_html_e( 'Dismiss', 'cherry-plugin-wizard' );
		?></a>
	</div>
</div>
