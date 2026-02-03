<?php
/**
 * Bootstrap file for wpunit tests.
 *
 * @package NewfoldLabs\WP\Module\Atomic
 */

$module_root = dirname( dirname( __DIR__ ) );

// Define IS_ATOMIC before WordPress loads so the context module sets platform to 'atomic'
// on the first plugins_loaded, and the atomic module's callbacks add the expected filters.
if ( ! defined( 'IS_ATOMIC' ) ) {
	define( 'IS_ATOMIC', true );
}

// Loads atomic bootstrap and dependencies (e.g. wp-module-context setContext/getContext) via Composer.
require_once $module_root . '/vendor/autoload.php';
