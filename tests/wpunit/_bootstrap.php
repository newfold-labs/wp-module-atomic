<?php
/**
 * Bootstrap file for wpunit tests.
 *
 * @package NewfoldLabs\WP\Module\Atomic
 */

$module_root = dirname( dirname( __DIR__ ) );

// Loads atomic bootstrap and dependencies (e.g. wp-module-context setContext/getContext) via Composer.
require_once $module_root . '/vendor/autoload.php';
