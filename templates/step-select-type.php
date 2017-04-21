<?php
/**
 * Template part for displaying advanced popup
 */

$skin      = cherry_plugin_wizard_interface()->get_skin_data( 'slug' );
$next_step = isset( $_GET['advanced-install'] ) && '1' === $_GET['advanced-install'] ? 'configure-plugins' : 3;

?>
<h2><?php esc_html_e( 'Demo Content Settings', 'cherry-plugin-wizard' ); ?></h2>

<?php esc_html_e( 'Each theme comes with lite and full version of demo content. The number of posts and plugins may affect your site speed. We recommend importing lite version of demo content if you are running shared inexpensive server.', 'cherry-plugin-wizard' ); ?>
<form method="get" action="<?php echo esc_url( admin_url( 'admin.php' ) ); ?>">
	<div class="cherry-plugin-wizard-type__select">
		<label class="cherry-plugin-wizard-type__item">
			<input type="radio" name="type" value="lite" checked>
			<span class="cherry-plugin-wizard-type__item-mask"></span>
			<span class="cherry-plugin-wizard-type__item-label">
				<span class="cherry-plugin-wizard-type__item-label-title"><?php
					esc_html_e( 'Lite Install', 'cherry-plugin-wizard' );
				?></span>
				<span class="cherry-plugin-wizard-type__item-label-desc"><?php
					esc_html_e( 'Lite version sample data includes the optimal amount of demo data with a smaller number of blog posts and images and fits for acquaintance with the template. It is recommended to install the Lite sample data version if you use an entry-level hosting plan.', 'cherry-plugin-wizard' );
				?></span>
			</span>
		</label>
		<label class="cherry-plugin-wizard-type__item">
			<input type="radio" name="type" value="full">
			<span class="cherry-plugin-wizard-type__item-mask"></span>
			<span class="cherry-plugin-wizard-type__item-label"><span class="cherry-plugin-wizard-type__item-label-title"><?php
					esc_html_e( 'Full Install', 'cherry-plugin-wizard' );
				?></span>
				<span class="cherry-plugin-wizard-type__item-label-desc"><?php
					esc_html_e( 'Full version of sample data contains the entire amount of available demo data used in the template, including all posts, products, reviews, images and more. It is recommended to install a Full sample data version if you use premium hosting plans, dedicated or VPS servers.', 'cherry-plugin-wizard' );
				?></span>
			</span>
		</label>
	</div>
	<input type="hidden" name="step" value="<?php echo $next_step; ?>">
	<input type="hidden" name="skin" value="<?php echo $skin; ?>">
	<input type="hidden" name="page" value="<?php echo cherry_plugin_wizard()->slug(); ?>">
	<?php
		if ( isset( $_GET['advanced-install'] ) ) {
			$install = esc_attr( $_GET['advanced-install'] );
			echo '<input type="hidden" name="advanced-install" value="' . $install . '">';
		}
	?>
	<button class="btn btn-primary" data-wizard="confirm-install" data-loader="true" data-href=""><span class="text"><?php
		esc_html_e( 'Next', 'cherry-plugin-wizard' );
	?></span><span class="cherry-plugin-wizard-loader"><span class="cherry-plugin-wizard-loader__spinner"></span></span></button>
</form>