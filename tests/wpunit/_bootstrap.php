<?php
/**
 * Bootstrap file for wpunit tests.
 *
 * @package NewfoldLabs\WP\Module\Atomic
 */

$module_root = dirname( dirname( __DIR__ ) );

// Force atomic platform for wpunit: bootstrap.php will register a plugins_loaded priority 0
// callback that adds the newfold/atomic/is_platform_atomic filter so the atomic branch runs when WordPress loads.
if ( ! defined( 'NFD_ATOMIC_WPUNIT_ATOMIC_MODE' ) ) {
	define( 'NFD_ATOMIC_WPUNIT_ATOMIC_MODE', true );
}

// Loads atomic bootstrap and dependencies (e.g. wp-module-context setContext/getContext) via Composer.
require_once $module_root . '/vendor/autoload.php';
