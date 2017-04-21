<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Cherry_Plugin_Wizard_Settings' ) ) {

	/**
	 * Define Cherry_Plugin_Wizard_Settings class
	 */
	class Cherry_Plugin_Wizard_Settings {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Manifest file content
		 *
		 * @var array
		 */
		private $manifest = null;

		/**
		 * Manifest defaults
		 *
		 * @var array
		 */
		private $defaults = null;

		/**
		 * Get settings from array.
		 *
		 * @param  array  $settings Settings trail to get.
		 * @return mixed
		 */
		public function get( $settings = array() ) {

			$manifest = $this->get_manifest();

			if ( ! $manifest ) {
				return false;
			}

			if ( ! is_array( $settings ) ) {
				$settings = array( $settings );
			}

			$count  = count( $settings );
			$result = $manifest;

			for ( $i = 0; $i < $count; $i++ ) {

				if ( empty( $result[ $settings[ $i ] ] ) ) {
					return false;
				}

				$result = $result[ $settings[ $i ] ];

				if ( $count - 1 === $i ) {
					return $result;
				}

			}

		}

		/**
		 * Get mainfest
		 *
		 * @return mixed
		 */
		public function get_manifest() {

			if ( null !== $this->manifest ) {
				return $this->manifest;
			}

			$file = locate_template( array( 'cherry-plugin-wizard-manifest.php' ) );

			// Backward compatibility for old Cherry Plugin Wizard
			if ( ! $file ) {
				$file = locate_template( array( 'tm-wizard-manifest.php' ) );
			}

			if ( ! $file ) {
				return false;
			}

			include $file;

			$this->manifest = array(
				'plugins' => isset( $plugins ) ? $plugins : $this->get_defaults( 'plugins' ),
				'skins'   => isset( $skins )   ? $skins   : $this->get_defaults( 'skins' ),
				'texts'   => isset( $texts )   ? $texts   : $this->get_defaults( 'texts' ),
			);

			return $this->manifest;
		}

		/**
		 * Get wizard defaults
		 *
		 * @param  string $part What part of manifest to get (optional - if empty return all)
		 * @return array
		 */
		public function get_defaults( $part = null ) {

			if ( null === $this->defaults ) {
				include cherry_plugin_wizard()->path( 'includes/manifest/cherry-plugin-wizard-manifest.php' );

				$this->defaults = array(
					'plugins' => $plugins,
					'skins'   => $skins,
					'texts'   => $texts,
				);

			}

			if ( ! $part ) {
				return $this->defaults;
			}

			if ( isset( $this->defaults[ $part ] ) ) {
				return $this->defaults[ $part ];
			}

			return array();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Cherry_Plugin_Wizard_Settings
 *
 * @return object
 */
function cherry_plugin_wizard_settings() {
	return Cherry_Plugin_Wizard_Settings::get_instance();
}
