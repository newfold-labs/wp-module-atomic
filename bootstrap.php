<?php
/**
 * This module detects wp-cloud and adjusts features accordingly.
 *
 * @package NewfoldLabs\WP\Module\Atomic
 */

use function NewfoldLabs\WP\Context\getContext;

if ( function_exists( 'add_action' ) ) {

	// Early hooks
	add_action(
		'plugins_loaded',
		function () {
			if ( 'atomic' === getContext( 'platform' ) ) {

				// Disable performance
				add_filter( 'newfold/features/filter/canToggle:performance', '__return_false' );
				add_filter( 'newfold/features/filter/isEnabled:performance', '__return_false' );

				// Disable staging
				add_filter( 'newfold/features/filter/canToggle:staging', '__return_false' );
				add_filter( 'newfold/features/filter/isEnabled:staging', '__return_false' );

				// Disable Help Center by default
				add_filter( 'newfold/features/filter/defaultValue:helpCenter', '__return_false' );

				// Disable WonderBlocks by default
				add_filter( 'newfold/features/filter/defaultValue:patterns', '__return_false' );
			}
		},
		2
	);

	// Late hooks
	add_action(
		'plugins_loaded',
		function () {
			if ( 'atomic' === getContext( 'platform' ) ) {

				// Disable plugin login redirects
				remove_action( 'login_redirect', array( 'Bluehost\LoginRedirect', 'on_login_redirect' ), 10, 3 );
				remove_action( 'login_init', array( 'Bluehost\LoginRedirect', 'on_login_init' ), 10, 3 );
				remove_action( 'admin_init', array( 'Bluehost\LoginRedirect', 'disable_yoast_onboarding_redirect' ), 2 );
				remove_filter( 'login_form_defaults', array( 'Bluehost\LoginRedirect', 'filter_login_form_defaults' ) );
				remove_filter( 'newfold_sso_success_url_default', array( 'Bluehost\LoginRedirect', 'get_default_redirect_url' ) );

				// Disable onboarding login redirects
				remove_filter( 'login_redirect', array( 'NewfoldLabs\WP\Module\Onboarding\LoginRedirect', 'wplogin' ), 10, 3 );
				remove_filter( 'newfold_sso_success_url', array( 'NewfoldLabs\WP\Module\Onboarding\LoginRedirect', 'sso' ), 10 );
				remove_filter(
					'nfd_module_onboarding_should_redirect_disable',
					array( 'NewfoldLabs\WP\Module\Onboarding\LoginRedirect', 'remove_handle_redirect_action' )
				);

			}
		},
		11
	);
}
