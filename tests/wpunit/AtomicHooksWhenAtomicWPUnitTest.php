<?php

namespace NewfoldLabs\WP\Module\Atomic;

/**
 * Tests when platform is 'atomic': bootstrap callbacks add filters and set option.
 *
 * NFD_ATOMIC_WPUNIT_ATOMIC_MODE is defined in _bootstrap.php; bootstrap.php then
 * registers a plugins_loaded priority 0 callback that adds the is_platform_atomic
 * filter, so when WordPress loads the atomic branch runs and the filters are present.
 *
 * @coversNothing
 */
class AtomicHooksWhenAtomicWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies that performance feature is disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_performance_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:performance', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:performance', true ) );
	}

	/**
	 * Verifies that staging feature is disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_staging_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/isEnabled:staging', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/canToggle:staging', true ) );
	}

	/**
	 * Verifies that Help Center and patterns default to disabled when platform is atomic.
	 *
	 * @return void
	 */
	public function test_help_center_and_patterns_default_disabled_on_atomic() {
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:helpCenter', true ) );
		$this->assertFalse( apply_filters( 'newfold/features/filter/defaultValue:patterns', true ) );
	}

	/**
	 * Verifies that container cache types are empty when platform is atomic.
	 *
	 * @return void
	 */
	public function test_cache_types_empty_on_atomic() {
		$this->assertSame( array(), apply_filters( 'newfold/container/cache_types', array( 'browser' ) ) );
	}

	/**
	 * Verifies that marketplace and plugin brand are bluehost-cloud when platform is atomic.
	 *
	 * @return void
	 */
	public function test_marketplace_and_plugin_brand_bluehost_cloud_on_atomic() {
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/marketplace_brand', '' ) );
		$this->assertSame( 'bluehost-cloud', apply_filters( 'newfold/container/plugin/brand', '' ) );
	}

	/**
	 * Verifies that onboarding redirect option is set to 0 when platform is atomic.
	 *
	 * @return void
	 */
	public function test_onboarding_redirect_disabled_on_atomic() {
		$this->assertSame( '0', get_option( 'nfd_module_onboarding_should_redirect' ) );
	}
}
