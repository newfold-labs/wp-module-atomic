<?php

namespace NewfoldLabs\WP\Module\Atomic;

/**
 * Module loading wpunit tests.
 *
 * This module has no PHP classes; it only registers hooks in bootstrap.php.
 * These tests verify the test environment and the context dependency used by the module.
 *
 * @coversNothing
 */
class ModuleLoadingWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verify WordPress factory is available.
	 *
	 * @return void
	 */
	public function test_wordpress_factory_available() {
		$this->assertTrue( function_exists( 'get_option' ) );
		$this->assertNotEmpty( get_option( 'blogname' ) );
	}

	/**
	 * Verify add_action exists (bootstrap uses it).
	 *
	 * @return void
	 */
	public function test_wordpress_hooks_available() {
		$this->assertTrue( function_exists( 'add_action' ) );
		$this->assertTrue( function_exists( 'add_filter' ) );
	}

	/**
	 * Verify context module getContext is available (module dependency).
	 *
	 * @return void
	 */
	public function test_context_get_context_available() {
		$this->assertTrue(
			function_exists( 'NewfoldLabs\WP\Context\getContext' ),
			'wp-module-context getContext() should be available'
		);
	}
}
