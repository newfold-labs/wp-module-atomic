<?php
/**
 * Bootstrap file for wpunit tests.
 *
 * @package NewfoldLabs\WP\Module\Atomic
 */

$module_root = dirname( dirname( __DIR__ ) );

require_once $module_root . '/vendor/autoload.php';

// Set platform to 'atomic' so bootstrap.php's hooks run the atomic branch when
// WPLoader fires plugins_loaded and after_setup_theme, enabling coverage of bootstrap.php.
if ( function_exists( 'NewfoldLabs\WP\Context\setContext' ) ) {
	NewfoldLabs\WP\Context\setContext( 'platform', 'atomic' );
}
