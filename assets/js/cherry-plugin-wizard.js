( function( $, settings ) {

	'use strict';

	var tmWizard = {
		css: {
			plugins: '.cherry-plugin-wizard-plugins',
			progress: '.cherry-plugin-wizard-progress__bar',
			showResults: '.cherry-plugin-wizard-install-results__trigger',
			showPlugins: '.cherry-plugin-wizard-skin-item__plugins-title',
			loaderBtn: '[data-loader="true"]',
			start: '.start-install',
			storePlugins: '.store-plugins'
		},

		vars: {
			plugins: null,
			template: null,
			currProgress: 0,
			progress: null
		},

		init: function() {

			tmWizard.vars.progress = $( tmWizard.css.progress );
			tmWizard.vars.percent  = $( '.cherry-plugin-wizard-progress__label', tmWizard.vars.progress );

			$( document )
				.on( 'click.tmWizard', tmWizard.css.showResults, tmWizard.showResults )
				.on( 'click.tmWizard', tmWizard.css.showPlugins, tmWizard.showPlugins )
				.on( 'click.tmWizard', tmWizard.css.storePlugins, tmWizard.storePlugins )
				.on( 'click.tmWizard', tmWizard.css.loaderBtn, tmWizard.showLoader );

			if ( undefined !== settings.firstPlugin ) {
				tmWizard.vars.template = wp.template( 'wizard-item' );
				settings.firstPlugin.isFirst = true;
				tmWizard.installPlugin( settings.firstPlugin );
			}
		},

		storePlugins: function() {

			var $this   = $( this ),
				href    = $this.attr( 'href' ),
				plugins = [];

			event.preventDefault();

			$( '.tm-config-list input[type="checkbox"]:checked' ).each( function( index, el ) {
				plugins.push( $( this ).attr( 'name' ) );
			} );

			$.ajax({
				url: ajaxurl,
				type: 'get',
				dataType: 'json',
				data: {
					action: 'cherry_plugin_wizard_store_plugins',
					plugins: plugins
				}
			}).done( function( response ) {
				window.location = href;
			});

		},

		showLoader: function() {
			$( this ).addClass( 'in-progress' );
		},

		showPlugins: function() {
			$( this ).toggleClass( 'is-active' );
		},

		showResults: function() {
			var $this = $( this );
			$this.toggleClass( 'is-active' );
		},

		installPlugin: function( data ) {

			var $target = $( tmWizard.vars.template( data ) );

			if ( null === tmWizard.vars.plugins ) {
				tmWizard.vars.plugins = $( tmWizard.css.plugins );
			}

			$target.appendTo( tmWizard.vars.plugins );
			console.log( data );
			tmWizard.installRequest( $target, data );

		},

		updateProgress: function() {

			var val   = 0,
				total = parseInt( settings.totalPlugins );

			tmWizard.vars.currProgress++;

			val = 100 * ( tmWizard.vars.currProgress / total );
			val = Math.round( val );

			if ( 100 < val ) {
				val = 100;
			}

			tmWizard.vars.percent.html( val + '%' );
			tmWizard.vars.progress.css( 'width', val + '%' );

		},

		installRequest: function( target, data ) {

			var icon;

			data.action = 'cherry_plugin_wizard_install_plugin';

			if ( undefined === data.isFirst ) {
				data.isFirst = false;
			}

			$.ajax({
				url: ajaxurl,
				type: 'get',
				dataType: 'json',
				data: data
			}).done( function( response ) {

				tmWizard.updateProgress();

				if ( true !== response.success ) {
					return;
				}

				target.append( response.data.log );

				if ( true !== response.data.isLast ) {
					tmWizard.installPlugin( response.data );
				} else {

					$( document ).trigger( 'cherry-plugin-wizard-install-finished' );

					if ( 1 == settings.redirect ) {
						window.location = response.data.redirect;
					}

					target.after( response.data.message );

				}

				if ( 'error' === response.data.resultType ) {
					icon = '<span class="dashicons dashicons-no"></span>';
				} else {
					icon = '<span class="dashicons dashicons-yes"></span>';
				}

				target.addClass( 'installed-' + response.data.resultType );
				$( '.cherry-plugin-wizard-loader', target ).replaceWith( icon );

			});
		}
	};

	tmWizard.init();

}( jQuery, window.tmWizardSettings ) );