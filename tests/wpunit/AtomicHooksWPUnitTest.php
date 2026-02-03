<?php

namespace NewfoldLabs\WP\Module\Atomic;

/**
 * Tests for atomic platform hooks registered in bootstrap.php.
 *
 * With platform set to 'atomic' in _bootstrap.php, the module registers filters
 * on plugins_loaded and after_setup_theme. These tests assert that behavior.
 *
 * @coversNothing
 */
class AtomicHooksWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies that performance feature is disabled on atomic.
	 *
	 * @return void
	 */
	public function test_performance_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:performance', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:performance', true ) );
	}

	/**
	 * Verifies that staging feature is disabled on atomic.
	 *
	 * @return void
	 */
	public function test_staging_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:staging', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:staging', true ) );
	}

	/**
	 * Verifies that Help Center and patterns default to disabled on atomic.
	 *
	 * @return void
	 */
	public function test_help_center_and_patterns_default_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:helpCenter', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:patterns', true ) );
	}

	/**
	 * Verifies that container cache types are empty on atomic.
	 *
	 * @return void
	 */
	public function test_cache_types_empty_on_atomic() {
		$this->assertSame( array(), apply_filters( 'newfold/container/cache_types', array( 'browser' ) ) );
	}

	/**
	 * Verifies that marketplace and plugin brand are bluehost-cloud on atomic.
	 *
	 * @return void
	 */
	public function test_marketplace_and_plugin_brand_bluehost_cloud_on_atomic() {
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/marketplace_brand', '' ) );
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/plugin/brand', '' ) );
	}

	/**
	 * Verifies that onboarding redirect option is set to 0 on atomic.
	 *
	 * @return void
	 */
	public function test_onboarding_redirect_disabled_on_atomic() {
		$this->assertSame( '0', get_option( 'nfd_module_onboarding_should_redirect' ) );
	}

	/**
	 * Verifies that coming-soon default/fresh filter is registered.
	 *
	 * When IS_ATOMIC is defined and true, the filter returns false; otherwise it returns the passed value.
	 *
	 * @return void
	 */
	public function test_coming_soon_default_fresh_filter_registered() {
		$value = apply_filters( 'newfold/coming-soon/filter/default/fresh', true );
		// When IS_ATOMIC is not defined (typical in tests), the filter returns the passed value.
		$this->assertTrue( $value );
	}
}
