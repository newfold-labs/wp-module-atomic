<?php

namespace NewfoldLabs\WP\Module\Atomic;

/**
 * Tests when platform is not 'atomic': atomic-only filters are not added.
 *
 * Runs first (class name order). Without the newfold/atomic/is_platform_atomic
 * filter returning true, default values pass through. The atomic branch is
 * tested in AtomicHooksWhenAtomicWPUnitTest (filter forces atomic, then re-fires hooks).
 *
 * @coversNothing
 */
class AtomicHooksWhenNotAtomicWPUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	/**
	 * Verifies that when not on atomic, performance filters are not added (default passes through).
	 *
	 * @return void
	 */
	public function test_performance_unchanged_when_not_atomic() {
		$this->assertTrue( apply_filters( 'newfold/features/filter/isEnabled:performance', true ) );
		$this->assertTrue( apply_filters( 'newfold/features/filter/canToggle:performance', true ) );
	}

	/**
	 * Verifies that when not on atomic, staging filters are not added (default passes through).
	 *
	 * @return void
	 */
	public function test_staging_unchanged_when_not_atomic() {
		$this->assertTrue( apply_filters( 'newfold/features/filter/isEnabled:staging', true ) );
		$this->assertTrue( apply_filters( 'newfold/features/filter/canToggle:staging', true ) );
	}

	/**
	 * Verifies that when not on atomic, Help Center and patterns defaults are not overridden.
	 *
	 * @return void
	 */
	public function test_help_center_and_patterns_defaults_unchanged_when_not_atomic() {
		$this->assertTrue( apply_filters( 'newfold/features/filter/defaultValue:helpCenter', true ) );
		$this->assertTrue( apply_filters( 'newfold/features/filter/defaultValue:patterns', true ) );
	}

	/**
	 * Verifies that when not on atomic, cache types are not overridden (default passes through).
	 *
	 * @return void
	 */
	public function test_cache_types_unchanged_when_not_atomic() {
		$default = array( 'browser' );
		$this->assertSame( $default, apply_filters( 'newfold/container/cache_types', $default ) );
	}

	/**
	 * Verifies that when not on atomic, marketplace and plugin brand are not overridden.
	 *
	 * @return void
	 */
	public function test_marketplace_and_plugin_brand_unchanged_when_not_atomic() {
		$this->assertSame( '', apply_filters( 'newfold/container/marketplace_brand', '' ) );
		$this->assertSame( '', apply_filters( 'newfold/container/plugin/brand', '' ) );
	}

	/**
	 * Verifies that when not on atomic, onboarding redirect option is not set to 0.
	 *
	 * @return void
	 */
	public function test_onboarding_redirect_option_not_overridden_when_not_atomic() {
		$this->assertNotSame( '0', get_option( 'nfd_module_onboarding_should_redirect' ) );
	}

	/**
	 * Verifies that the coming-soon default/fresh filter is registered and returns value when not IS_ATOMIC.
	 *
	 * @return void
	 */
	public function test_coming_soon_default_fresh_filter_returns_value_when_not_atomic_constant() {
		$this->assertTrue( apply_filters( 'newfold/coming-soon/filter/default/fresh', true ) );
		$this->assertFalse( apply_filters( 'newfold/coming-soon/filter/default/fresh', false ) );
	}
}
